<?php

namespace App\Models; 
use CodeIgniter\Model;

class Clientes_model extends Model {

    protected $table = 'tb_cliente';
    protected $primaryKey = 'id';

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
        ];

    public function getClientes($id = false) {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['id_cliente' => $id])->first();
    }

    
    // function ListaCliente($id = null){
    //     $db = db_connect();
    //     $query =  $db->query("SELECT * FROM tb_cliente WHERE id_cliente = $id");
    //     return $query->getResult();
    // }

}