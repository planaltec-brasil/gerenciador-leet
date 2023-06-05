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
        }else{
            $res = $this->pedido_model->update([ 'id_cliente' => $id ], $formDados);
        }
        echo json_encode($res);
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

}