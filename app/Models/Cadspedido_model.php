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
        ];



    public function listaPedidos() {
        $db = db_connect();
        $query =  $db->query("SELECT TP.*, TC.nome_cliente FROM tb_pedido TP LEFT JOIN tb_cliente TC ON TC.id_cliente = TP.cliente");
        return $query->getResult();
    }

    public function listaProdutosPedido($idPedido) {
        $db = db_connect();
        $sql = "SELECT TP.*, TPP.qtd, TPP.foto, TPP.id FROM tb_produto TP
                    JOIN tb_produtos_pedido TPP ON TPP.produtos_pedido = TP.id_produto
                WHERE TPP.pedidos = $idPedido
                GROUP BY TP.id_produto";

        $query =  $db->query($sql);
        return $query->getResult();
    }

    public function getPedido($id = false) {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['id_pedido' => $id])->first();
    }

    function deleta($id){
        return $this->where(['id_pedido' => $id])->delete();
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

    function carregaDadosSinistro($id){
        $db = db_connect();
        $sql = "SELECT * FROM bd_leet WHERE IZ.id = $id";
        $query = $db->query($sql);
        return $query->row(0);
    }
    


}