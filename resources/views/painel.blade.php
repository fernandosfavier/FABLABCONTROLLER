<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
</head>

<body>

    <h1>FABLABCONTROLLER</h1>

    <h2>Painel Administrativo</h2>

    <p>Área exclusiva para administradores.</p>

    <a href="{{ route('cadastro_equipamento') }}">
        Cadastrar equipamentos
    </a>

    <br>

    <a href="{{ route('home') }}">
        Voltar para a página inicial
    </a>

</body>

</html>
