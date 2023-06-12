<?php

namespace App\Models; 
use CodeIgniter\Model;

class Clientes_model extends Model {

    protected $table = 'tb_cliente';
    protected $primaryKey = 'id_cliente';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [ 
        'nome_cliente',
        'cpf_cliente',
        'telefone_cliente',
        'cidade_cliente',
        'estado_cliente',
        'cep_cliente',
        'ativo_inativo'
        ];

    public function getClientes($id = false) {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['id_cliente' => $id])->first();
    }

    function ListaEstado(){
        $db = db_connect();
        $query =  $db->query("SELECT * FROM servico_bd.estados");
        return $query->getResult();
    }

    function cidadeporID($idEstado){
        $db = db_connect();
        $query =  $db->query("SELECT * FROM servico_bd.cidades where estado_id = $idEstado");
        return $query->getResult();
    }

    function getidEstado($sigla){
        $db = db_connect();
        $query =  $db->query("SELECT * FROM servico_bd.estados where sigla = '$sigla' ");
        return $query->getResult();
    }

}