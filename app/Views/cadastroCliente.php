<style>
    .form-control {
        background-color: #F5f5f5;
        border-radius: 12px;
        border: none;
    }

    .btn-primary {
        margin-top: 30px;
        border-radius: 12px;
        background-color: #B800FF;
        border: none;
    }

    .btn-primary:hover {
        margin-top: 30px;
        border-radius: 12px;
        background-color: #1B1B1B;
    }

    .corInit {
        background: -webkit-linear-gradient(#B800FF 0%, #FF3D81 100%, #333);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        $(document).ready(function () {


            // tabela
            var tabela = $('#tb_cliente').DataTable({
                dom: "<'row'<'col-sm-6 mt-3 mb-3'B>><'row'<'col-sm-6'l><'col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: ['copy', 'excel', 'pdf'],
                "language": {
                    "url": "<?php echo base_url(); ?>assets/media/Portuguese-Brasil.json"
                },
                "ajax": "getClientes",
                columns: [
                    { data: 'nome_cliente' },
                    { data: 'cpf_cliente' },
                    { data: 'telefone_cliente' },
                    { data: 'logradouro_cliente' },
                    { data: 'bairro_cliente' },
                    { data: 'numero_cliente' },
                    { data: 'complemento_cliente' },
                    { data: 'cidade_cliente' },
                    { data: 'estado_cliente' },
                    { data: 'cep_cliente' },
                    {
                        "data": null,
                        "defaultContent": "",
                        "render": function(data, type, row) {
                            var ativo_inativo = [];
                            ativo_inativo[0] = 'Ativo';
                            ativo_inativo[1] = 'Inativo';
                            return ativo_inativo[data.ativo_inativo];
                        }
                    },
                    {
                        data: null,
                        defaultContent: "",
                        render: function (data, type, row) {
                            var html = "<button title='editar registro' type='button' onclick='EditaDadosCL(" + data.id_cliente + ")'  class='btn btn-sm btn-outline'><i style='color: #00008B;' class='far fa-edit'></i></button>&nbsp;";
                            if (data.ativo_inativo == 0)
                                html += "<button onclick='situacao_cliente(" +  data.id_cliente + ", 1)' title='inativar registro' type='button' class='btn btn-sm btn-outline'><i style='color: red;' class='far fa-minus-square'></i></button>&nbsp;"; 
                            else
                                html += "<button type='button' title='Reativar Cliente' class='btn btn-sm btn-outline' onclick='situacao_cliente(" + data.id_cliente + ", 0)'><i style='color: green;' class='fa fa-recycle'></i></button>";
                            return html;
                        }
                    },
                ]
            });

            // envio do formulario de cadastro
            $("#btnEnvia").on('click', function () {
                $.ajax({
                    'url': "InsereDadosCliente",
                    'dataType': "JSON",
                    'type': "POST",
                    data: {
                        'nome_cliente': $("#nome_cliente").val(),
                        'cpf_cliente': $("#cpf_cliente").val(),
                        'telefone_cliente': $("#telefone_cliente").val(),
                        'logradouro_cliente': $("#logradouro_cliente").val(),
                        'bairro_cliente': $("#bairro_cliente").val(),
                        'numero_cliente': $("#numero_cliente").val(),
                        'complemento_cliente': $("#complemento_cliente").val(),
                        'cidade_cliente': $("#cidade_cliente").val(),
                        'estado_cliente': $("#estado_cliente").val(),
                        'cep_cliente': $("#cep_cliente").val(),
                        'id_Edita': $("#id_Edita").val()
                    },
                    success: function (res) {
                        if (res) {
                            $("#atualizaTable").click();
                            $("#alerta").html("<div class='alert alert-success'> Sucesso ao Cadastrar!</div>");
                            setTimeout(() => {
                                $("#alerta").html("");
                            }, 2000);
                        } else {
                            $("#alerta").html("<div class='alert alert-danger'>Erro ao inserir os dados!</div>");
                            setTimeout(() => {
                                $("#alerta").html("");
                            }, 2000);
                        }
                    }
                })
            });

            // atualizatable
            $("#atualizaTable").on('click', function () {
                tabela.ajax.reload(null, false);
            });

        })

        function EditaDadosCL(id_cliente) {
            $.ajax({
                url: "CarregaCliente",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id_cliente
                },
                success: function (res) {
                    if (res) {
                        $("#nome_cliente").val(res.nome_cliente);
                        $("#cpf_cliente").val(res.cpf_cliente);
                        $("#telefone_cliente").val(res.telefone_cliente);
                        $("#logradouro_cliente").val(res.logradouro_cliente);
                        $("#bairro_cliente").val(res.bairro_cliente);
                        $("#numero_cliente").val(res.numero_cliente);
                        $("#complemento_cliente").val(res.complemento_cliente);
                        $("#cidade_cliente").val(res.cidade_cliente);
                        $("#estado_cliente").val(res.estado_cliente);
                        $("#cep_cliente").val(res.cep_cliente);
                        $("#id_Edita").val(res.id_cliente);
                    }
                }
            });
        }

        function situacao_cliente(id_cliente, ativo_inativo) {
            if (confirm('Deseja realmente executar essa ação?') === true) {
                $.ajax({
                    url: "situacao_cliente",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        id: id_cliente,
                        situacao: ativo_inativo
                    },
                    
                    success: function(res) {

                        if (ativo_inativo == 1 && res) {
                            $("#alerta").html("<div class='alert alert-info'> Cliente desativado!</div>");
                            setTimeout(() => {
                                $("#alerta").html("");
                            }, 2000);
                        } else if (ativo_inativo == 0 && res) {
                            $("#alerta").html("<div class='alert alert-info'> Cliente reativado!</div>");
                            setTimeout(() => {
                                $("#alerta").html("");
                            }, 2000);
                        } else {
                            $("#alerta").html("<div class='alert alert-info'> Cliente desativado!</div>");
                            setTimeout(() => {
                                $("#alerta").html("");
                            }, 2000);
                        }
                        $("#atualizaTable").click();
                    }
                });
            }
        }

    </script>
