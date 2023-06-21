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
        margin-bottom: 10px;
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
</style>

<body>
    <div class="linha">
        <div class="divContent" style="width: 30%; text-align: left;">
            <span><img src="assets/img/vector (5).png"></span>
        </div>
        <div class="divContent" style="width: 30%; text-align: center; padding-top: 12px;">
            <span style="font-size:large; font-weight: bold">Pedido de Venda</span>
        </div>
        <div class="divContent" style="text-align: right;">
            <span style="font-weight: bold">#ID</span>
            <div style="text-align: right; padding-bottom: 20px;">
                Data do pedido:<span> 16/06/2023</span>
            </div>
        </div>
    </div>

    <div class="linha">
        <div class="divContent" style="width: 30%; text-align: left;">
            Nome:<span> Nome completo do cliente</span>
        </div>
        <div class="divContent" style="width: 40%; text-align: center;">
            Celular: <span>+55 (31) 0000-0000</span>
        </div>
    </div>

    <div class="espaco">
        <div class="divContent" style="width: 30%; text-align: left;">
            Cep: <span>00000-00</span>
        </div>
        <div class="divContent" style="width: 30%; text-align: center;">
            Rua: <span>Maria Gomes de Almeida</span>
        </div>
        <div class="divContent" style="width: 18%; text-align: right;">
            N°: <span>29</span>
        </div>
        <div class="divContent" style="width: 20%; text-align: right;">
            Complemento: <span>A</span>
        </div>
    </div>

    <div class="linha">
        <div class="divContent" style="width: 30%; text-align: left;">
            Bairro: <span>Planalto</span>
        </div>
        <div class="divContent" style="width: 30%; text-align: center;">
            Cidade: <span>Belo-Horizonte</span>
        </div>
        <div class="divContent" style="width: 18%; text-align: right;">
            Estado: <span>MG</span>
        </div>
    </div>

    <div class="linha">
        <div class="divContent" style="width: 30%; text-align: left;">
            Data Evento: <span style="color:#9747FF">16/06/2023</span>
        </div>
        <div class="divContent" style="width: 30%; text-align: center;">
            Data Postagem: <span style="color:#9747FF">Belo-Horizonte</span>
        </div>
        <div class="divContent" style="width: 30%; text-align: right;">
            Localizador: <span>Junho. 02 63 (nome)</span>
        </div>
    </div>

    <!-- <div class="tabeliznha">
        <div class="divContent" style="width: 10%; text-align: left;">
            Qtde.
        </div>
        <div class="eborder divContent" style="width: 30%; text-align: center;">
            Produto
        </div>
        <div class="eborder divContent" style="width: 40%; text-align: center;">
            Personalização
        </div>
        <div class="eborder divContent" style="width: 10%; text-align: right;">
            Valor un.
        </div>
    </div>

    <div class="tabeliznha">
        <div class="divContent" style="width: 10%; text-align: left;">
            25
        </div>
        <div class="eborder divContent" style="width: 30%; text-align: center;">
            Taça de Gin 450ml
        </div>
        <div class="eborder divContent" style="width: 40%; text-align: center;">
            Transparente + Borda Metalizada (Dourada)
        </div>
        <div class="eborder divContent" style="width: 10%; text-align: right;">
            RS 6,19
        </div>
    </div>

    <div class="tabeliznha">
        <div class="divContent" style="width: 10%; text-align: left;">
            25
        </div>
        <div class="eborder divContent" style="width: 30%; text-align: center;">
            Taça de Gin 450ml
        </div>
        <div class="eborder divContent" style="width: 40%; text-align: center;">
            Transparente + Borda Metalizada (Dourada)
        </div>
        <div class="eborder divContent" style="width: 10%; text-align: right;">
            RS 6,19
        </div>
    </div> -->

    <table class="linha">
        <thead>
            <tr>
                <td>
                    Qtde.
                </td>
                <td>
                    Produto
                </td>
                <td>
                    Personalização
                </td>
                <td>
                    Valor un.
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>25</td>
                <td>Taça de Gin 450ml</td>
                <td>Transparente + Borda Metalizada (Dourada)</td>
                <td>R$ 6,19</td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td>25</td>
                <td>Taça de whisky 330ml</td>
                <td>Transparente + Borda Metalizada (Dourada)</td>
                <td>R$ 6,19</td>
            </tr>
        </tbody>
    </table>

    <div class="linha">
        <div class="linha">
            Valor Frete: <span>R$ 66,34</span>
        </div>
        <div>
            Valor Total: <span style="visibility: hidden">Valor</span><span>----------</span><span>&nbsp;&nbsp; R$ 292,00</span>
        </div>
    </div>
</body>

</html>