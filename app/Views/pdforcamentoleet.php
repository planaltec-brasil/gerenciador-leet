<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Leet</title>
</head>
<style>
    img {
        width: 50px;
        height: 50px;
    }

    body {
        font-family: sans-serif;
        font-size: 14px;
    }

    .divContent {
        float: left;
    }

    .linha {
        margin-bottom: 25px;
    }

    .espaco {
        margin-bottom: 5px;
    }

    .espaco p {
        margin: 0;
    }

    .tabeliznha {
        float: left;
        border: solid 1px black;
        padding: 5px;
    }

    .eborder {
        border-left: 1px solid rgba(0, 0, 0, .5);
    }

    table,
    td,
    th {
        border: 1px solid;
        padding: 8px;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .img-prod {
        width: 200px;
        height: 200px;

    }
</style>

<script>

</script>

<body>
    <?php for($p = 0; $p < count($pedido);$p++) { ?>
    <div class="linha">
        <div class="divContent" style="width: 30%; text-align: left;">
            <span><img src="assets/img/vector (5).png"></span>
        </div>
        <div class="divContent" style="width: 30%; text-align: center; padding-top: 12px;">
            <span style="font-size:large; font-weight: bold">Pedido de Venda</span>
        </div>
        <div class="divContent" style="text-align: right;">
            <span style="font-weight: bold">#
                <?php echo $pedido[$p]->id_pedido; ?>
            </span>
            <div style="text-align: right;">
                <b>Data do pedido:</b><span>
                    <?php echo implode('/', array_reverse(explode('-', $pedido[$p]->data_pedido))); ?>
                </span>
            </div>
        </div>
    </div>

    <div class="linha">
        <div class="divContent" style="width: 30%; text-align: left;">
            <b>Nome:</b><span>
                <?php echo $pedido[$p]->nome_cliente; ?>
            </span>
        </div>
        <div class="divContent" style="width: 70%; text-align: right;">
            <b>Celular:</b> <span><?php echo $pedido[$p]->telefone_cliente; ?></span>
        </div>
    </div>

    <div class="espaco">
        <div class="divContent" style="width: 30%; text-align: left;">
            <b>Lg:</b> <span><?php echo $pedido[$p]->logradouro_pedido; ?></span>
        </div>
        <!-- <div class="divContent" style="width: 23%; text-align: center;">
            <b>N°:</b> <span>29</span>
        </div> -->
        <div class="divContent" style="width: 23%; text-align: right;">
            <b>Complemento:</b> <span><?php echo $pedido[$p]->complemento_pedido; ?></span>
        </div>
        <div class="divContent" style="width: 47%; text-align: right;">
            <b>CEP:</b> <span>
                <?php echo $pedido[$p]->cep_pedido; ?>
            </span>
        </div>
    </div>

    <div class="linha">
        <div class="divContent" style="width: 30%; text-align: left;">
            <b>Bairro:</b> <span><?php echo $pedido[$p]->bairro_pedido; ?></span>
        </div>
        <div class="divContent" style="width: 35%; text-align: center;">
            <b>Cidade:</b> <span><?php echo $pedido[$p]->nome_cidade; ?></span>
        </div>
        <div class="divContent" style="width: 35%; text-align: right;">
            <b>Estado:</b> <span><?php echo $pedido[$p]->sigla; ?></span>
        </div>
    </div>

    <div class="linha">
        <div class="divContent" style="width: 30%; text-align: left;">
            <b>Data Evento:</b> <span style="color:#9747FF">
                <?php echo implode('/', array_reverse(explode('-', $pedido[$p]->data_evento))); ?>
            </span>
        </div>
        <div class="divContent" style="width: 30%; text-align: center;">
            <b>Data Postagem:</b> <span style="color:#9747FF"> <?php echo implode('/', array_reverse(explode('-', $pedido[$p]->data_entrega))); ?></span>
        </div>
        <div class="divContent" style="width: 40%; text-align: right;">
            <b>Localizador:</b> <span><?php echo implode('/', array_reverse(explode('-', $pedido[$p]->dados_arte))); ?></span>
        </div>
    </div>

    <div class="linha">
        <table>
            <thead>
                <tr>
                    <td>
                        <b>Qtde.</b>
                    </td>
                    <td>
                        <b>Produto</b>
                    </td>
                    <td>
                        <b>Personalização</b>
                    </td>
                    <td>
                        <b>Valor UN.</b>
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php $acrescimosArr = []; foreach($pedido[$p]->produtos as $produto) { ?>
                <tr>
                    <td><?php echo $produto->qtd; ?></td>
                    <td><?php echo $produto->nome_produto; ?></td>
                    <td>
                        <?php foreach($produto->acrescimos as $k => $acrescimo) { array_push($acrescimosArr, $acrescimo->nome_acrescimo); echo $acrescimo->nome_acrescimo . ($k+1 < count($produto->acrescimos) ? ' + ' : ''); } ?>
                    </td>
                    <td><?php echo "R$" . number_format($produto->valor_produto, 2, ',', ''); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="linha">
        <div class="divContent" style="width: 40%; text-align: left;">
            <div class="espaco">
                <b>Acrescimos:</b>
                <?php foreach(array_unique($acrescimosArr) as $arItem) { ?>
                    <p><?php echo array_count_values($acrescimosArr)[$arItem] . 'x ' . $arItem; ?></p>
                <?php } ?>
            </div>
            <div class="espaco">
                <b>Valor Frete:</b> <span>R$ <?php echo $pedido[$p]->valor_frete ?></span>
            </div>
            <div class="espaco">
                <b>Valor Total:</b> <span
                    style="visibility: hidden">Valor</span><span>----------</span><span>&nbsp;&nbsp;R$ <?php echo $pedido[$p]->valor_total ?></span>
            </div>
            <div class="espaco">
                <b>Valor do Sinal:</b> <span
                    style="visibility: hidden">va</span><span>----------</span><span>&nbsp;&nbsp;R$ <?php echo $pedido[$p]->valor_sinal ?></span>
            </div>
            <div class="espaco">
                <b>Valor Restante:</b> <span
                    style="visibility: hidden">V</span><span>----------</span><span>&nbsp;&nbsp;R$ <?php echo $pedido[$p]->falta_pagar ?></span>
            </div>
        </div>
        <div class="divContent" style="width: 60%;">
            <div class="linha">
                <div class="divContent" style="text-align: center;">
                    <img class="img-prod" src="assets/img/vector (5).png">
                </div>
                <!-- <div class="divContent" style="width: 50%; text-align: center;">
                    <img class="img-prod" src="assets/img/vector (5).png">
                </div>
                <div class="divContent" style="width: 50%; text-align: center;">
                    <img class="img-prod" src="assets/img/vector (5).png">
                </div>
                <div class="divContent" style="width: 50%; text-align: center;">
                    <img class="img-prod" src="assets/img/vector (5).png">
                </div>
                <div class="divContent" style="width: 50%; text-align: center;">
                    <img class="img-prod" src="assets/img/vector (5).png">
                </div>
                <div class="divContent" style="width: 50%; text-align: center;">
                    <img class="img-prod" src="assets/img/vector (5).png">
                </div> -->
            </div>
        </div>
    </div>

    <hr />

    <!-- <pagebreak /> -->
    <div style="font-size:10px;">

        <div class="linha">
            <div class="divContent" style="width: 30%; text-align: left;">
                <span><img src="assets/img/vector (5).png"></span>
            </div>
            <div class="divContent" style="width: 30%; text-align: center; padding-top: 12px;">
                <span style="font-size:large; font-weight: bold">Pedido de Venda</span>
            </div>
            <div class="divContent" style="text-align: right;">
                <span style="font-weight: bold">#
                    <?php echo $pedido[$p]->id_pedido; ?>
                </span>
                <div style="text-align: right;">
                    <b>Data do pedido:</b><span>
                        <?php echo implode('/', array_reverse(explode('-', $pedido[$p]->data_pedido))); ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="linha">
            <div class="divContent" style="width: 50%; text-align: left;" >

                <div class="linha">
                    <div class="divContent" style="width: 50%; text-align: left;">
                        <b>Nome: </b><span>
                            <?php echo $pedido[$p]->nome_cliente; ?>
                        </span>
                    </div>
                    <div class="divContent" style="width: 50%; text-align: left;">
                        <b>Celular:</b> <span><?php echo $pedido[$p]->telefone_cliente; ?></span>
                    </div>
                </div>

                <div class="linha">
                    <div class="divContent" style="width: 50%; text-align: left;">
                        <b>Data Evento:</b> <span style="color:#9747FF">
                            <?php echo implode('/', array_reverse(explode('-', $pedido[$p]->data_evento))); ?>
                        </span>
                    </div>
                    <div class="divContent" style="width: 50%; text-align: center;">
                        <b>Data Postagem:</b> <span style="color:#9747FF"><?php echo implode('/', array_reverse(explode('-', $pedido[$p]->data_entrega))); ?></span>
                    </div>
                </div>

                <div class="linha">
                    <div class="divContent" style="width: 100%; text-align: left;">
                        <?php foreach($pedido[$p]->produtos as $produto) { ?>
                        <p>
                            <b><?php echo $produto->qtd; ?></b>
                            <b><?php echo $produto->nome_produto; ?></b>
                            <b>
                                <?php foreach($produto->acrescimos as $k => $acrescimo) { echo $acrescimo->nome_acrescimo . ($k+1 < count($produto->acrescimos) ? ' + ' : ''); } ?>
                            </b>
                        </p>
                        <?php } ?>

                        <p>
                            <b>Valor Frete:</b> <span>R$  <?php echo $pedido[$p]->valor_frete ?></span>
                        </p>

                        <p style="color: red;">
                            <u><b>Data da Entrega:</b></u> <span><?php echo implode('/', array_reverse(explode('-', $pedido[$p]->data_entrega))); ?></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="divContent" style="width: 50%; text-align: center;">
                <img class="img-prod" src="assets/img/vector (5).png">
            </div>
        </div>

    </div>
    <?php echo ($p+1) < count($pedido) ? '<pagebreak />' : ''; } ?>
</body>

</html>