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

<script>
    
</script>

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
        <label for="inputAddress2" class="form-label">Cargo/Permissões</label>
        <select  class="form-select form-control" name="cargo" id="">
            <option>Selecione</option>
        </select>
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>

    <div class="main-top mt-3">
        <h1 class="corInit">Lista de Usuário</h1>
    </div>
    <table id="tb_usuario" class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
    </table>
</div>