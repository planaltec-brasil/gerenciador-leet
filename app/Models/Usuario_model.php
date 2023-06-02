<?php

namespace App\Models; 
use CodeIgniter\Model;

class Usuario_model extends Model {

    protected $table = 'tb_usuario';
    protected $primaryKey = 'id_usuario';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [ 
        'usuario',
        'senha',
        'cargo',
        ];

    public function getUsuario($id = false) {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['id_usuario' => $id])->first();
    }

    
    // function ListaCliente($id = null){
    //     $db = db_connect();
    //     $query =  $db->query("SELECT * FROM tb_cliente WHERE id_cliente = $id");
    //     return $query->getResult();
    // }

}