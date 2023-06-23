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
        'logradouro_cliente',
        'bairro_cliente',
        'numero_cliente',
        'complemento_cliente',
        'cidade_cliente',
        'estado_cliente',
        'cep_cliente',
        'ativo_inativo'
        ];

    public function getClientes() {
        $db = db_connect();
        $query =  $db->query("SELECT TC.*, SBE.nome as nomeEstado, SBC.nome as nomeCidade  FROM bd_leet.tb_cliente TC
        LEFT JOIN servico_bd.estados SBE ON SBE.id = TC.estado_cliente
        LEFT JOIN servico_bd.cidades SBC ON SBC.id = TC.cidade_cliente");
        return $query->getResult();
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