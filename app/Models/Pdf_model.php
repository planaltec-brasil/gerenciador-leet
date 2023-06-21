<?php

namespace App\Models; 
use CodeIgniter\Model;

class Pdf_model extends Model {

    protected $table = 'tb_pedido';
    protected $primaryKey = 'id_pedido';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [ 
        'cliente',
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
        'id_acrescimo',
        'nome_acrescimo',
        'valor'
    ];

    function funcaopuxaostrem(){
        $db = db_connect();
        $query =  $db->query("SELECT * FROM bd_leet.tb_pedido");
        return $query->getResult();
    }

}