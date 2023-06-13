<?php

namespace App\Controllers;

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

        foreach ($produtos as $key => $prodpedidos){
		 	$arrayProduto = array(
                'pedidos' => $id,
		 		'produtos_pedido' => $prodpedidos,
		 		'qtd' => $formDados['qtdPrd'][$key]
		 	);

            $this->prodPedidoModel->save($arrayProduto);
        }
       
        echo json_encode($id);
    }


    public function getPedido() {
        $res = $this->pedido_model->getPedido();
        echo json_encode(['data' => $res]);
    }

    public function CarregaEditaPedido(){
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $res = $this->pedido_model->getPedido($id);
        echo json_encode($res);
    }

    function ExcluiProdPedido(){
        $id = isset($_POST['id']) ? $_POST['id'] : ""; 
        $res = null;

     

        if($id)
            $response = $this->prodPedidoModel->CarregaProduto($id);

        if($response[0]['id'] == null){
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
        $res = $this->pedido_model->delete($_POST['id']);
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

}