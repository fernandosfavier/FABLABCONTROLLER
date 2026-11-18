<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FABLABCONTROLLER</title>
</head>

<body>

    <h1>FABLABCONTROLLER</h1>

    <h2>Bem-vindo ao sistema!</h2>

    <p>
        Olá, {{ $usuario->nome }}!
    </p>

    <p>
        Tipo de usuário: {{ $usuario->tipo_usuario }}
    </p>

    <h3>Funcionalidades do sistema</h3>

    <ul>
        <li>Consultar equipamentos</li>
        <li>Consultar agendamentos</li>
        <li>Visualizar informações do sistema</li>
    </ul>

    @if($usuario->tipo_usuario === 'Admin')

        <h3>Painel Administrativo</h3>

        <p>
            Você possui acesso às funcionalidades administrativas.
        </p>

        <a href="{{ route('painel') }}">
            Acessar painel administrativo
        </a>

        <br>

        <a href="{{ route('cadastro_equipamento') }}">
            Cadastrar equipamentos
        </a>

    @else

        <h3>Painel do Usuário</h3>

        <p>
            Você possui acesso às funcionalidades disponíveis para usuários comuns.
        </p>

        <a href="{{ route('agendamento') }}">
            Acessar agendamentos
        </a>

        <br>

        <a href="{{ route('equipamento') }}">
            Consultar equipamentos
        </a>

    @endif

</body>

</html>
