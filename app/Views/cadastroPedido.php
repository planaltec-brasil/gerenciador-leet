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

    .btn-danger{
        background-color: red;
        width: 100px;
        border:none;
        border-radius:12px;
    }

    .btnexclui{
        padding-left: 100px;
        text-align: end;
        margin-top: 15px;
    }

</style>
<script>

    $(document).ready(function () {
        carregaProduto();
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
                {
                    data: null,
                    defaultContent: "",
                    render: function (data, type, row) {
                        return row.dados_produto;
                    }
                },
                { data: 'dados_arte' },
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
                // {
                //     "data": null,
                //     "defaultContent": "",
                //     "render": function (data, type, row) {
                //         return row.data_entrega.split('-').reverse().join('/');
                //     }
                // },
                // { data: 'cep_pedido' },
                // {
                //     "data": null,
                //     "defaultContent": "",
                //     "render": function (data, type, row) {
                //         return row.retirada_envio.split('-').reverse().join('/');
                //     }
                // },
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
                            html += "<button type='button' style='color:red'; onclick='ExcluiDados("+ data.id_pedido +")' ><i class='fa-solid fa-trash'></i></button>";
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
                    var html  = "";
                        html += `<div class="col-4">`;
                        html += `<div class="card mb-3 shadow p-3 mb-5 bg-body rounded" style="max-width: 540px;">`;
                        html += `<small>Descrição do Produto:</small>`;
                        html += `<div class="row g-0">`;
                        html += `<div class="col-md-4 d-flex justify-content-center align-items-center">`;
                        html += `<img src='data:image/jpeg;base64,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' class="img-fluid rounded-start" alt="...">`;
                        html += `</div>`;
                        html += `<div class="col-md-8" style="height: 150px">`;
                        html += `<div class="card-body">`;
                        html += `<h5 class="card-title">${ res.nome_produto }</h5>`;
                        html += `<div>`;
                        html += `<label for="qtdPrd">QTD</label>`;
                        html += `<input id="id_Produto" name="id_Produto[]" type="hidden" value="${ res.id_produto }" />`;
                        html += `<input id="qtdPrd" name="qtdPrd[]" onKeyUp="maskIt(this,event,'#########.##',true)" type="text" value="1" class="form-control" />`;
                        html += `</div>`;  
                        html += `<div class="btnexclui"`;
                        html += '<button type="button" class="btn btn-danger" style="color:red"; onclick="excluiInput(this)"><i class="fa-solid fa-trash"></i></button>';
                        html += `</div>`; 
                        html += `</div>`;
                        html += `</div>`;
                        html += `</div>`;
                        html += `</div>`;
                        html += `</div>`;
                        
                        $("#produtosAdd").append(html);
                    }
                });
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
    
   async function ExcluiDados(id_pedido){
        if (confirm('Deseja realmente executar essa ação?') === true) {
               await $.ajax({
                    url: "excluiProdPedido",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        id: id_pedido
                    },
            success:  function(res) {
                        $.ajax({
                                    url: "excluiPedido",
                                    type: "POST",
                                    dataType: "JSON",
                                    data: {id: id_pedido},
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

// async function ExcluiDados(id_pedido){
//     if (confirm('Deseja realmente executar essa ação?') === true){
//         $.when(
//             $.ajax({
//                 url: 'excluiProdPedido',
//                 type: "POST",
//                 dataType: "JSON",
//                 data: {id: id_pedido},
//             }),
//             $.ajax({
//                 url: "excluiPedido",
//                 type: "POST",
//                 dataType: "JSON",
//                 data: {id: id_pedido},
//             }),
//         ).done(function (responsePedido, responseProduto) {
//             // Handle the responses after successful deletions
//             var successPedido = responsePedido[0].success;
//             var successProduto = responseProduto[0].success;

//             if (successPedido && successProduto) {
//                 alert('Deletions successful.');
//                 // Perform any necessary UI updates
//             } else {
//                 alert('Failed to delete data.');
//             }
//         }).fail(function () {
//             alert('An error occurred.');
//         });
//     } 
// }



    var add_button = $(".add_field_button"); //Add button ID
    $(add_button).click(function (e) {
        $(add_button).click(function (e) {

        });
    });


    // function criaAtlasHTML(dados = null) {
    //         var html = "";
    //         html += `<div class="atlas" >`;
    //         html += `<div class="header-atlas">`;
    //         html += `<div class="esq-header">`;
    //         html += `<label for="a" >${ dados.nome_projeto }</label>`;
    //         html += `<div class="bolinha">`;
    //         html += `&nbsp;`;
    //         html += `</div>`;
    //         html += `</div>`;
    //         html += `<div class="display_flex">`;
    //         html += `<div class="iconeLaps" style="background-color: rgb(41,123,178)" data-id='${ dados.id_projeto }' onclick="ListaEditaDados($(this))">`;
    //         html += `<svg width="20" height="20" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">`;
    //         html += `<path d="M12.1 7L13 7.9L3.9 17H3V16.1L12.1 7ZM15.7 1C15.5 1 15.2 1.1 15 1.3L13.2 3.1L16.9 6.9L18.7 5C19.1 4.6 19.1 4 18.7 3.6L16.4 1.3C16.2 1.1 15.9 1 15.7 1ZM12.1 4.2L1 15.2V19H4.8L15.8 7.9L12.1 4.2ZM5 0V3H8V5H5V8H3V5H0V3H3V0H5Z" fill="white"/>`;
    //         html += `</svg>`;
    //         html += `</div>`;
    //         html += `<div class="iconeLaps" style="background-color: rgb(255, 0, 0); margin-left:5px;" data-id='${ dados.id_projeto }'  onclick="teste($(this))">`;
    //         html += `<svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> `;
    //         html += `<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" fill="white"></path>`;
    //         html += `<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" fill="white"></path> `;
    //         html += `</svg>`;
    //         html += `</div>`;
    //         html += `</div>`;
    //         html += `</div>`;
    //         html += `<div class="h-relogio" >`;
    //         html += `<div class="icon-relogin">`;
    //         html += `<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">`;
    //         html += `<path d="M5.5 9.9C7.92 9.9 9.9 7.92 9.9 5.5C9.9 3.08 7.92 1.1 5.5 1.1C3.08 1.1 1.1 3.08 1.1 5.5C1.1 7.92 3.08 9.9 5.5 9.9ZM5.5 0C8.525 0 11 2.475 11 5.5C11 8.525 8.525 11 5.5 11C2.475 11 0 8.525 0 5.5C0 2.475 2.475 0 5.5 0ZM8.25 6.545L7.865 7.26L4.95 5.665V2.75H5.775V5.17L8.25 6.545Z" fill="#297BB2"/>`;
    //         html += `</svg>`;
    //         html += `12 Horas`;
    //         html += `</div>`;
    //         html += `</div>`;
    //         html += `<div class="esc-time">`;
    //         html += `Time: ${ dados.times }.`;
    //         html += `</div>`;
    //         html += `<div class="esc-att">`;
    //         html += `Última atualização:`;
    //         html += `</div>`;
    //         html += `<div class="textin-info">`;
    //         html += `<textarea readonly style="border-radius: 12px;" name="inf" id="inftext" cols="28" rows="2.9">${ dados.desc_projeto }</textarea>`;
    //         html += `</div>`;
    //         html += `</div>`;

    //         return html;
    //     }




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
</div>
<div class="main-cadastro-produto">
    <form class="row g-4">
        <div class="col-md-3">
            <label for="numPedido" class="form-label">Número de pedido</label>
            <input type="text" class="form-control" id="numero_pedido">
        </div>
        <div class="col-md-3">
            <label for="dadosClient" class="form-label">Dados do Cliente</label>
            <input type="text" class="form-control" id="dados_cliente">
        </div>
        <div class="col-md-3">
            <label for="inputAddress2" class="form-label">Dados da Arte</label>
            <input type="text" class="form-control" id="dados_arte">
        </div>
        <div class="col-md-3">
            <label for="numPedido" class="form-label">Data do Pedido</label>
            <input type="date" value="<?php echo date('01/m/Y') ?>" class="form-control" id="data_pedido">
        </div>
        <div class="col-md-3">
            <label for="dadosClient" class="form-label">Data do Evento</label>
            <input type="date" class="form-control" value="<?php echo date('01/m/Y') ?>" id="data_evento">
        </div>
        <div class="col-md-3">
            <label for="dadosProduto" class="form-label">Data da Entrega</label>
            <input type="date" class="form-control" value="<?php echo date('01/m/Y') ?>" id="data_entrega">
        </div>
        <div class="col-md-3">
            <label for="inputAddress2" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep_pedido">
        </div>
        <div class="col-md-3">
            <label for="inputAddress2" class="form-label">Retirada/Envio</label>
            <input type="date" class="form-control" value="<?php echo date('01/m/Y') ?>" id="retirada_envio">
        </div>
        <div class="col-md-3">
            <label for="numPedido" class="form-label">Valor Unitário</label>
            <input type="text" class="form-control" id="valor_unitario" onKeyUp="maskIt(this,event,'#########.##',true)"
                dir="rtl">
        </div>
        <div class="col-md-3">
            <label for="dadosClient" class="form-label">Valor Total</label>
            <input type="text" class="form-control" id="valor_total" onKeyUp="maskIt(this,event,'#########.##',true)"
                dir="rtl">
        </div>
        <div class="col-md-3">
            <label for="dadosProduto" class="form-label">Valor Sinal</label>
            <input type="text" class="form-control" id="valor_sinal" onKeyUp="maskIt(this,event,'#########.##',true)"
                dir="rtl">
        </div>
        <div class="col-md-3">
            <label for="inputAddress2" class="form-label">Falta Pagar</label>
            <input type="text" class="form-control" id="falta_pagar" onKeyUp="maskIt(this,event,'#########.##',true)"
                dir="rtl">
            <input type="text" hidden="true" id="id_Edita">
            <button  type="button" hidden="true" id="atualizaTable"></button>
        </div>
        <div class="col-md-3">
            <label for="produtos" class="form-label">Produtos</label>
            <select class="form-select form-control" aria-label="Default select example" id="produto">
                <option value="">Selecione</option>
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary" type="button" id="addProduto"><i class="fa-solid fa-circle-plus"></i>
                Adicionar</button>
        </div>
        <div class='row mt-3' id="produtosAdd">

        </div>
        <div class="col-2">
            <button type="button" id="Btncadas" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>

    <div class="main-top mt-5">
        <h1 class="corInit">Lista de Pedidos</h1>
    </div>

    <table id="tb_pedido" class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Pedidos</th>
                <th scope="col">Clientes</th>
                <th scope="col">Produtos</th>
                <th scope="col">Arte</th>
                <th scope="col">Data Pedido</th>
                <th scope="col">Data Evento</th>
                <!-- <th scope="col">Data Entrega</th> -->
                <!-- <th scope="col">CEP</th>
                <th scope="col">Retirada/Envio</th> -->
                <th scope="col">Valor Unitário</th>
                <th scope="col">Valor Total</th>
                <th scope="col">Valor Sinal</th>
                <th scope="col">Falta Pagar</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
    </table>
</div>