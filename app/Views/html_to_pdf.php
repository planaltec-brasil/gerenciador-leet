<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
    <style>
        img{
            padding-top: 30px;
            padding-left: 20px;
            width: 50%;
        }

        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        .divContent {
            float: left;
            border: solid 1px black;
            padding: 10px;
            height: 525px;
        }

        .divContent div {
            font-weight: bold;
        }

        p {
            color: blue;
            font-weight: bold;
            text-align: center;
        }

        .tamanhoObs{
            font-size: x-large;
        }

        .segundinhaparte{
            font-size: 13px;
            font-weight: bold;
            padding-left: 90px;
            padding-top: 20px;
        }

        .fotinha{
            width: 35%;
            /* padding-left: 50%; */
        }
    </style>
</head>

<body>
    <div>
        <p>PEDIDO DE VENDA | LEET PERSONALIZADOS</p>
    </div>
    <div class="divContent" style="width: 54%;">
        <div>Número OS <?php echo $teste[0]->id_pedido;?></div>
        <div style="float: left; width: 30%;">Cliente: <span>José</span></div>
        <div>Data do pedido: <span>06/06 Terça-feira</span></div>
        <br />
        <div>Celular: +55 <span> (73) 99085824 Chat Guru</span></div>
        <br />
        <div><u>Produto/Quantidade:</u></div>
        <br />
        <div><span>25 Taça de Gin <b style="color:red;">450ML</b>(Personalizadas TRANSPARENTE + BORDA METALIZADA)</span>
        </div>
        <br />
        <div><span>25 Copo Whisky <b style="color:red">330ML</b> (Personalizadas TRANSPARENTE + BORDA METALIZADA)</span>
        </div>
        <br />
        <div><u>BORDA METALIZADA (DOURADA)</u></div>
        <br />
        <div><span>Número Arte: Junho. 02 63 (Dr. José Augusto P. Marcelo)</span></div>
        <br />
        <div><u style="color:red;">Data do Evento:<span> 12/08/2023 </span></u></div>
        <br />
        <div><span>Retirada / Envio</span></div>
        <br />
        <div>Valor Frete: R$<span>66,34 (Sequoia de 20 á 22 dias úteis)</span></div>
        <br />
        <div> CEP: <span>45206-059</span></div>
        <div><span>Rua Nossa Senhora do Carmo, Pompílio Sampaio, Jequié/BA</span></div>
    </div>
    <div class="divContent" style="width: 40%;">
        <div>VALOR TOTAL: R$<span>292,00</span></div>
        <br />
        <div>
            Valor unitário: <span>R$6,19</span>
            <br />
            <span style="visibility: hidden">Valor unitário:</span> <span>R$5,49</span>
        </div>
        <br />
        <div>Valor do sinal: R$<span>179,17</span></div>
        <br />
        <div><u style="color:red;">Falta Pagar:</u>
            <span>
                R$112,83
            </span>
        </div>
        <br />
        <div><u style="color: red;">Data de Entrega/Postagem:</u>
            <span>20/06 Terça-feira</span>
        </div>
        <br/>
        <div class="tamanhoObs"> OBS: </div>
        <div><img src="assets/max.jpeg"></div>
    </div>
    <div>
        <p>PEDIDO DE VENDA | LEET PERSONALIZADOS</p>
    </div>
    <div class="segundinhaparte">
        <div style="float: left; width: 30%;">Cliente: <span class="corzinhaNome">José</span></div>
        <div>Data do pedido: <span>06/06 Terça-feira</span></div>
        <br />
        <div>Celular: +55 <span class="corzinhaTel"> (73) 99085824 Chat Guru</span></div>
        <br />
        <div><u>Produto/Quantidade:</u></div>
        <br />
        <div><span>25 Taça de Gin <b style="color:red;">450ML</b>(Personalizadas TRANSPARENTE + BORDA METALIZADA)</span></div>
        <br />
        <div><span>25 Copo Whisky <b style="color:red">330ML</b> (Personalizadas TRANSPARENTE + BORDA METALIZADA)</span></div>
        <br />
        <div><u>BORDA METALIZADA (DOURADA)</u></div>
        <br />
        <div style="color:red;"><u>Data do Evento:<span style="color:red;"> 12/08/2023</span></u></div>
        <br />
        <div><u style="color:red;">Data de entrega/Postagem:</u>
            <span> 20/06 Terça-feira</span>
        </div>
        <div class="fotinha"><img src="assets/max.jpeg"></div>
    </div>
</body>

</html>