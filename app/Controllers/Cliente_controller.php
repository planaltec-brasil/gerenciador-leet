<?php

namespace App\Controllers;

class Cliente_controller extends BaseController {


    function InsereDadosCliente(){
        $formDados = $this->request->getPost();
        $id = $formDados["id_Edita"];
        unset($formDados["id_Edita"]);
        if($id == "" || $id == null){
            $res = $this->Cliente_model->save($formDados);
        }else{
            $res = $this->Cliente_model->update([ 'id_cliente' => $id ], $formDados);
        }
        echo json_encode($res);
    }

    public function getClientes() {
        $res = $this->Cliente_model->getClientes();
        echo json_encode(['data' => $res]);
    }

    public function CarregaEditaCliente(){
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $res = $this->Cliente_model->getClientes($id);
        echo json_encode($res);
    }
}