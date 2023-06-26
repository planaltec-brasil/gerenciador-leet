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
        echo json_encode($res[0]);
    }

    function Situacao_cliente(){
        $dados = [
            'ativo_inativo' => $_POST['situacao'],
        ];
        $id = $_POST["id"];
        $res = $this->Cliente_model->update([ 'id_cliente' => $id ], $dados);
        echo json_encode($res);
    }

    function getEstado (){
        $res = $this->Cliente_model->ListaEstado();
        echo json_encode($res);
    }

    function getCidade(){
        $idEstado = isset($_POST['idEstado']) ? $_POST['idEstado'] : "";
        $res = false;
        if($idEstado)
            $res = $this->Cliente_model->cidadeporID($idEstado);
        echo json_encode($res);
    }

    function pegaId(){
        $sigla = isset($_POST['sigla']) ? $_POST['sigla'] : "";
        $res = false;
        if($sigla)
            $res = $this->Cliente_model->getidEstado($sigla);
        echo json_encode($res);
    }

    public function getAllCliente() {
        $res = $this->Cliente_model->getClientes();
        echo json_encode($res);
    }
}