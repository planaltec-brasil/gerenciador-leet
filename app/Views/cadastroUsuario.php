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

<script>
    $(document).ready(function () {
        // tabela
        var tabela = $('#tb_usuario').DataTable({
            dom: "<'row'<'col-sm-6 mt-3 mb-3'B>><'row'<'col-sm-6'l><'col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: ['copy', 'excel', 'pdf'],
            "language": {
                "url": "<?php echo base_url(); ?>assets/media/Portuguese-Brasil.json"
            },
            "ajax": "getUsuario",
            columns: [
                { data: 'id_usuario' },
                { data: 'usuario' },
                { data: 'cargo' },
                {
                    "data": null,
                    "defaultContent": "",
                    "render": function(data, type, row) {
                        var inativo_ativo = [];
                        inativo_ativo[0] = 'Ativo';
                        inativo_ativo[1] = 'Inativo';
                        return inativo_ativo[data.inativo_ativo];
                    }
                },
                {
                    data: null,
                    defaultContent: "",
                    render: function (data, type, row) {
                        var html = "<button title='editar registro' type='button' onclick='EditaDadosUs(" + data.id_usuario + ")'  class='btn btn-sm btn-outline'><i style='color: #00008B;' class='far fa-edit'></i></button>&nbsp;";
                        if (data.inativo_ativo == 0)
                            html += "<button onclick='situacao_usuario(" +  data.id_usuario + ", 1)' title='inativar registro' type='button' class='btn btn-sm btn-outline'><i style='color: red;' class='far fa-minus-square'></i></button>&nbsp;"; 
                        else
                            html += "<button type='button' title='Reativar Funcionário' class='btn btn-sm btn-outline' onclick='situacao_usuario(" + data.id_usuario + ", 0)'><i style='color: green;' class='fa fa-recycle'></i></button>";
                        return html;
                    }
                },
            ]
        });
        $("#Enviabtn").on('click', function () {
            $.ajax({
                'url': "InsereDadosUsuario",
                'dataType': "JSON",
                'type': "POST",
                data: {
                    'usuario': $("#usuario").val(),
                    'senha': $("#senha").val(),
                    'cargo': $("#cargo").val(),
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

        $("#atualizaTable").on('click', function () {
            tabela.ajax.reload(null, false);
        });

    });


    function EditaDadosUs(id_usuario) {
        $.ajax({
            url: "CarregaUsuario",
            type: "POST",
            dataType: "JSON",
            data: {
                id: id_usuario
            },
            success: function (res) {
                if (res) {
                    $("#usuario").val(res.usuario);
                    $("#senha").val(res.senha);
                    $("#cargo").val(res.cargo);
                    $("#id_Edita").val(res.id_usuario);
                }
            }
        });
    }

    function situacao_usuario(id_usuario, inativo_ativo) {
            if (confirm('Deseja realmente executar essa ação?') === true) {
                $.ajax({
                    url: "situacao_usuario",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        id: id_usuario,
                        situacao : inativo_ativo
                    },
                    
                    success: function(res) {

                        if (inativo_ativo == 1 && res) {
                            $("#alerta").html("<div class='alert alert-info'> Cliente desativado!</div>");
                            setTimeout(() => {
                                $("#alerta").html("");
                            }, 2000);
                        } else if (inativo_ativo == 0 && res) {
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

<div class="main-top">
    <h1 class="corInit">Cadastro de Usuários</h1>
</div>
<div class="main-cadastro-produto">
    <form class="row g-4">
        <div class="col-md-3">
            <label for="numPedido" class="form-label">Nome de Usuário</label>
            <input type="text" id="usuario" class="form-control" id="">
        </div>
        <div class="col-md-3">
            <label for="dadosClient" class="form-label">Senha</label>
            <input type="text" id="senha" class="form-control" id="">
        </div>
        <div class="col-md-3">
            <label for="inputAddress2" class="form-label">Cargo/Permissões</label>
            <select class="form-select form-control" name="cargo" id="cargo">
                <option>Selecione</option>
            </select>
            <input type="text" hidden="true" id="id_Edita">
            <button type="button" hidden="true" id="atualizaTable"></button>
        </div>
        <div class="col-md-3">
            <button type="button" id="Enviabtn" class="btn btn-primary">Cadastrar</button>
        </div>

        <div class="main-top mt-3">
            <h1 class="corInit">Lista de Usuários</h1>
        </div>
        <table id="tb_usuario" class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
        </table>
</div>