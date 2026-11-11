<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<!DOCTYPE html>
<html lang="pt-br">
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
    <div class="container mt-5">
        <h3 class="text-center">Bem-vindo, {{ $usuario->nome }}</h3>
        @if (\'$admin == 'S')
            button type="button" class="btn btn-primary" id="admin">Acessar Painel Admin</button>
            a href="{{ route('login') }}" class="btn btn-danger">Painel Admin</a>
        @else
            <p class="text-center">Você não tem acesso ao painel de administração.</p>
    </div>
</body>
</html>