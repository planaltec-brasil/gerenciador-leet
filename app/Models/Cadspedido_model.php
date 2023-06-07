<?php

namespace App\Models; 
use CodeIgniter\Model;

class Cadspedido_model extends Model {

    protected $table = 'tb_pedido';
    protected $primaryKey = 'id_pedido';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [ 
        'numero_pedido',
        'dados_cliente',
        'dados_produto',
        'dados_arte',
        'data_pedido',
        'data_evento',
        'data_entrega',
        'retirada_envio',
        'cep_pedido',
        'valor_frete',
        'valor_unitario',
        'valor_total',
        'valor_sinal',
        'falta_pagar',
        ];

    public function getPedido($id = false) {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['id_pedido' => $id])->first();
    }

    function deleta($id){
        return $this->where(['id_pedido' => $id])->delete();
    }

    
    // function ListaCliente($id = null){
    //     $db = db_connect();
    //     $query =  $db->query("SELECT * FROM tb_cliente WHERE id_cliente = $id");
    //     return $query->getResult();
    // }

}