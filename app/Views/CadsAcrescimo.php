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
        // tabela de clientes
        var tabela = $('#tb_usuario').DataTable({
            dom: "<'row'<'col-sm-6 mt-3 mb-3'B>><'row'<'col-sm-6'l><'col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: ['copy', 'excel', 'pdf'],
            "language": {
                url: "<?php echo base_url('assets/media/Portuguese-Brasil.json'); ?>" //caminho da linguagem em portugues verificar com calma
            },
            "lengthMenu": [
                [5, 10, 25, 50, 100, 500, 1000, -1],
                [5, 10, 25, 50, 100, 500, 1000, "TODOS"]
            ],
            "order": [
                [1, "desc"]
            ],
            // "scrollY": "500px",
            "scrollCollapse": false,
            "paging": true,
            ajax: {
                url: "getAcrescimo",
                type: 'POST',
                "data": function (d) {
                    return $.extend({}, d, {
                    })
                }
            },
            columns: [
                { data: 'nome_acrescimo' },
                { data: 'valor' },
                {
                        data: null,
                        defaultContent: "",
                        render: function (data, type, row) {
                            var html = "<button title='editar registro' type='button' onclick='EditaDadosAc(" + data.id_acrescimo + ")'  class='btn btn-sm btn-outline'><i style='color: #00008B;' class='far fa-edit'></i></button>&nbsp;";
                            return html;
                        }
                    },
            ]
        });

        $("#atualizaTable").on('click', function () {
            tabela.ajax.reload(null, false);
        });
      

        $("#btnEnvia").on('click', function () {
            $.ajax({
                'url': "InsereDadosAcrescimos",
                'dataType': "JSON",
                'type': "POST",
                data: {
                    'nome_acrescimo': $("#nome_acrescimo").val(),
                    'valor': $("#valor").val(),
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

    });

    function EditaDadosAc(id_acrescimo) {
            $.ajax({
                url: "CarregaAcresc",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id_acrescimo
                },
                success: function (res) {
                    if (res) {
                        $("#nome_acrescimo").val(res.nome_acrescimo);
                        $("#valor").val(res.valor);
                        $("#id_Edita").val(res.id_acrescimo);
                    }
                }
            });
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
    <h1 class="corInit">Cadastro de Acrescimos</h1>
</div>
<div class="main-cadastro-produto">
    <form class="row g-4 ">
        <div class="col-md-3">
            <label for="numPedido" class="form-label">Nome Acrescimo</label>
            <input type="text" id="nome_acrescimo" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="dadosClient" class="form-label">Valor Acrescimo</label>
            <input type="text" id="valor" class="form-control" onKeyUp="maskIt(this,event,'#########.##',true)" dir="rtl">
        </div>
        <input type="text" hidden="true" id="id_Edita">
            <button type="button" hidden="true" id="atualizaTable"></button>
</div>
<div class="col-md-3">
    <button type="button" id="btnEnvia" class="btn btn-primary">Cadastrar</button>
</div>

<div class="main-top mt-3">
    <h1 class="corInit">Lista de Acrescimos</h1>
</div>
<table id="tb_usuario" class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Nome Acrescimo</th>
            <th scope="col">valor Acrescimo</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
</table>
</div>