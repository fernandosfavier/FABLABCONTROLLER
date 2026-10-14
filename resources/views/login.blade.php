<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso - FABLABCONTROLE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, Arial, sans-serif;
            background: #f5f7fa;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
        }

        .login-left {
            width: 58%;
            min-height: 100vh;
            background: #062b43;
            color: white;
            padding: 55px 9%;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .login-left::before {
            content: "";
            position: absolute;
            width: 480px;
            height: 480px;
            border-radius: 50%;
            background: rgba(15, 77, 107, .35);
            right: -180px;
            top: -180px;
        }

        .login-left::after {
            content: "";
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: rgba(34, 197, 94, .08);
            left: -170px;
            bottom: -170px;
        }

        .logos {
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 2;
        }

        .logo-sesi {
            width: 48px;
            height: 38px;
            object-fit: contain;
        }

        .logo-fablab {
            width: 70px;
            height: 38px;
            object-fit: contain;
        }

        .left-content {
            position: relative;
            z-index: 2;
            max-width: 520px;
        }

        .tag {
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .8px;
            border: 1px solid rgba(255,255,255,.25);
            padding: 7px 11px;
            border-radius: 20px;
            margin-bottom: 20px;
        }

        .left-content h1 {
            font-size: 38px;
            line-height: 1.08;
            margin: 0 0 18px;
            font-weight: 700;
        }

        .left-content p {
            color: #b8c8d4;
            font-size: 14px;
            line-height: 1.7;
            max-width: 450px;
            margin: 0;
        }

        .left-footer {
            position: relative;
            z-index: 2;
            color: #8ea5b4;
            font-size: 11px;
        }

        .login-right {
            width: 42%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 35px;
            background: #f8fafc;
        }

        .login-card {
            width: 100%;
            max-width: 390px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(15,23,42,.08);
        }

        .card-logos {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
        }

        .card-logos img {
            object-fit: contain;
            height: 30px;
        }

        .card-logos .sesi {
            width: 40px;
        }

        .card-logos .fablab {
            width: 60px;
        }

        .login-card h2 {
            font-size: 22px;
            margin-bottom: 7px;
            color: #1f2937;
        }

        .login-card .subtitle {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 25px;
        }

        .form-label {
            font-size: 12px;
            font-weight: 600;
            color: #374151;
        }

        .form-control {
            min-height: 42px;
            font-size: 13px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37,99,235,.1);
        }

        .forgot {
            text-align: right;
            margin-top: 7px;
        }

        .forgot a {
            color: #2563eb;
            font-size: 11px;
            text-decoration: none;
        }

        .btn-login {
            width: 100%;
            border: 0;
            background: #2563eb;
            color: white;
            border-radius: 6px;
            padding: 11px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 20px;
        }

        .login-footer {
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
            margin-top: 22px;
        }

        @media (max-width: 800px) {
            .login-page {
                display: block;
            }

            .login-left,
            .login-right {
                width: 100%;
                min-height: auto;
            }

            .login-left {
                padding: 35px;
            }

            .login-right {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>

<div class="login-page">

    <section class="login-left">

        <div class="logos">
            <img src="{{ asset('Sesi-SP.jpg') }}" class="logo-sesi" alt="SESI">
            <img src="{{ asset('logofablap.png') }}" class="logo-fablab" alt="FABLAB">
        </div>

        <div class="left-content">
            <span class="tag">TECNOLOGIA PARA APRENDER FAZENDO</span>

            <h1>
                Controle inteligente para um laboratório em movimento.
            </h1>

            <p>
                Gerencie agendamentos, equipamentos e movimentações do FABLAB de forma simples, organizada e segura.
            </p>
        </div>

        <div class="left-footer">
            FABLABCONTROLE
        </div>

    </section>

    <section class="login-right">

        <div class="login-card">

            <div class="card-logos">
                <img src="{{ asset('Sesi-SP.jpg') }}" class="sesi" alt="SESI">
                <img src="{{ asset('logofablap.png') }}" class="fablab" style="width: 10, height:10" alt="FABLAB">
            </div>

            <h2>Acesso ao sistema</h2>

            <p class="subtitle">
                Entre com seus dados para continuar.
            </p>

            <form>
                @csrf

                <div class="mb-3">
                    <label class="form-label">NIF</label>
                    <input type="text" name="nif" class="form-control" placeholder="Digite seu NIF">
                </div>

                <div>
                    <label class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" placeholder="Digite sua senha">
                </div>

                <div class="forgot">
                    <a href="#">Esqueci minha senha</a>
                </div>

                <button type="submit" class="btn-login">
                    Entrar
                </button>
            </form>

            <div class="login-footer">
                Sistema de Controle de Equipamentos
            </div>

        </div>

    </section>

</div>

</body>
</html>