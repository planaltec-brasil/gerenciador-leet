<style>
        .form-control{
        background-color: #F5f5f5;
        border-radius: 12px;
        border:none;
    }

    .btn-primary{
        margin-top: 30px;
        border-radius: 12px;
        background-color: #B800FF;
        border:none;
    }

    .btn-primary:hover{
        margin-top: 30px;
        border-radius: 12px;
        background-color: #1B1B1B;
    }

    .corInit{
        background: -webkit-linear-gradient(#B800FF 0%, #FF3D81 100%, #333);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }


</style>

<div class="main-top">
    <h1 class="corInit">Cadastro de Usuário</h1>
</div>
<div class="main-cadastro-produto">
    <form class="row g-4">
    <div class="col-md-3">
        <label for="numPedido" class="form-label">Nome de Usuário</label>
        <input type="text" class="form-control" id="">
    </div>
    <div class="col-md-3">
        <label for="dadosClient" class="form-label">Senha</label>
        <input type="text" class="form-control" id="">
    </div>
    <div class="col-md-3">
        <label for="dadosProduto" class="form-label">E-mail</label>
        <input type="text" class="form-control" id="" >
    </div>
    <div class="col-md-3">
        <label for="inputAddress2" class="form-label">Cargo/Permissões</label>
        <input type="text" class="form-control" id="inputAddress" >
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>

    <div class="main-top mt-3">
        <h1 class="corInit">Lista de Usuário</h1>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
                <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</div>