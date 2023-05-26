<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Datatables -->
    

<style>
    input{
        filter: hue-rotate(750deg)
    }

    .btn-primary {
    color: #fff;
    background-color: #6d009b;
    border-color: #fff;
    }

    .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
    .h-custom {
        height: calc(100% - 73px);
    }
    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }

     body{
        background-image: linear-gradient(to left, black , purple);
    } 

    img{
        border-radius: 50%;
        width: 111px;
        height: 100px;
        position: relative;
        left: 41px;
        bottom: 99px
            
    }
    img{
        -moz-box-shadow: 0px 0px 20px #ff00c8;
        -webkit-box-shadow: 0px 0px 20px #ff00c8;
        cursor: pointer;
    }

    p {
        color: #fff;
        font-weight: bold;
        font-size: 2vw;
        display: flex;
        align-items: center:
    }

    .layout{
        display:flex;
        bottom: 100px;
        flex-direction: row;
    }

    /* <svg width="487" height="768" viewBox="0 0 487 768" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0 0H487V768H0V0Z" fill="url(#paint0_linear_226_334)"/>
<path d="M0 0H487V768H0V0Z" fill="#1B1B1B" fill-opacity="0.2"/>
<defs>
<linearGradient id="paint0_linear_226_334" x1="0" y1="384" x2="487" y2="384" gradientUnits="userSpaceOnUse">
<stop stop-color="#B800FF"/>
<stop offset="1" stop-color="#FF3D81"/>
</linearGradient>
</defs>
</svg> */

  

</style>
</head>
<body>
<section class="vh-100">
    <div class="container-fluid h-custom">
         <div class="row d-flex justify-content-center align-items-center h-100">
            <div>
                <img src="../assets/leett.jpg" class="img-fluid" alt="Sample image">
            </div> 
            <div class="layout col-md-8 col-lg-6">
                <form>
                    <div>
                        <p>Acesse sua conta</p>
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="usuario" class="form-control form-control-lg" placeholder="Digite o Usuário "/>
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <input type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Digite sua Senha" />
                    </div>
                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button class=" glow-on-hover btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>
