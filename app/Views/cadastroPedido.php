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

    .efeitoPeds {
        background: -webkit-linear-gradient(#B800FF 0%, #FF3D81 100%, #333);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .nav-pedido .active {
        color: #fff !important;
        background: -webkit-linear-gradient(#B800FF 0%, #FF3D81 100%, #333) !important;
    }

    .nav-pedido .nav-link {
        color: #B800FF;
    }

    .pre {
        width: 80px;
        height: 80px;
        background-image: url("assets/img/load.jpg");
        background-position: center;
        background-size: contain;
        animation: load 2s infinite linear;
    }

    .box-load {
        position: absolute;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #tempPedidoFoto{
        width: 60%;
    }

    @keyframes load {
        to {
            transform: rotate(360deg)
        }
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
                        $('#addCliente').append(`<option data-subtext="${res[i].telefone_cliente}" value="${res[i].id_cliente}" >${res[i].nome_cliente}</option>`);
                    }
                    $('#addCliente').selectpicker('destroy');
                    $('#addCliente').selectpicker();
                }

            });
        }

        $('#addCliente').on('change', function () {
            var telefone = $('option:selected', this).attr("data-subtext");
            $("#telefone_pedido").val(telefone);
        });

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
                    targets: 0,
                    data: null,
                    defaultContent: '',
                    orderable: false,
                    className: 'select-checkbox'
                },
                // {
                //     type: 'date-uk',
                //     targets: 3
                // },
                {
                    type: 'date-uk',
                    targets: 4//11
                },
                {
                    type: 'date-uk',
                    targets: 5//11
                },
            ],
            order: [[1, 'asc']],
            "ajax": "getPedido",
            columns: [
                {
                    data: null,
                    defaultContent: "",
                    render: function (data, type, row) {
                        return "<input class='selectCheck' type='checkbox' value='" + row.id_pedido + "' />";
                    }
                },
                { data: 'id_pedido', defaultContent: "", },
                { data: 'nome_cliente', defaultContent: "", },
                { data: 'dados_arte', defaultContent: "", },
                {
                    "data": null,
                    "defaultContent": "",
                    "render": function (data, type, row) {
                        return row.data_pedido.split('-').reverse().join('/');
                    }
                },
                // {
                //     "data": null,
                //     "defaultContent": "",
                //     "render": function (data, type, row) {
                //         return row.data_evento.split('-').reverse().join('/');
                //     }
                // },
                {
                    "data": null,
                    "defaultContent": "",
                    "render": function (data, type, row) {
                        return row.data_entrega.split('-').reverse().join('/');
                    }
                },
                // {
                //     data: null,
                //     defaultContent: "",
                //     render: function (data, type, row) {
                //         return row.valor_frete.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
                //     }
                // },
                // {
                //     data: null,
                //     defaultContent: "",
                //     render: function (data, type, row) {
                //         return row.valor_unitario.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
                //     }
                // },
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

        $('#tb_pedido tbody').on('click', 'tr', function () {
            var tr = $(this);
            var td = $('td', tr);
            var input = $('.selectCheck', $(td.eq(0)));
            if (input.is(":focus") == false) {
                if (input.prop('checked') == true)
                    input.prop('checked', false);
                else
                    input.prop('checked', true);
            }
        });

        $("#Btncadas").on('click', function () {
            if (
                $("#addCliente").val() == "" ||
                $("#fotos").val() == "" ||
                $("#telefone_pedido").val() == "" ||
                $("#dados_arte").val() == "" ||
                $("#estadoProd").val() == "" ||
                $("#data_pedido").val() == "" ||
                $("#data_evento").val() == "" ||
                $("#data_entrega").val() == "" ||
                $("#retirada_envio").val() == "" ||
                $("#valor_frete").val() == "" ||
                $("#valor_total").val() == "" ||
                $("#valor_sinal").val() == "" ||
                $("#falta_pagar").val() == "" ||
                $("#produtosAdd").html() == ""
                // $("#qtdPrd").val() == "" ||
                // $("#valorProd").val() == "" ||
                // $("#acrescimo").val() == ""

            ) {
                alert(' Todos os campos são obrigatórios ');
                return;
            } else {

                var qtd = [];
                var idProd = [];
                var fotos = [];
                var id_produto_pedido = [];
                var acrescimos = [];
                var valorProd = [];

                var files = $("#fotos")[0].files[0];
                var date = $("#data_pedido").val().split('-').reverse().join('_');
                var ext = files.type.split('/');

                var myNewFile = new File([files], 'DOCLEET_' + date + '_<?php echo date('His'); ?>' + '.' + ext[1], { type: files.type });

                $.each($('input[name="qtdPrd[]"]'), function (idx, obj) {
                    qtd.push($(obj).val());
                    idProd.push($("input[name='id_Produto[]']").eq(idx).val());
                    id_produto_pedido.push($("input[name='id_produto_pedido[]']").eq(idx).val());
                    valorProd.push($("input[name='valorProd[]']").eq(idx).val());
                    acrescimos.push($("select[name='acrescimo[]']").eq(idx).val().join());
                });

                $.ajax({
                    'url': "InsereDadosPedido",
                    'dataType': "JSON",
                    'type': "POST",
                    data: {
                        'cliente': $("#addCliente").val(),
                        'dados_arte': $("#dados_arte").val(),
                        'data_pedido': $("#data_pedido").val(),
                        'data_evento': $("#data_evento").val(),
                        'data_entrega': $("#data_entrega").val(),
                        'cep_pedido': $("#cep_pedido").val(),
                        'valor_frete': $("#valor_frete").val(),
                        'retirada_envio': $("#retirada_envio").val(),
                        'valor_total': $("#valor_total").val(),
                        'valor_sinal': $("#valor_sinal").val(),
                        'falta_pagar': $("#falta_pagar").val(),
                        'foto_pedido': myNewFile.name,
                        'qtdPrd': qtd,
                        'id_Produto': idProd,
                        'id_produto_pedido': id_produto_pedido,
                        // 'fotos': fotos,
                        'valorProd': valorProd,
                        'id_Acrescimo': acrescimos,
                        'cidade_pedido': $("#cidadeProd").val(),
                        'estado_pedido': $("#estadoProd").val(),
                        'logradouro_pedido': $("#Logradouro").val(),
                        'bairro_pedido': $("#bairro").val(),
                        'complemento_pedido': $("#complemento").val(),
                        'id_Edita': $("#id_Edita").val()
                    },
                    success: function (res) {
                        if (res) {
                            fazUpload(myNewFile);
                            $("#produtosAdd").html('');
                            alert('Cadastrado com sucesso');
                            // $("#alerta").html("<div class='alert alert-success'> Sucesso ao Cadastrar!</div>");
                            // setTimeout(() => {
                            //     $("#alerta").html("");
                            // }, 2000);
                            $("#atualizaTable").click();
                            $("#addCliente").val("")
                            $("#dados_arte").val("")
                            $("#data_pedido").val("")
                            $("#data_evento").val("")
                            $("#data_entrega").val("")
                            $("#cep_pedido").val("")
                            $("#valor_frete").val("")
                            $("#retirada_envio").val("")
                            $("#valor_unitario").val("")
                            $("#valor_total").val("")
                            $("#valor_sinal").val("")
                            $("#falta_pagar").val("")
                            $("#estadoProd").val("")
                            $("#cidadeProd").val("")
                            $("#id_Edita").val("")
                        } else {
                            alert('Erro ao Cadastrar');
                            $("#alerta").html("<div class='alert alert-danger'>Erro ao inserir os dados!</div>");
                            setTimeout(() => {
                                $("#alerta").html("");
                            }, 2000);
                        }
                    }
                })
            }

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

        $('#geraPdf').on('click', function () {
            var arr = [];
            $.each($('.selectCheck:checked'), function (idx, obj) {
                arr.push($(obj).val());
            });



            // $.post("https://gsplanaltec.com/GerenciamentoServicos/APIControle/s3files", {file: res.foto_pedido , path: 'uploadLeet', json : true}, function (data) {
//                 var myfile = JSON.parse(data);
//                 $('#tempPedidoFoto').attr("src",myfile);
//             });
            if(arr.length == 0) {
                alert('Selecione pelo menos um registro!'); 
                return;
            }

            window.location = 'pdfLeet?ids=' + arr.join(',');
        });

        $("#cep_cliente").keypress(function () {
            $(this).mask('00000-000');
        });

        $("#cep_pedido").keypress(function () {
            $(this).mask('00000-000');
        });

        $("#telefone_cliente").keypress(function () {
            $(this).mask('(00)0 0000-0000');
        });

        $("#cpf_cliente").keypress(function () {
            $(this).mask('000.000.000-00');
        });

        $("#addProduto").on('click', async function () {
            $.ajax({
                url: "CarregaProduto",
                dataType: "json",
                type: "post",
                data: { id: $("#produto").val() },
                success: async function (res) {
                    var html = "";
                    // html += `<div class="box-load">`
                    // html += `<div class="pre"> Carregando...</div`
                    // html += `</div`
                    html += `<div class="col-md-4 col-sm-12 produto-${res.id_produto}">`;
                    html += `<div class="card mb-3 shadow p-3 mb-5 bg-body rounded">`;
                    html += `<div class="d-flex justify-content-between" ><small>Descrição do Produto:</small>`;
                    html += '<a href="#" style="color:red;" onclick="excluiInput(this)" ><i class="fa-solid fa-trash"></i></a></div>';
                    html += `<div class="row g-0">`;
                    // html += `<div class="col-md-4 d-flex justify-content-center align-items-center">`;
                    // html += `<img style="width: 100%" src='assets/img/image.png' class="img-fluid rounded-start" alt="...">`;
                    // html += `<span style="display: none;" >Carregando...</span>`;
                    // html += `<a href="#" onclick="$('.file-${res.id_produto}').click()" ><i class="fa-solid fa-pen-to-square"></i></a>`
                    // html += `<input onchange="readURL(this)" class="file-${res.id_produto} myfile" type="file" name="prodFile[]" style="visibility: hidden;" />`;
                    // html += `</div>`;
                    html += `<div class="col-md-12" >`;
                    html += `<div class="card-body">`;
                    html += `<h5 class="card-title">${res.nome_produto}</h5>`;
                    html += `<div class='row'>`;
                    html += `<div class='col-12'>`;
                    html += `<label for="qtdPrd">Quantidade</label>`;
                    html += `<input id="id_produto_pedido" name="id_produto_pedido[]" type="hidden" />`;
                    html += `<input id="id_Produto" name="id_Produto[]" type="hidden" value="${res.id_produto}" />`;
                    html += `<input id="qtdPrd" name="qtdPrd[]" type="text" value="1" oninput="calculaTotalPedido()" class="form-control qtdPrd-${res.id_produto}" />`;
                    html += `</div>`;
                    html += `<div class='col-12 pt-1'>`;
                    html += `<label for="valorProd">Valor</label>`;
                    html += `<input id="valorProd" name="valorProd[]" oninput="calculaTotalPedido()" type="text" value="${res.valor_venda}" class="form-control valorProd-${res.id_produto}" />`;
                    html += `</div>`;
                    html += `<div class='col-12 pt-1'>`;
                    html += `<label for="acrescimo">Acréscimo</label>`;
                    html += `<select name="acrescimo[]" id="acrescimo" class="acrescimo form-select form-control" multiple onchange="calculaTotalPedido()">`
                    html += `</select>`
                    html += `</div>`;
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

                    await ListaAcrescimo();
                    calculaTotalPedido();
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

    async function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = async function (e) {
                $('#tempPedidoFoto').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function calculaTotalPedido() {
        var total = 0;
        $.each($('input[name="valorProd[]"]'), function (idx, obj) {
            var qtd = Number($('input[name="qtdPrd[]"]').eq(idx).val());
            total += (Number($(obj).val()) * qtd);

            $.each($('option:selected', $("select[name='acrescimo[]']").eq(idx)), function (idx2, obj2) {
                var acrescimo = Number($(obj2).attr("data-subtext").toString().replace('R$', ''));
                total += qtd * acrescimo;
            });
        });

        $("#valor_total").val(total.toFixed(2));

        $('#falta_pagar').val((Number($('#valor_total').val()) - Number($("#valor_sinal").val())).toFixed(2))
    }

    async function EditaDados(id_pedido) {
        $("#pills-cadastro-tab").click();
        $.ajax({
            url: "CarregaPedido",
            type: "POST",
            dataType: "JSON",
            data: {
                id: id_pedido
            },
            success: async function (res) {
                var resProdutos = res['produtos'];
                var res = res['pedidos'];
                if (res) {
                    if(res.foto_pedido){
                        $.post("https://gsplanaltec.com/GerenciamentoServicos/APIControle/s3files", {file: res.foto_pedido , path: 'uploadLeet', json : true}, function (data) {
                            var myfile = JSON.parse(data);
                            $('#tempPedidoFoto').attr("src",myfile);
                        });
                    }

                    $("#addCliente").selectpicker('val', res.cliente).change();
                    $("#dados_arte").val(res.dados_arte);
                    $("#data_pedido").val(res.data_pedido);
                    $("#data_evento").val(res.data_evento);
                    $("#data_entrega").val(res.data_entrega);
                    $("#cep_pedido").val(res.cep_pedido).blur();
                    $("#valor_frete").val(res.valor_frete);
                    $("#retirada_envio").val(res.retirada_envio);
                    $("#valor_total").val(res.valor_total);
                    $("#valor_sinal").val(res.valor_sinal);
                    $("#falta_pagar").val(res.falta_pagar);
                    $("#id_Edita").val(res.id_pedido);

                    $("#produtosAdd").html('');

                    for (var i = 0; i < resProdutos.length; i++) {
                        var html = "";
                        html += `<div class="col-md-4 col-sm-12 produto-${resProdutos[i].id_produto}">`;
                        html += `<div class="card mb-3 shadow p-3 mb-5 bg-body rounded">`;
                        html += `<div class="d-flex justify-content-between" ><small>Descrição do Produto:</small>`;
                        html += '<a href="#" style="color:red;" onclick="excluiInput(this)" ><i class="fa-solid fa-trash"></i></a></div>';
                        html += `<div class="row g-0">`;
                        // html += `<div class="col-md-4 d-flex justify-content-center align-items-center">`;
                        // html += `<img style="width: 100%" src='${(resProdutos[i].foto != '' && resProdutos[i].foto != null ? resProdutos[i].foto : 'assets/img/image.png')}' class="img-fluid rounded-start" alt="...">`;
                        // html += `<span style="display: none;" >Carregando...</span>`;
                        // html += `<a href="#" onclick="$('.file-${resProdutos[i].id_produto}').click()" ><i class="fa-solid fa-pen-to-square"></i></a>`;
                        // html += `<input onchange="readURL(this)" class="file-${resProdutos[i].id_produto} myfile" type="file" name="prodFile[]" style="visibility: hidden;" />`;
                        // html += `</div>`;
                        html += `<div class="col-md-12" >`;
                        html += `<div class="card-body">`;
                        html += `<h5 class="card-title">${resProdutos[i].nome_produto}</h5>`;
                        html += `<div class='row'>`;
                        html += `<div class='col-12'>`;
                        html += `<label for="qtdPrd">Quantidade</label>`;
                        html += `<input id="id_produto_pedido" name="id_produto_pedido[]" type="hidden" value="${resProdutos[i].id}" />`;
                        html += `<input id="id_Produto" name="id_Produto[]" type="hidden" value="${resProdutos[i].id_produto}" />`;
                        html += `<input id="qtdPrd" name="qtdPrd[]" type="text" oninput="calculaTotalPedido()" value="${resProdutos[i].qtd}" class="form-control qtdPrd-${resProdutos[i].id_produto}" />`;
                        html += `</div>`;
                        html += `<div class='col-12 pt-1'>`;
                        html += `<label for="valorProd">Valor</label>`;
                        html += `<input id="valorProd" name="valorProd[]" type="text" oninput="calculaTotalPedido()" value="${resProdutos[i].valor_produto}" class="form-control valorProd-${res.id_produto}" />`;
                        html += `</div>`;
                        html += `<div class='col-12 pt-1'>`;
                        html += `<label for="acrescimo">Acréscimo</label>`;
                        html += `<select name="acrescimo[]" id="acrescimo" class="acrescimo form-select form-control" multiple onchange="calculaTotalPedido()">`
                        html += `</select>`
                        html += `</div>`;
                        html += `</div>`;
                        html += `</div>`;
                        html += `</div>`;
                        html += `</div>`;
                        html += `</div>`;
                        html += `</div>`;

                        let teste = $(".produto-" + resProdutos[i].id_produto);

                        if (teste.length < 1) {
                            $("#produtosAdd").append(html);
                        } else {
                            valorAt = $(".qtdPrd-" + resProdutos[i].id_produto).val();
                            $(".qtdPrd-" + resProdutos[i].id_produto).val(parseInt(valorAt) + 1);
                        }

                        await ListaAcrescimo(res.id_pedido, resProdutos[i].id_produto);
                    }

                    // calculaTotalPedido();
                }
            }
        });

    }

    async function ListaAcrescimo(idPedido = null, idProduto = null) {
        $.ajax({
            url: "ListaAcrescimo",
            type: "POST",
            dataType: "JSON",
            data: {
                idPedido: idPedido,
                idProduto: idProduto
            },
            success: function (res) {
                var acrescimos = [];
                if (idPedido != null && idProduto != null) {
                    var _acrescimos = res['acrescimosUpd'];
                    for (var i = 0; i < _acrescimos.length; i++) {
                        acrescimos.push(_acrescimos[i]['id_acrescimo']);
                    }
                }

                res = res['acrescimos'];

                var select = idProduto == null ? $("select[name='acrescimo[]']") : $("select[name='acrescimo[]']", $(".produto-" + idProduto));//idProduto == null ? $("select[name='acrescimo[]']", $(".produto-" + idProduto)) : $("select[name='acrescimo[]']");

                console.log(res, select);
                select.last().empty();
                $.each(res, function (idx, obj) {
                    var html = `<option data-subtext="R$${obj.valor}" value="${obj.id_acrescimo}" ${acrescimos.indexOf(obj.id_acrescimo) != -1 ? 'selected' : ''} >${obj.nome_acrescimo}</option>`;
                    select.last().append(html);
                });

                select.last().selectpicker();
            }
        });
    }

    function getFile(file){
        $.ajax({
            url:'',
            dataType:'JSON',
            type:'POST',
            data: {
                
            },
            success:function(res){
                return JSON.parse(res);
            }
        })

    }

    function excluiInput(_this) {
        $(_this).parent().parent().parent().remove();
    }

    async function ExcluiDados(id_pedido) {
        if (confirm('Deseja realmente executar essa ação?') === true) {
            await $.ajax({
                url: "excluiPedido",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id_pedido
                },
                success: function (res) {
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

    function cidadeporIDPedido(idestado, nomeCidade) {
        var idEstado = ($('#estadoProd').val() == "" || $('#estadoProd').val() == null) ? idestado : $('#estadoProd').val();
        $.ajax({
            url: "cidadeporID",
            type: "POST",
            dataType: "JSON",
            data: {
                idEstado: idEstado
            },
            success: function (res) {
                $('#cidadeProd').empty();
                var html = "";
                $.each(res, function (idx, obj) {
                    html += `<option value="${obj.id}" ${(obj.nome == nomeCidade) ? 'selected' : ''}>${obj.nome}</option>`;
                });
                $('#cidadeProd').append(html);
            }
        })
    }

    function getCepPedido(cep) {
        cep = cep.toString().replace('-', '');
        $.ajax({
            url: `https://viacep.com.br/ws/${cep}/json/`,
            type: "GET",
            dataType: "JSON",
            headers: { 'content-type': 'application/json;charset=utf-8' },
            data: {},
            success: function (res) {
                $('#Logradouro').val(res.logradouro)
                $('#bairro').val(res.bairro)
                $.post("listaEstado", function (data) {
                    var listEst = JSON.parse(data);
                    var html = "";
                    $.each(listEst, function (idx, obj) {
                        html += `<option value="${obj.id}" ${(obj.sigla == res.uf) ? 'selected' : ""}>${obj.nome + " - " + obj.sigla}</option>`;
                    });
                    $('#estadoProd').append(html);
                });

                $.post("pegaId", { sigla: res.uf }, function (data) {
                    var idEst = JSON.parse(data);
                    cidadeporIDPedido(idEst[0].id, res.localidade);
                });

            }
        })
    }

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
        cep = cep.toString().replace('-', '');
        $.ajax({
            url: `https://viacep.com.br/ws/${cep}/json/`,
            type: "GET",
            dataType: "JSON",
            headers: { 'content-type': 'application/json;charset=utf-8' },
            data: {},
            success: function (res) {
                console.log(res);
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
                    cidadeporID(idEst[0].id, res.localidade);
                });

            }
        })
    }

    function fazUpload(file) {
        var myform = new FormData();
        myform.append('file', file);
        myform.append('buckt', "uploadLeet");
        myform.append('leet', true);

        $.ajax({
            url: 'https://gsplanaltec.com/GerenciamentoServicos/APIControle/UploadS3',
            type: 'POST',
            data: myform,
            contentType: false,
            processData: false,
            success: function (res) {
                console.log(res)
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


<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item nav-pedido" role="presentation">
        <button class="nav-link active" style="" id="pills-lista-tab" data-bs-toggle="pill"
            data-bs-target="#pills-lista" type="button" role="tab" aria-controls="pills-lista"
            aria-selected="true">Lista de Pedidos</button>
    </li>
    <li class="nav-item nav-pedido" role="presentation">
        <button class="nav-link" id="pills-cadastro-tab" data-bs-toggle="pill" data-bs-target="#pills-cadastro"
            type="button" role="tab" aria-controls="pills-cadastro" aria-selected="false">Cadastro de Pedidos</button>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-lista" role="tabpanel" aria-labelledby="pills-home-tab"
        tabindex="0">
        <div class="main-top">
            <h1 class="corInit">Lista de Pedidos</h1>
        </div>

        <div class="col-md-12">
            <button class="btn btn-success" onclick="$('.selectCheck').prop('checked', true)">Marcar Todos</button>
            <button class="btn btn-success" onclick="$('.selectCheck').prop('checked', false)">Desmarcar Todos</button>
        </div>

        <table id="tb_pedido" class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nº</th>
                    <th scope="col">Cliente</th>
                    <!-- <th scope="col">Telefone</th> -->
                    <!-- <th scope="col">Produto</th> -->
                    <th scope="col">Número Arte</th>
                    <!-- <th scope="col">CEP</th> -->
                    <th scope="col">Data do Pedido</th>
                    <!-- <th scope="col">Data do Evento</th> -->
                    <th scope="col">Data da Entrega</th>
                    <!-- <th scope="col">Valor do Frete</th> -->
                    <!-- <th scope="col">Retirada/Envio</th> -->
                    <!-- <th scope="col">Valor Unitário</th> -->
                    <th scope="col">Valor Total</th>
                    <th scope="col">Valor Sinal</th>
                    <th scope="col">Falta Pagar</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
        </table>
        <div>
            <button class="btn btn-primary" type="button" id="geraPdf">Gerar PDF </button>
        </div>
    </div>
    <div class="tab-pane fade show" id="pills-cadastro" role="tabpanel" aria-labelledby="pills-cadastro-tab"
        tabindex="0">
        <div class="main-top">
            <h1 class="corInit">Cadastro de Pedidos</h1>
            <span id="alerta" style="text-align:center"></span>
        </div>
        <div class="main-cadastro-produto">
            <div class="row g-4 was-validated">
                <div class="">
                    <h5>Dados Gerais</h5>
                    <hr>
                </div>

                <div class="col-md-8">
                    <div class="row g-4">

                        <div class="col-md-4">
                            <label for="dadosClient" class="form-label">Dados do Cliente</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa-solid fa-circle-plus" style="color:purple;" type="button" id="mymodal"
                                data-bs-toggle="modal" data-bs-whatever="@getbootstrap" title="Adicionar Cliente"></i>
                            <select name="" id="addCliente" class="selectpicker form-control" data-live-search="true"
                                title="SELECIONE UM CLIENTE">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputAddress2" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefone_pedido" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="inputAddress2" class="form-label">Número Arte</label>
                            <input type="text" class="form-control" id="dados_arte">
                        </div>
    
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cep_pedido" onblur="getCepPedido(this.value)">
                            <input type="text" hidden="true" id="id_Edita">
                            <button type="button" hidden="true" id="atualizaTable"></button>
                        </div>
                        <div class="col-md-4">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estados" id="estadoProd" class="form-select form-control"
                                aria-label="Default select example" onchange="cidadeporIDPedido();">
                                <option value="">Selecione o Estado</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="cidade" class="form-label">Cidade</label>
                            <select name="cidade" id="cidadeProd" class="form-select form-control"
                                aria-label="Default select example">
                                <option value="">Aguardando estado</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputAddress2" class="form-label"> Logradouro</label>
                            <input type="text" class="form-control" id="Logradouro">
                        </div>
                        <div class="col-md-4">
                            <label for="inputAddress2" class="form-label"> Bairro</label>
                            <input type="text" class="form-control" id="bairro">
                        </div>
                        <div class="col-md-4">
                            <label for="inputAddress2" class="form-label"> Complemento</label>
                            <input type="text" class="form-control" id="complemento">
                        </div>
                        <div class="col-md-4">
                            <label for="inputAddress2" class="form-label">Foto do pedido</label>
                            <input type="file" placeholder="" class="form-control" id="fotos" onchange="readURL(this)">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row g-4" >
                        <div class="col-md-12 text-center">
                            <img class="img-resposive" src="assets/img/image.png" id="tempPedidoFoto" />
                        </div>
                    </div>
                </div>

                <div>
                    <h5>Datas e Prazos</h5>
                    <hr>
                </div>
                <div class="col-md-3">
                    <label for="numPedido" class="form-label">Data do Pedido</label>
                    <input type="date" value="<?php echo date('Y-m-01') ?>" class="form-control" id="data_pedido">
                </div>
                <div class="col-md-3">
                    <label for="dadosClient" class="form-label">Data do Evento</label>
                    <input type="date" class="form-control" value="<?php echo date('Y-m-01') ?>" id="data_evento">
                </div>
                <div class="col-md-3">
                    <label for="dadosProduto" class="form-label">Data da Entrega</label>
                    <input type="date" class="form-control" value="<?php echo date('Y-m-01') ?>" id="data_entrega">
                </div>
                <div class="col-md-3">
                    <label for="inputAddress2" class="form-label">Retirada/Envio</label>
                    <input type="date" class="form-control" value="<?php echo date('Y-m-01') ?>" id="retirada_envio">
                </div>
                <div>
                    <h5>Dados de Valores e Produto</h5>
                    <hr>
                </div>
                <div class="col-md-3">
                    <label for="inputAddress2" class="form-label">Valor do Frete</label>
                    <input type="text" class="form-control" id="valor_frete"
                        onKeyUp="maskIt(this,event,'#########.##',true)" dir="rtl">
                </div>
                <div class="col-md-3">
                    <label for="dadosClient" class="form-label">Valor Total</label>
                    <input type="text" class="form-control" id="valor_total"
                        onKeyUp="maskIt(this,event,'#########.##',true)" dir="rtl">
                </div>
                <div class="col-md-3">
                    <label for="dadosProduto" class="form-label">Valor Sinal</label>
                    <input type="text" class="form-control" id="valor_sinal"
                        onblur="$('#falta_pagar').val( (Number($('#valor_total').val()) - Number($(this).val())).toFixed(2) )"
                        onKeyUp="maskIt(this,event,'#########.##',true)" dir="rtl">
                </div>
                <div class="col-md-3">
                    <label for="inputAddress2" class="form-label">Falta Pagar</label>
                    <input type="text" class="form-control" id="falta_pagar"
                        onKeyUp="maskIt(this,event,'#########.##',true)" dir="rtl" readonly>
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
                            class="fa-solid fa-circle-plus"></i> Adicionar</button>
                </div>
                <div>
                    <button type="button" id="Btncadas" class="btn btn-primary">Cadastrar</button>
                    <button type="button" id="reloadPage" class="btn btn-primary" onclick="location.reload()">Limpar
                        campos</button>
                </div>
                <div class='row mt-3' id="produtosAdd">

                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
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
                                    <input id="nome_cliente" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Telefone</label>
                                    <input class="form-control" id="telefone_cliente">
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">CPF</label>
                                    <input class="form-control" id="cpf_cliente">
                                </div>
                                <div class="mb-3">
                                    <label for="inputState" class="form-label">CEP</label>
                                    <input type="text" class="form-control" id="cep_cliente"
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
                            <button type="submit" id="btnEnvia" class="btn btn-primary"
                                data-bs-dismiss="modal">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>