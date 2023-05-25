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
        width: 50vh;
        align-items: center;
    }


</style>
</head>
<body>
<section class="vh-100">
    <div class="container-fluid h-custom">
         <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5 d-flex justify-content-center">
                <img src="../assets/leett.jpg" class="img-fluid" alt="Sample image">
            </div> 
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="usuario" class="form-control form-control-lg" placeholder="Digite o Usuário "/>
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <input type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Digite sua Senha" />
                    </div>
                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="button" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>
