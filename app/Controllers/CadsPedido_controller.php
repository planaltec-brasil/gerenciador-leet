<?php

namespace App\Controllers;
use App\Models\Acrescimo_model;

class CadsPedido_controller extends BaseController {


    function CadsPedidos(){

        $data = [
             'pagina' => 'cadastroPedido'
         ];
 
         return view('Dashboard', $data);
     }


    function InsereDadosPedido(){
        $formDados = $this->request->getPost();
        $id = $formDados["id_Edita"];
        
        unset($formDados["id_Edita"]);
        if($id == "" || $id == null){
            $res = $this->pedido_model->save($formDados);
            $id = $this->pedido_model->insertID();
        }else{
            $res = $this->pedido_model->update([ 'id_pedido' => $id ], $formDados);
        }

        $produtos = isset($formDados['id_Produto']) ? $formDados['id_Produto'] : null;
        
        $this->acrescimoPedidoModel->deletaPorPedido($id);

        foreach ($produtos as $key => $prodpedidos){
		 	$arrayProduto = array(
                'pedidos' => $id,
		 		'produtos_pedido' => $prodpedidos,
		 		'qtd' => $formDados['qtdPrd'][$key],
		 		// 'foto' => $formDados['fotos'][$key],
                'valor_produto' => $formDados['valorProd'][$key],
		 	);
            
            if(!isset($formDados['id_produto_pedido']) || $formDados['id_produto_pedido'][$key] == '') {
                unset($formDados["id_produto_pedido"]);
                $this->prodPedidoModel->save($arrayProduto);
            } else {
                $this->prodPedidoModel->update([ 'id' => $formDados['id_produto_pedido'][$key] ], $arrayProduto);
            }

            $acrescimos = isset($formDados['id_Acrescimo']) ? explode(',', $formDados['id_Acrescimo'][$key]) : null;
            
            foreach($acrescimos as $key => $acrescimo) {
                $acrsm = $this->acrescimoModel->getAcrescimo($acrescimo);
                $arrayAcrescimo = array(
                    'id_pedido' => $id,
                    'id_acrescimo' => (int) $acrsm['id_acrescimo'],
                    'id_produto' => $prodpedidos,
                    'valor_acrescimo' => $acrsm['valor']
                );
                
                $this->acrescimoPedidoModel->save($arrayAcrescimo);
            }
            
        }
       
        echo json_encode($id);
    }


    public function getPedido() {
        $res = $this->pedido_model->listaPedidos();
        echo json_encode(['data' => $res]);
    }

    public function CarregaEditaPedido(){
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $res = $this->pedido_model->getPedido($id);
        $res['pedidos'] = $this->pedido_model->getPedido($id);
        $res['produtos'] = $this->pedido_model->listaProdutosPedido($id);
        echo json_encode($res);
    }

    function ExcluiProdPedido(){
        $id = isset($_POST['id']) ? $_POST['id'] : ""; 
        $res = null;

        if($id)
            $response = $this->prodPedidoModel->CarregaProduto($id);
     
        if($response == null){
            $res = $this->pedido_model->delete($id);

        }else{
            
            $temp = $this->prodPedidoModel->deleta($id);
            if($temp){
                $res = $this->pedido_model->delete($id);
            }
        }

        echo json_encode($res);
    }

    function ExcluiPedido(){
        $acres = $this->acrescimoPedidoModel->deletaPorPedido($_POST['id']);
        if($acres) {
            $prod = $this->prodPedidoModel->deleta($_POST['id']);
            if($prod)
                $res = $this->pedido_model->delete($_POST['id']);
        } else {
            $res = false;
        }
        echo json_encode($res);
    }

    function getEstado (){
        $res = $this->pedido_model->ListaEstado();
        echo json_encode($res);
    }

    function getCidade(){
        $idEstado = isset($_POST['idEstado']) ? $_POST['idEstado'] : "";
        $res = false;
        if($idEstado)
            $res = $this->pedido_model->cidadeporID($idEstado);
        echo json_encode($res);
    }

    function pegaId(){
        $sigla = isset($_POST['sigla']) ? $_POST['sigla'] : "";
        $res = false;
        if($sigla)
            $res = $this->pedido_model->getidEstado($sigla);
        echo json_encode($res);
    }

    function acrescimoProd(){
        $res['acrescimos'] = $this->acrescimoModel->ListaAcrescimo();
        $res['acrescimosUpd'] = $_POST['idPedido'] != "" && $_POST['idProduto'] != "" ? $this->acrescimoPedidoModel->CarregaAcrescimosProduto($_POST['idPedido'], $_POST['idProduto']) : [];
        echo json_encode($res);
    }

}