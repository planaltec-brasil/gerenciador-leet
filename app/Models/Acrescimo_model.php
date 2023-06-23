<?php

namespace App\Models; 
use CodeIgniter\Model;

class Acrescimo_model extends Model {

    protected $table = 'tb_acrescimos';
    protected $primaryKey = 'id_acrescimo';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'nome_acrescimo',
        'valor',
    ];

    public function getAcrescimo($id = false) {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['id_acrescimo' => $id])->first();
    }

    function ListaAcrescimo(){
        $db = db_connect();
        $query =  $db->query("SELECT * FROM bd_leet.tb_acrescimos");
        return $query->getResult();
    }
}