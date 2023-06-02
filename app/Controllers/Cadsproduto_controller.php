<?php

namespace App\Controllers;

class Cadsproduto_controller extends BaseController {


    function InsereDadosProduto(){
        $formDados = $this->request->getPost();
        $id = $formDados["id_Edita"];
        unset($formDados["id_Edita"]);
        if($id == "" || $id == null){
            $res = $this->produto_model->save($formDados);
        }else{
            $res = $this->produto_model->update([ 'id_cliente' => $id ], $formDados);
        }
        echo json_encode($res);
    }

    public function getProduto() {
        $res = $this->produto_model->getProduto();
        echo json_encode(['data' => $res]);
    }

    public function CarregaEditaProduto(){
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $res = $this->produto_model->getProduto($id);
        echo json_encode($res);
    }

}