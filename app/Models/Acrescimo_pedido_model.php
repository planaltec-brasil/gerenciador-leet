<?php

namespace App\Models; 
use CodeIgniter\Model;

class Acrescimo_pedido_model extends Model {

    protected $table = 'tb_acrescimos_produto_pedido';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [ 
        'id_produto',
        'id_pedido',
        'id_acrescimo',
        'valor_acrescimo'
    ];

    public function verificaExisteAcrescimoPedido($id = false) {
        if ($id === false) {
            return $this->findAll();
        }
        return $this->where(['id_pedido' => $id])->first();
    }

    function CarregaAcrescimosProduto($idPedido, $idProduto) {
        $db = db_connect();
        $query =  $db->query("SELECT * FROM tb_acrescimos_produto_pedido WHERE id_pedido = $idPedido AND id_produto = $idProduto;");
        return $query->getResult();
    }
}