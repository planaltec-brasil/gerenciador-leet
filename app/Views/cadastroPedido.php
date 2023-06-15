<style>
    /* body{
        background-image: url('assets/logolet.png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center; 
        background-size: 20%
    } */

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

    .btn-danger {
        background-color: red;
        width: 100px;
        border: none;
        border-radius: 12px;
    }

    .btnexclui {
        padding-left: 100px;
        text-align: end;
        margin-top: 15px;
    }
</style>
<script>

    $(document).ready(function () {
        carregaProduto();
        carregaCliente();
        function carregaProduto() {
            $.ajax({
                url: 'getall',
                type: 'POST',
                dataType: 'json',
                success: function (res) {
                    //for()

                    for (let i = 0; i < res.length; i++) {
                        $('#produto').append(`<option value="${res[i].id_produto}" >${res[i].nome_produto}</option>`);
                    }
                }
            });
        }

        function carregaCliente() {
            $.ajax({
                url: "getCliente",
                type: "POST",
                dataType: "JSON",
                success: function (res) {
                    //for()
                    $('#addCliente').html('');
                    for (let i = 0; i < res.length; i++) {
                        $('#addCliente').append(`<option value="${res[i].id_cliente}" >${res[i].nome_cliente}</option>`);
                    }
                    $('#addCliente').selectpicker('refresh');
                }

            });
        }


        var tabela = $('#tb_pedido').DataTable({
            dom: "<'row'<'col-sm-6 mt-3 mb-3'B>><'row'<'col-sm-6'l><'col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: ['copy', 'excel', 'pdf'],
            "language": {
                "url": "<?php echo base_url(); ?>assets/media/Portuguese-Brasil.json"
            },
            "columnDefs": [
                {
                    type: 'date-uk',
                    targets: 4
                },
                {
                    type: 'date-uk',
                    targets: 5//11
                },
                {
                    type: 'date-uk',
                    targets: 6//11
                },
            ],
            "ajax": "getPedido",
            columns: [
                { data: 'numero_pedido' },
                { data: 'dados_cliente' },
                { data: 'telefone_cliente' },
                {
                    data: null,
                    defaultContent: "",
                    render: function (data, type, row) {
                        return row.dados_produto;
                    }
                },
                {
                    "data": null,
                    "defaultContent": "",
                    "render": function (data, type, row) {
                        return row.data_pedido.split('-').reverse().join('/');
                    }
                },
                {
                    "data": null,
                    "defaultContent": "",
                    "render": function (data, type, row) {
                        return row.data_evento.split('-').reverse().join('/');
                    }
                },
                {
                    "data": null,
                    "defaultContent": "",
                    "render": function (data, type, row) {
                        return row.data_entrega.split('-').reverse().join('/');
                    }
                },
                {
                    data: null,
                    defaultContent: "",
                    render: function (data, type, row) {
                        return row.valor_frete.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
                    }
                },
                {
                    data: null,
                    defaultContent: "",
                    render: function (data, type, row) {
                        return row.valor_unitario.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
                    }
                },
                {
                    data: null,
                    defaultContent: "",
                    render: function (data, type, row) {
                        return row.valor_total.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
                    }
                },
                {
                    data: null,
                    defaultContent: "",
                    render: function (data, type, row) {
                        return row.valor_sinal.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
                    }
                },
                {
                    data: null,
                    defaultContent: "",
                    render: function (data, type, row) {
                        return row.falta_pagar.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
                    }
                },
                {
                    data: null,
                    defaultContent: "",
                    render: function (data, type, row) {
                        var html = "<button title='editar registro' type='button' onclick='EditaDados(" + data.id_pedido + ")'  class='btn btn-sm btn-outline'><i style='color: #00008B;' class='far fa-edit'></i></button>&nbsp;";
                        html += "<button type='button' style='color:red'; onclick='ExcluiDados(" + data.id_pedido + ")' ><i class='fa-solid fa-trash'></i></button>";
                        return html;
                    }
                },

            ]
        });


        $("#Btncadas").on('click', function () {
            var qtd = [];
            var idProd = [];
            $.each($('input[name="qtdPrd[]"]'), function (idx, obj) {
                qtd.push($(obj).val());
                idProd.push($("input[name='id_Produto[]']").eq(idx).val());
            });

            $.ajax({
                'url': "InsereDadosPedido",
                'dataType': "JSON",
                'type': "POST",
                data: {
                    'numero_pedido': $("#numero_pedido").val(),
                    'dados_cliente': $("#dados_cliente").val(),
                    'dados_arte': $("#dados_arte").val(),
                    'data_pedido': $("#data_pedido").val(),
                    'data_evento': $("#data_evento").val(),
                    'data_entrega': $("#data_entrega").val(),
                    'cep_pedido': $("#cep_pedido").val(),
                    'valor_frete': $("valor_frete").val(),
                    'retirada_envio': $("#retirada_envio").val(),
                    'valor_unitario': $("#valor_unitario").val(),
                    'valor_total': $("#valor_total").val(),
                    'valor_sinal': $("#valor_sinal").val(),
                    'falta_pagar': $("#falta_pagar").val(),
                    'dados_produto': $("#dados_produto").val(),
                    'qtdPrd': qtd,
                    'id_Produto': idProd,
                    'id_Edita': $("#id_Edita").val()
                },
                success: function (res) {
                    if (res) {
                        $("#alerta").html("<div class='alert alert-success'> Sucesso ao Cadastrar!</div>");
                        setTimeout(() => {
                            $("#alerta").html("");
                        }, 2000);
                        $("#atualizaTable").click();
                        $("#numero_pedido").val("")
                        $("#dados_cliente").val("")
                        $("#dados_arte").val("")
                        $("#data_pedido").val("")
                        $("#data_evento").val("")
                        $("#data_entrega").val("")
                        $("#cep_pedido").val("")
                        $("valor_frete").val("")
                        $("#retirada_envio").val("")
                        $("#valor_unitario").val("")
                        $("#valor_total").val("")
                        $("#valor_sinal").val("")
                        $("#falta_pagar").val("")
                        $("#dados_produto").val("")
                        $("#id_Edita").val("")
                    } else {
                        $("#alerta").html("<div class='alert alert-danger'>Erro ao inserir os dados!</div>");
                        setTimeout(() => {
                            $("#alerta").html("");
                        }, 2000);
                    }
                }
            })
        });

        $.ajax({
            url: "listaEstado",
            type: "POST",
            dataType: "JSON",
            data: {},
            success: function (res) {
                var html = "";
                $.each(res, function (idx, obj) {
                    html += `<option value="${obj.id}">${obj.nome + " - " + obj.sigla}</option>`;
                });
                $('#estado').append(html);
            }
        })

        // atualizatable
        $("#atualizaTable").on('click', function () {
            tabela.ajax.reload(null, false);
        });



        $("#addProduto").on('click', function () {
            $.ajax({
                url: "CarregaProduto",
                dataType: "json",
                type: "post",
                data: { id: $("#produto").val() },
                success: function (res) {
                    var html = "";
                    html += `<div class="col-4 produto-${res.id_produto}">`;
                    html += `<div class="card mb-3 shadow p-3 mb-5 bg-body rounded">`;
                    html += `<small>Descrição do Produto:</small>`;
                    html += `<div class="row g-0">`;
                    html += `<div class="col-md-4 d-flex justify-content-center align-items-center">`;
                    html += `<img src='data:image/jpeg;base64,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' class="img-fluid rounded-start" alt="...">`;
                    html += `</div>`;
                    html += `<div class="col-md-8" style="height: 150px">`;
                    html += `<div class="card-body">`;
                    html += `<h5 class="card-title">${res.nome_produto}</h5>`;
                    html += `<div>`;
                    html += `<label for="qtdPrd">QTD</label>`;
                    html += `<input id="id_Produto" name="id_Produto[]" type="hidden" value="${res.id_produto}" />`;
                    html += `<input id="qtdPrd" name="qtdPrd[]" type="number" value="1" class="form-control qtdPrd-${res.id_produto}" />`;
                    html += `</div>`;
                    html += `<div class="btnexclui"`;
                    html += '<button type="button" class="btn btn-danger" style="color:red"; onclick="excluiInput(this)"><i class="fa-solid fa-trash"></i></button>';
                    html += `</div>`;
                    html += `</div>`;
                    html += `</div>`;
                    html += `</div>`;
                    html += `</div>`;
                    html += `</div>`;

                    let teste = $(".produto-" + res.id_produto);

                    if (teste.length < 1) {
                        $("#produtosAdd").append(html);
                    } else {
                        valorAt = $(".qtdPrd-" + res.id_produto).val();
                        $(".qtdPrd-" + res.id_produto).val(parseInt(valorAt) + 1);
                    }
                }
            });
        });

        $("#btnEnvia").on('click', function () {
            $.ajax({
                'url': "InsereDadosCliente",
                'dataType': "JSON",
                'type': "POST",
                data: {
                    'nome_cliente': $("#nome_cliente").val(),
                    'cpf_cliente': $("#cpf_cliente").val(),
                    'telefone_cliente': $("#telefone_cliente").val(),
                    'cidade_cliente': $("#cidade").val(),
                    'estado_cliente': $("#estado").val(),
                    'cep_cliente': $("#cep_cliente").val(),
                    'id_Edita': $("#id_Edita").val()
                },
                success: function (res) {
                    if (res) {
                        carregaCliente();
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

        $('#mymodal').on('click', function () {
            $('#nome_cliente').val("");
            $('#telefone_cliente').val("");
            $('#cpf_cliente').val("");
            $('#cep_cliente').val("");
            $("#exampleModal").modal('show');
        });



    });


    function EditaDados(id_pedido) {
        $.ajax({
            url: "CarregaPedido",
            type: "POST",
            dataType: "JSON",
            data: {
                id: id_pedido
            },
            success: function (res) {
                if (res) {
                    $("#numero_pedido").val(res.numero_pedido);
                    $("#dados_cliente").val(res.dados_cliente);
                    $("#dados_arte").val(res.dados_arte);
                    $("#data_pedido").val(res.data_pedido);
                    $("#data_evento").val(res.data_evento);
                    $("#data_entrega").val(res.data_entrega);
                    $("#cep_pedido").val(res.cep_pedido);
                    $("#valor_frete").val(res.valor_frete);
                    $("#retirada_envio").val(res.retirada_envio);
                    $("#valor_unitario").val(res.valor_unitario);
                    $("#valor_total").val(res.valor_total);
                    $("#valor_sinal").val(res.valor_sinal);
                    $("#falta_pagar").val(res.falta_pagar);
                    $("#dados_produto").val(res.dados_produto);
                    $("#id_Edita").val(res.id_pedido);
                }
            }
        });
    }

    function excluiInput(_this) {
        $(_this).parent().parent().parent().parent().parent().remove();
    }

    async function ExcluiDados(id_pedido) {
        if (confirm('Deseja realmente executar essa ação?') === true) {
            await $.ajax({
                url: "excluiProdPedido",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id_pedido
                },
                success: function (res) {
                    $.ajax({
                        url: "excluiPedido",
                        type: "POST",
                        dataType: "JSON",
                        data: { id: id_pedido },
                    });
                    if (res) {
                        $("#atualizaTable").click();
                        $("#alerta").html("<div class='alert alert-info'> Sucesso ao Deletar!</div>");
                        setTimeout(() => {
                            $("#alerta").html("");
                        }, 2000);
                    }
                }
            });
        }
    }





    var add_button = $(".add_field_button"); //Add button ID
    $(add_button).click(function (e) {
        $(add_button).click(function (e) {

        });
    });



    function cidadeporID(idestado, nomeCidade) {
        var idEstado = ($('#estado').val() == "" || $('#estado').val() == null) ? idestado : $('#estado').val();
        $.ajax({
            url: "cidadeporID",
            type: "POST",
            dataType: "JSON",
            data: {
                idEstado: idEstado
            },
            success: function (res) {
                $('#cidade').empty();
                var html = "";
                $.each(res, function (idx, obj) {
                    html += `<option value="${obj.id}" ${(obj.nome == nomeCidade) ? 'selected' : ''}>${obj.nome}</option>`;
                });
                $('#cidade').append(html);
            }
        })
    }

    function getCep(cep) {
        // url: "https://viacep.com.br/ws/"+$('#cep').val,
        $.ajax({
            url: `https://viacep.com.br/ws/${cep}/json/`,
            type: "GET",
            dataType: "JSON",
            headers: { 'content-type': 'application/json;charset=utf-8' },
            data: {},
            success: function (res) {
                $.post("listaEstado", function (data) {
                    var listEst = JSON.parse(data);
                    var html = "";
                    $.each(listEst, function (idx, obj) {
                        html += `<option value="${obj.id}" ${(obj.sigla == res.uf) ? 'selected' : ""}>${obj.nome + " - " + obj.sigla}</option>`;
                    });
                    $('#estado').append(html);
                });

                $.post("pegaId", { sigla: res.uf }, function (data) {
                    var idEst = JSON.parse(data);
                    console.log(idEst)
                    cidadeporID(idEst[0].id, res.localidade);
                });

            }
        })
    }




</script>
<script type="text/javascript">
    function maskIt(w, e, m, r, a) {
        // Cancela se o evento for Backspace
        if (!e) var e = window.event
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        // Variáveis da função
        var txt = (!r) ? w.value.replace(/[^\d]+/gi, '') : w.value.replace(/[^\d]+/gi, '').reverse();
        var mask = (!r) ? m : m.reverse();
        var pre = (a) ? a.pre : "";
        var pos = (a) ? a.pos : "";
        var ret = "";
        if (code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g, '').length) return false;
        // Loop na máscara para aplicar os caracteres
        for (var x = 0, y = 0, z = mask.length; x < z && y < txt.length;) {
            if (mask.charAt(x) != '#') {
                ret += mask.charAt(x); x++;
            }
            else {
                ret += txt.charAt(y); y++; x++;
            }
        }
        // Retorno da função
        ret = (!r) ? ret : ret.reverse()
        w.value = pre + ret + pos;
    }

    // Novo método para o objeto 'String'
    String.prototype.reverse = function () {
        return this.split('').reverse().join('');
    }
</script>
<div class="main-top">
    <h1 class="corInit">Cadastro de Pedidos</h1>
    <span id="alerta" style="text-align:center"></span>
</div>
<div class="main-cadastro-produto">
    <form class="row g-4 was-validated">
        <div class="col-md-3">
            <label for="numPedido" class="form-label">Número de pedido</label>
            <input type="text" class="form-control" id="numero_pedido">
        </div>
        <div class="col-md-3">
            <label for="dadosClient" class="form-label">Dados do Cliente</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-circle-plus" style="color:purple;" type="button"
                id="mymodal" data-bs-toggle="modal" data-bs-whatever="@getbootstrap" title="Adicionar Cliente"
                required></i>
            <select name="" id="addCliente" class="selectpicker form-control">
                    
            </select>
        </div>

        <div class="col-md-3">
            <label for="inputAddress2" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone_cliente" required>
        </div>
        <div class="col-md-3">
            <label for="inputAddress2" class="form-label">Produto</label>
            <input type="text" class="form-control" id="dados_arte" required>
        </div>
        <div class="col-md-3">
            <label for="inputState" class="form-label">CEP</label>
            <input type="text" class="form-control" onblur="getCep(this.value)" required>
            <input type="text" hidden="true" id="id_Edita">
            <button type="button" hidden="true" id="atualizaTable"></button>
        </div>
        <div class="col-md-3">
            <label for="numPedido" class="form-label">Data do Pedido</label>
            <input type="date" value="<?php echo date('01/m/Y') ?>" class="form-control" id="data_pedido" required>
        </div>
        <div class="col-md-3">
            <label for="dadosClient" class="form-label">Data do Evento</label>
            <input type="date" class="form-control" value="<?php echo date('01/m/Y') ?>" id="data_evento" required>
        </div>
        <div class="col-md-3">
            <label for="dadosProduto" class="form-label">Data da Entrega</label>
            <input type="date" class="form-control" value="<?php echo date('01/m/Y') ?>" id="data_entrega" required>
        </div>
        <div class="col-md-3">
            <label for="inputAddress2" class="form-label">Valor do Frete</label>
            <input type="text" class="form-control" id="valor_frete" onKeyUp="maskIt(this,event,'#########.##',true)"
                required>
        </div>
        <div class="col-md-3">
            <label for="inputAddress2" class="form-label">Retirada/Envio</label>
            <input type="date" class="form-control" value="<?php echo date('01/m/Y') ?>" id="retirada_envio" required>
        </div>
        <div class="col-md-3">
            <label for="numPedido" class="form-label">Valor Unitário</label>
            <input type="text" class="form-control" id="valor_unitario" onKeyUp="maskIt(this,event,'#########.##',true)"
                dir="rtl" required>
        </div>
        <div class="col-md-3">
            <label for="dadosClient" class="form-label">Valor Total</label>
            <input type="text" class="form-control" id="valor_total" onKeyUp="maskIt(this,event,'#########.##',true)"
                dir="rtl" required>
        </div>
        <div class="col-md-3">
            <label for="dadosProduto" class="form-label">Valor Sinal</label>
            <input type="text" class="form-control" id="valor_sinal" onKeyUp="maskIt(this,event,'#########.##',true)"
                dir="rtl" required>
        </div>
        <div class="col-md-3">
            <label for="inputAddress2" class="form-label">Falta Pagar</label>
            <input type="text" class="form-control" id="falta_pagar" onKeyUp="maskIt(this,event,'#########.##',true)"
                dir="rtl" required>
            <input type="text" hidden="true" id="id_Edita">
            <button type="button" hidden="true" id="atualizaTable"></button>
        </div>
        <div class="col-md-3">
            <label for="produtos" class="form-label">Produtos</label>
            <select class="form-select form-control" aria-label="Default select example" id="produto">
                <option value="">Selecione</option>
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary" type="button" id="addProduto"><i
                    class="fa-solid fa-circle-plus"></i>Adicionar</button>
            <button type="button" id="Btncadas" class="btn btn-primary">Cadastrar</button>
        </div>
        <div class='row mt-3' id="produtosAdd">

        </div>
    </form>

    <div class="main-top mt-5">
        <h1 class="corInit">Lista de Pedidos</h1>
    </div>

    <table id="tb_pedido" class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Pedidos</th>
                <th scope="col">Cliente</th>
                <th scope="col">Telefone</th>
                <th scope="col">Produto</th>
                <!-- <th scope="col">CEP</th> -->
                <th scope="col">Data do Pedido</th>
                <th scope="col">Data do Evento</th>
                <th scope="col">Data da Entrega</th>
                <th scope="col">Valor do Frete</th>
                <!-- <th scope="col">Retirada/Envio</th> -->
                <th scope="col">Valor Unitário</th>
                <th scope="col">Valor Total</th>
                <th scope="col">Valor Sinal</th>
                <th scope="col">Falta Pagar</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nome</label>
                            <input id="nome_cliente" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Telefone</label>
                            <input class="form-control" id="telefone_cliente" required>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">CPF</label>
                            <input class="form-control" id="cpf_cliente" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputState" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cep_cliente" required
                                onblur="getCep(this.value)">
                            <input type="text" hidden="true" id="id_Edita">
                            <button type="button" hidden="true" id="atualizaTable"></button>
                        </div>
                        <div class="md-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estados" id="estado" class="form-select form-control"
                                aria-label="Default select example" onchange="cidadeporID();">
                                <option value="">Selecione o Estado</option>
                            </select>
                        </div>
                        <div class="md-3">
                            <label for="cidade" class="form-label">Cidade</label>
                            <select name="cidade" id="cidade" class="form-select form-control"
                                aria-label="Default select example">
                                <option value="">Aguardando estado</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" style="background-color:black"
                        data-bs-dismiss="modal">Fechar</button>
                    <button type="button" id="btnEnvia" class="btn btn-primary"
                        data-bs-dismiss="modal">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
</div>