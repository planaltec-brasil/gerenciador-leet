<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login leet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        #main {
            display: flex;
        }

        #ladoEsq {
            background: red;
        }

        #ladoDir {
            background: green;
        }


        .corzinha{
            background: linear-gradient(90deg, #B800FF 0%, #FF3D81 100%), linear-gradient(0deg, rgba(27, 27, 27, 0.2), rgba(27, 27, 27, 0.2));
        }

        #imagenzinha{
            position: absolute;
            width: 95px;
            height: 95px;
            left: 40px;
            top: 40px;
        }

        .titulo {
            padding: 50px 0px;
        }

        .titulo h1{
            font-style: normal;
            font-weight: 600;
            font-size: 24px;
            line-height: 36px;
            color: #FFFFFF;
            text-align: center;
        }

        input[type="text"]{
            height: 48px;
            background: #ECECEC;
            border-radius: 12px!important;
        }

        input[type='checkbox'] {
            width: 23px;
            height: 23px;
            background: #FFFFFF;
            border-radius: 3px;
        }

        label{
            color: white;
            font-size: 16px;
            font-weight: 700;
            line-height: 19px;
            letter-spacing: 0em;
            text-align: left;

        }

        .btn:hover {
            color: white;
        }
        .glow-on-hover {
            width: 177px;
            height: 50px;
            color: #fff;
            background: #1B1B1B;
            cursor: pointer;
            position: relative;
            z-index: 0;
            border-radius: 10px;
        }

        .glow-on-hover:before {
            content: '';
            background: linear-gradient(90deg, #B800FF 0%, #FF3D81 100%), linear-gradient(0deg, rgba(27, 27, 27, 0.2), rgba(27, 27, 27, 0.2));
            position: absolute;
            top: -2px;
            left:-2px;
            z-index: -1;
            width: calc(100% + 4px);
            height: calc(100% + 4px);
            animation: glowing 20s linear infinite;
            opacity: 0;
            transition: opacity .3s ease-in-out;
            border-radius: 10px;
        }

        .glow-on-hover:active {
            color: #000
        }

        .glow-on-hover:active:after {
            background: transparent;
        }

        .glow-on-hover:before {
            opacity: 1;
        }

        .glow-on-hover:after {
            z-index: -1;
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: #1B1B1B;
            left: 0;
            top: 0;
            border-radius: 10px;
            transition: .3s ease-in-out;
        }

        .glow-on-hover:hover:after {
            background: none;
        }

        @keyframes glowing {
            0% { background-position: 0 0; }
            50% { background-position: 400% 0; }
            100% { background-position: 0 0; }
        }

        @media only screen and (max-width: 1000px) {
            .corzinha{
                display:none;
            }
            
        }

    </style>
</head>
<body>
    <div class="container-fluid h-100" >
        <div class="row h-100">
            <div class="col-lg-7 col-md-12 col-sm-12 d-flex justify-content-center align-items-center" style="background-color: #1B1B1B">
                <div id="imagenzinha">  
                   <img src="<?= base_url();?>assets/logolet.png">
                </div>
                <div class="row " >
                    <div class="titulo">
                        <h1>Acesse sua conta</h1>
                    </div>
                    <div class="form-row d-grid gap-3">
                        <div class="form-group col-12 d-grid gap-3" >
                            <label for="username" >Login</label>
                            <input id="logNome" name="username" type="text" class="form-control" />
                        </div>
                        
                        <div class="form-group col-12 d-grid gap-3" >
                            <label for="username" >Senha</label>
                            <input id="logSenha" name="username" type="text" class="form-control" />
                        </div>

                        <div class="form-group col-12 d-grid gap-3" >
                            <div class="form-check d-flex justify-content-start align-items-center">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label ms-2" for="flexCheckDefault">
                                    Lembrar-me
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-12 d-flex justify-content-center mt-5">
                            <button type="button" class="btn btn-lg glow-on-hover" >Entrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 corzinha">
                &nbsp;
            </div>
        </div>
    </div>
</body>
</html>