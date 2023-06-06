<?php

namespace App\Models; 
use CodeIgniter\Model;

class prodPedidoModel extends Model {

    protected $table = 'tb_produtos_pedido';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [ 
        'pedidos',
        'produtos_pedido',
        'qtd',
    ];


    public function GetProdutosPedido($id = false) {
        if ($id === false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

    function CarregaProduto($id ){
        return $this->where(['pedidos' => $id])->findAll();
    }

    function deleta($id){
        return $this->where(['pedidos' => $id])->delete();
    }

}