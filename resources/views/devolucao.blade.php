<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devolução - FABLABCONTROLE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f8fafc;
            color: #1f2937;
            font-family: Inter, Arial, sans-serif;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 150px;
            height: 100vh;
            background: #062b43;
            padding: 16px 10px;
        }

        .brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-logos {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-bottom: 8px;
        }

        .logo-sesi {
            width: 42px;
            height: 28px;
            object-fit: contain;
        }

        .logo-fablab {
            width: 55px;
            height: 28px;
            object-fit: contain;
        }

        .brand-name {
            color: white;
            font-size: 12px;
            font-weight: 700;
        }

        .brand-name span {
            color: #22c55e;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .menu a {
            color: #cbd5e1;
            text-decoration: none;
            font-size: 11px;
            padding: 9px 8px;
            border-radius: 6px;
        }

        .menu a.active,
        .menu a:hover {
            background: #0e496d;
            color: white;
        }

        .main {
            margin-left: 150px;
        }

        .topbar {
            height: 52px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 28px;
        }

        .date {
            font-size: 12px;
            color: #64748b;
        }

        .content {
            padding: 28px;
        }

        .back {
            color: #2563eb;
            text-decoration: none;
            font-size: 11px;
        }

        h1 {
            font-size: 24px;
            margin: 10px 0 4px;
        }

        .subtitle {
            color: #64748b;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
        }

        .title {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 17px;
        }

        .info {
            font-size: 11px;
            color: #475569;
        }

        .equipment {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 13px;
            margin-bottom: 10px;
        }

        .equipment strong {
            font-size: 12px;
        }

        .form-label {
            font-size: 10px;
            font-weight: 600;
            margin-top: 10px;
        }

        .form-select,
        .form-control {
            font-size: 11px;
            border-color: #cbd5e1;
            min-height: 38px;
        }

        textarea.form-control {
            height: 80px;
        }

        .warning {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
            border-radius: 6px;
            padding: 12px;
            font-size: 10px;
            margin-bottom: 15px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .cancel {
            color: #475569;
            background: white;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            padding: 9px 17px;
            text-decoration: none;
            font-size: 11px;
        }

        .confirm {
            background: #166534;
            color: white;
            border: 0;
            border-radius: 5px;
            padding: 9px 17px;
            font-size: 11px;
        }
    </style>
</head>

<body>

<aside class="sidebar">

    <div class="brand">
        <div class="brand-logos">
            <img src="{{ asset('Sesi-SP.jpg') }}" class="logo-sesi" alt="SESI">
            <img src="{{ asset('logofablap.png') }}" class="logo-fablab" alt="FABLAB">
        </div>

        <div class="brand-name">
            FABLAB<span>CONTROLE</span>
        </div>
    </div>

    <nav class="menu">
        <a href="{{ route('agendamento') }}" class="active">Agendamentos</a>
        <a href="{{ route('equipamento') }}">Equipamentos</a>
        <a href="{{ route('login') }}">Sair</a>
    </nav>

</aside>

<main class="main">

    <header class="topbar">
        <span class="date" id="data-atual"></span>
    </header>

    <section class="content">

        <a href="{{ route('agendamento.detalhe') }}" class="back">
            ← Voltar para detalhes
        </a>

        <h1>Registrar devolução</h1>

        <p class="subtitle">
            Registre o estado dos equipamentos devolvidos.
        </p>

        <div class="card">

            <div class="title">Informações da retirada</div>

            <div class="row g-3">

                <div class="col-md-3">
                    <div class="info"><strong>Agendamento</strong><br>#0001</div>
                </div>

                <div class="col-md-3">
                    <div class="info"><strong>Funcionário</strong><br>Funcionário 01</div>
                </div>

                <div class="col-md-3">
                    <div class="info"><strong>Sala</strong><br>FABLAB 01</div>
                </div>

                <div class="col-md-3">
                    <div class="info"><strong>Retirada</strong><br>05/10/2026 - 08:00</div>
                </div>

            </div>

        </div>

        <div class="card">

            <div class="title">Equipamentos</div>

            <div class="equipment">

                <strong>Notebook Dell - NB001</strong>

                <label class="form-label">Estado na devolução</label>

                <select class="form-select">
                    <option>Bom</option>
                    <option>Regular</option>
                    <option>Danificado</option>
                </select>

                <label class="form-label">Observação</label>

                <input type="text" class="form-control" placeholder="Observação do equipamento">

            </div>

            <div class="equipment">

                <strong>Projetor Epson - PJ001</strong>

                <label class="form-label">Estado na devolução</label>

                <select class="form-select">
                    <option>Bom</option>
                    <option>Regular</option>
                    <option>Danificado</option>
                </select>

                <label class="form-label">Observação</label>

                <input type="text" class="form-control" placeholder="Observação do equipamento">

            </div>

        </div>

        <div class="warning">
            Confira o estado dos equipamentos antes de confirmar a devolução.
        </div>

        <div class="card">

            <div class="title">Observação geral</div>

            <textarea class="form-control" placeholder="Digite uma observação sobre a devolução..."></textarea>

        </div>

        <div class="actions">

            <a href="{{ route('agendamento.detalhe') }}" class="cancel">
                Cancelar
            </a>

            <form action="{{ route('agendamento') }}" method="GET">
                <button type="submit" class="confirm">
                    Confirmar devolução
                </button>
            </form>

        </div>

    </section>

</main>

<script>
    const agora = new Date();

    document.getElementById('data-atual').textContent =
        agora.toLocaleDateString('pt-BR', {
            timeZone: 'America/Sao_Paulo',
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        }).replace('.', '');
</script>

</body>
</html>