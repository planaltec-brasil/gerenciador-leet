<?php

namespace App\Controllers;

class Acrescimos_controller extends BaseController {


    function InsereDadosAcrescimos(){
        $formDados = $this->request->getPost();
        $id = $formDados["id_Edita"];
        unset($formDados["id_Edita"]);
        if($id == "" || $id == null){
            $res = $this->acrescimoModel->save($formDados);
        }else{
            $res = $this->acrescimoModel->update([ 'id_acrescimo' => $id ], $formDados);
        }
        echo json_encode($res);
    }

    

    public function getAcrescimo() {
        $res = $this->acrescimoModel->getAcrescimo();
        echo json_encode(['data' => $res]);
    }

    public function getAllProd() {
        $res = $this->acrescimoModel->getAcrescimo();
        echo json_encode($res);
    }

    public function CarregaEditaAcresc(){
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $res = $this->acrescimoModel->getAcrescimo($id);
        echo json_encode($res);
    }

}