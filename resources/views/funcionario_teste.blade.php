<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de Funcionário</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
@vite(['resources/css/app.css', 'resources/js/cad_funcionarioteste.js'])

<body>
    <h3 class="text-center mt-3">Cadastro de Funcionário</h3>
    <div class="row mt-3 justify-content-center d-flex">

        <div class="col-6 row">
            <div class="mb-3 col-6">
                
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control form-control-sm" id="email"

                <label for="senha" class="form-label">Senha</label>
                <input type="text" class="form-control form-control-sm" id="senha" placeholder="Senha">

            </div class="mb-3 col-6">
                <label for=usuario class="form-label">Usuário</label>
                <select class="form-select form-select-sm" id="usuario">
                    @foreach ($usuarios as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>

                <button type="button" id="cadastrar" class="btn btn-primary mt-3">Cadastrar</button>
        


            </div>

            <div class="col-6 row">
                <div class="mb-3 col-6">

                </div>
            </div>
        </div>
</body>

</html>
