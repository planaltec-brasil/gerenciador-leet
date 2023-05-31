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
    <h1 class="corInit">Cadastro de Produto</h1>
</div>
<div class="main-cadastro-produto mt-3">
    <form class="row g-4">
        <div class="col-md-3">
            <label for="numPedido" class="form-label">Nome do Produto</label>
            <input type="text" class="form-control" id="">
        </div>
        <div class="col-md-3">
            <label for="dadosClient" class="form-label">Cor</label>
            <input type="text-color" class="form-control" id="">
        </div>
        <div class="col-md-3">
            <label for="dadosProduto" class="form-label">Estoque Atual</label>
            <input type="text" class="form-control" id="" >
        </div>
        <div class="col-md-3">
            <label for="inputAddress2" class="form-label">Estoque anterior</label>
            <input type="text" class="form-control" id="inputAddress" >
        </div>
        <div class="col-md-3">
            <label for="inputCity" class="form-label">Unidade</label>
            <input type="text" class="form-control" id="inputCity">
        </div>
        <div class="col-md-3">
            <label for="inputState" class="form-label">Volume</label>
            <input type="text" class="form-control" id="">
        </div>
        <div class="col-md-3">
            <label for="inputState" class="form-label">Material</label>
            <input type="text" class="form-control" id="">
        </div>
        <div class="col-md-3">
            <label for="inputState" class="form-label">Fotos do produto</label>
            <input type="file" class="form-control" id="">
        </div>
        <!-- <div class="mb-3">
            <label for="formFile" class="form-label">Fotos do produto</label>
            <input class="form-control" type="file" id="formFile">
        </div> -->
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>

    <div class="main-top mt-3">
        <h1 class="corInit">Lista de Produto</h1>
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