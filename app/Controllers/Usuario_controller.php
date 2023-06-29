<?php

namespace App\Controllers;
use App\Models\Usuario_model;

class Usuario_controller extends BaseController {


    function InsereDadosUsuario(){
        $formDados = $this->request->getPost();
        $id = $formDados["id_Edita"];
        unset($formDados["id_Edita"]);
        $formDados['senha'] = SHA1(MD5($formDados['senha']));
        if($id == "" || $id == null){
            $res = $this->user_model->save($formDados);
        }else{
            $res = $this->user_model->update([ 'id_cliente' => $id ], $formDados);
        }
        echo json_encode($res);
    }

    public function getUsuario() {
        $res = $this->user_model->getUsuario();
        echo json_encode(['data' => $res]);
    }

    public function CarregaEditaUsuario(){
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $res = $this->user_model->getUsuario($id);
        echo json_encode($res);
    }

    function Situacao_usuario(){
        $dados = [
            'inativo_ativo' => $_POST['situacao']
        ];

        $id = $_POST["id"];
        $res = $this->user_model->update([ 'id_usuario' => $id ], $dados);
        // echo json_encode($res);
    }

}