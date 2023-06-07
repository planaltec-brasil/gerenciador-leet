<style>

    .form-control{
        background-color: #F5f5f5;
        border-radius: 12px;
        border:none;
    }

    .btn-primary{
        margin-top: 30px;
        border-radius: 12px;
        background-color: #B800FF;
        border:none;
    }

    .btn-primary:hover{
        margin-top: 30px;
        border-radius: 12px;
        background-color: #1B1B1B;
    }

    .corInit{
        background: -webkit-linear-gradient(#B800FF 0%, #FF3D81 100%, #333);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }


</style>
<script>
    $(document).ready(function () {

        var tabela = $('#tb_produto').DataTable({
        dom: "<'row'<'col-sm-6 mt-3 mb-3'B>><'row'<'col-sm-6'l><'col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: ['copy', 'excel', 'pdf'],
        "language": {
            "url": "<?php echo base_url(); ?>assets/media/Portuguese-Brasil.json"
        },
        "ajax": "getProduto",
        columns: [
            { data: 'nome_produto' },
            { data: 'cor_produto' },
            { data: 'estoque_atual' },
            { data: 'estoque_anterior' },
            { data: 'unidade_produto' },
            { data: 'volume_produto' },
            { data: 'material_produto' },
            { data: 'fotos_produto' },
            {
                        data: null,
                        defaultContent: "",
                        render: function (data, type, row) {
                            var html = "<button title='editar registro' type='button' onclick='EditaDadosPR(" + data.id_produto + ")'  class='btn btn-sm btn-outline'><i style='color: #00008B;' class='far fa-edit'></i></button>&nbsp;";

                            return html;
                        }
                    },

                ]
        });
        $("#Enviadados").on('click', function () {
                $.ajax({
                    'url': "InsereDadosProduto",
                    'dataType': "JSON",
                    'type': "POST",
                    data: {
                        'nome_produto': $("#nome_produto").val(),
                        'cor_produto': $("#cor_produto").val(),
                        'estoque_atual': $("#estoque_atual").val(),
                        'estoque_anterior': $("#estoque_anterior").val(),
                        'unidade_produto': $("#unidade_produto").val(),
                        'volume_produto': $("#volume_produto").val(),
                        'material_produto': $("#material_produto").val(),
                        'fotos_produto': $("#fotos_produto").val(),
                        'id_Edita': $("#id_Edita").val() 
                    },
                    success: function (res) {
                        if(res){
                            $("#atualizaTable").click();
                            $("#alerta").html("<div class='alert alert-success'> Sucesso ao Cadastrar!</div>");
                            setTimeout(() => {
                                $("#alerta").html("");
                            }, 2000);
                        }else{
                            $("#alerta").html("<div class='alert alert-danger'>Erro ao inserir os dados!</div>" );
                            setTimeout(() => {
                                $("#alerta").html("");
                            }, 2000);
                        }
                    }
                })
            });

                    // atualizatable
        $("#atualizaTable").on('click', function() {
            tabela.ajax.reload(null, false);
        });
    });

    function EditaDadosPR(id_produto) {
            $.ajax({
                url: "CarregaProduto",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id_produto
                },
                success: function (res) {
                    if (res) {
                        $("#nome_produto").val(res.nome_produto);
                        $("#cor_produto").val(res.cor_produto);
                        $("#estoque_atual").val(res.estoque_atual);
                        $("#estoque_anterior").val(res.estoque_anterior);
                        $("#unidade_produto").val(res.unidade_produto);
                        $("#volume_produto").val(res.volume_produto);
                        $("#material_produto").val(res.material_produto);
                        $("#fotos_produto").val(res.fotos_produto);
                        $("#id_Edita").val(res.id_produto);
                    }
                }
            });
        }

</script>

<div class="main-top">
    <h1 class="corInit">Cadastro de Produtos</h1>
</div>
<div class="main-cadastro-produto mt-3">
    <form class="row g-4">
        <div class="col-md-3">
            <label for="numPedido" class="form-label">Nome do Produto</label>
            <input type="text" id="nome_produto" class="form-control" id="">
        </div>
        <div class="col-md-3">
            <label for="dadosClient" class="form-label">Cor</label>
            <input type="text-color" id="cor_produto" class="form-control" id="">
        </div>
        <div class="col-md-3">
            <label for="dadosProduto" class="form-label">Estoque Atual</label>
            <input type="text" id="estoque_atual" class="form-control" id="" >
        </div>
        <div class="col-md-3">
            <label for="inputAddress2" class="form-label">Estoque anterior</label>
            <input type="text" id="estoque_anterior" class="form-control" id="inputAddress" >
        </div>
        <div class="col-md-3">
            <label for="inputCity" class="form-label">Unidade</label>
            <input type="text" id="unidade_produto" class="form-control" id="inputCity">
        </div>
        <div class="col-md-3">
            <label for="inputState" class="form-label">Volume</label>
            <input type="text" id="volume_produto" class="form-control" id="">
        </div>
        <div class="col-md-3">
            <label for="inputState" class="form-label">Material</label>
            <input type="text" id="material_produto" class="form-control" id="">
        </div>
        <div class="col-md-3">
            <label for="inputState" class="form-label">Fotos do produto</label>
            <input type="file" id="fotos_produto" class="form-control" id="">
            <input type="text" hidden="true" id="id_Edita">
            <button type="button" hidden="true" id="atualizaTable"></button>
        </div>
        <!-- <div class="mb-3">
            <label for="formFile" class="form-label">Fotos do produto</label>
            <input class="form-control" type="file" id="formFile">
        </div> -->
        <div class="col-md-12">
            <button type="button" id="Enviadados" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>

    <div class="main-top mt-3">
        <h1 class="corInit">Lista de Produtos</h1>
    </div>
    <table id="tb_produto" class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Cor</th>
                <th scope="col">Estoque Atual</th>
                <th scope="col">Estoque Anterior</th>
                <th scope="col">Unidade</th>
                <th scope="col">Volume</th>
                <th scope="col">Material</th>
                <th scope="col">Fotos</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
    </table>
</div>