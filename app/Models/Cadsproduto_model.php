<?php

namespace App\Models; 
use CodeIgniter\Model;

class Cadsproduto_model extends Model {

    protected $table = 'tb_produto';
    protected $primaryKey = 'id_produto';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [ 
        'nome_produto',
        'cor_produto',
        'estoque_atual',
        'estoque_anterior',
        'unidade_produto',
        'volume_produto',
        'material_produto',
        'fotos_produto',
        'qtdPrd',
    ];

    public function getProduto($id = false) {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['id_produto' => $id])->first();
    }

    
    // function ListaCliente($id = null){
    //     $db = db_connect();
    //     $query =  $db->query("SELECT * FROM tb_cliente WHERE id_cliente = $id");
    //     return $query->getResult();
    // }

}