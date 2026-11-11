<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

  

</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
  @vite(['resources/css/app.css', 'resources/js/loginteste.js'])
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 routed border p-3 shadow rounded sm bg-white">
                <div class="card">
                    <div class="card-header">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="email">Informe seu Email cadastrado</label>
                                <input type="email" class="form-control form-control-sm" id="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="senha   ">Informe sua senha</label>
                                <input type="password" class="form-control form-control-sm" id="senha" placeholder="Senha">
                            </div>
                            <button type="button" class="btn btn-primary" id="entrar">Entrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
