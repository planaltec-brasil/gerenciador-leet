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

    function carregaPedidos($id){
        $db = db_connect();
        $query =  $db->query("SELECT 
            TP.*,
            TC.nome_cliente,
            TC.telefone_cliente,
            E.sigla,
            C.nome AS nome_cidade
        FROM tb_pedido TP 
            LEFT JOIN tb_cliente TC ON TC.id_cliente = TP.cliente
            LEFT JOIN servico_bd.estados E ON E.id = TP.estado_pedido
            LEFT JOIN servico_bd.cidades C ON C.id = TP.cidade_pedido
        WHERE TP.id_pedido = $id
        ");
        return $query->getResult();
    }

    function carregaProdutosPedidos($id) {
        $db = db_connect();
        $query =  $db->query("SELECT * FROM tb_produtos_pedido TPP LEFT JOIN tb_produto TP ON TP.id_produto = TPP.produtos_pedido WHERE TPP.pedidos = $id ");
        return $query->getResult();
    }

    function carregaAcrescimosProdutosPedidos($idPedido, $idProduto) {
        $db = db_connect();
        $query =  $db->query("SELECT * FROM tb_acrescimos_produto_pedido TAPP LEFT JOIN tb_acrescimos TA ON TA.id_acrescimo = TAPP.id_acrescimo WHERE TAPP.id_pedido = $idPedido AND TAPP.id_produto = $idProduto");
        return $query->getResult();
    }

}