</head>

<body>
    <div class="main-top">
        <h1 class="corInit">Cadastro de Clientes</h1>
    </div>
    <div class="main-cadastro-produto">
        <form class="row g-4">
            <div class="col-md-3">
                <label for="numPedido" class="form-label">Nome</label>
                <input type="text" id="nome_cliente" class="form-control" id="">
            </div>
            <div class="col-md-3">
                <label for="dadosClient" class="form-label">CPF</label>
                <input type="text" id="cpf_cliente" class="form-control" id="">
            </div>
            <div class="col-md-3">
                <label for="dadosProduto" class="form-label">Telefone</label>
                <input type="text" id="telefone_cliente" class="form-control" id="">
            </div>
            <div class="col-md-3">
                <label for="inputAddress2" class="form-label">Logradouro</label>
                <input type="text" id="logradouro_cliente" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="inputCity" class="form-label">Bairro</label>
                <input type="text" id="bairro_cliente" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="inputState" class="form-label">Número</label>
                <input type="text" id="numero_cliente" class="form-control" id="">
            </div>
            <div class="col-md-3">
                <label for="inputState" class="form-label">Complemento</label>
                <input type="text" id="complemento_cliente" class="form-control" id="">
            </div>
            <div class="col-md-3">
                <label for="exampleDataList" class="form-label">Selecione a Cidade</label>
                <input class="form-control" id="cidade_cliente" list="datalistOptions" placeholder="Cidade">
                <datalist id="datalistOptions">
                </datalist>
            </div>
            <div class="col-md-3">
                <label for="exampleDataList" class="form-label">Selecione o Estado</label>
                <input class="form-control" id="estado_cliente" list="datalistOptions" placeholder="Estado">
                <datalist id="datalistOptions">
                </datalist>
            </div>
            <div class="col-md-3">
                <label for="inputState" class="form-label">CEP</label>
                <input type="text" class="form-control" id="cep_cliente">
                <input type="text" hidden="true" id="id_Edita">
                <button type="button" hidden="true" id="atualizaTable"></button>
            </div>
            <div class="col-md-3">
                <button type="button" id="btnEnvia" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>

        <div class="main-top mt-5">
            <h1 class="corInit">Lista de Clientes</h1>
        </div>

        <table id="tb_cliente" class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Logradouro</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Número</th>
                    <th scope="col">Complemento</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
        </table>
    </div>
</body>

</html>