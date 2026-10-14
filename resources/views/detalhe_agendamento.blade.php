<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Agendamento - FABLABCONTROLE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f8fafc;
            font-family: Inter, Arial, sans-serif;
            color: #1f2937;
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
            color: white;
            background: #0e496d;
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
            color: #64748b;
            font-size: 12px;
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

        .status {
            background: #dcfce7;
            color: #166534;
            border-radius: 12px;
            padding: 5px 10px;
            font-size: 10px;
            display: inline-block;
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
            margin-bottom: 15px;
        }

        .label {
            color: #64748b;
            font-size: 10px;
            margin-bottom: 3px;
        }

        .value {
            font-size: 12px;
            font-weight: 600;
        }

        table {
            width: 100%;
        }

        th {
            color: #64748b;
            font-size: 10px;
            text-align: left;
            padding: 9px;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            font-size: 11px;
            padding: 11px 9px;
            border-bottom: 1px solid #f1f5f9;
        }

        .actions {
            display: flex;
            justify-content: space-between;
        }

        .btn-back,
        .btn-return {
            text-decoration: none;
            padding: 9px 17px;
            border-radius: 5px;
            font-size: 11px;
        }

        .btn-back {
            border: 1px solid #cbd5e1;
            color: #475569;
            background: white;
        }

        .btn-return {
            color: white;
            background: #166534;
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

        <a href="{{ route('agendamento') }}" class="back">← Voltar para agendamentos</a>

        <h1>Detalhes do Agendamento</h1>

        <p class="subtitle">
            Visualize as informações do agendamento.
        </p>

        <span class="status">Agendado</span>

        <div class="card mt-3">

            <div class="title">Informações do agendamento</div>

            <div class="row g-4">

                <div class="col-md-2">
                    <div class="label">Código</div>
                    <div class="value">#0001</div>
                </div>

                <div class="col-md-3">
                    <div class="label">Funcionário</div>
                    <div class="value">Funcionário 01</div>
                </div>

                <div class="col-md-3">
                    <div class="label">Sala</div>
                    <div class="value">FABLAB 01</div>
                </div>

                <div class="col-md-2">
                    <div class="label">Data</div>
                    <div class="value">05/10/2026</div>
                </div>

                <div class="col-md-2">
                    <div class="label">Horário</div>
                    <div class="value">08:00 - 10:00</div>
                </div>

            </div>

        </div>

        <div class="card">

            <div class="title">Equipamentos solicitados</div>

            <table>

                <thead>
                    <tr>
                        <th>EQUIPAMENTO</th>
                        <th>PATRIMÔNIO</th>
                        <th>STATUS</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>Notebook Dell</td>
                        <td>NB001</td>
                        <td>Disponível</td>
                    </tr>

                    <tr>
                        <td>Projetor Epson</td>
                        <td>PJ001</td>
                        <td>Disponível</td>
                    </tr>

                </tbody>

            </table>

        </div>

        <div class="card">

            <div class="title">Observação</div>

            <p class="mb-0" style="font-size:11px;color:#64748b;">
                Utilização dos equipamentos para atividade no laboratório.
            </p>

        </div>

        <div class="actions">

            <a href="{{ route('agendamento') }}" class="btn-back">
                Voltar
            </a>

            <a href="{{ route('agendamento.devolucao') }}" class="btn-return">
                Registrar retirada
            </a>

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