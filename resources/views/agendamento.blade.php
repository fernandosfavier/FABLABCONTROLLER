<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos - FABLABCONTROLE</title>

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
            color: white;
            padding: 16px 10px;
            z-index: 10;
        }

        .brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-logos {
            display: flex;
            justify-content: center;
            align-items: center;
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

        .menu a:hover,
        .menu a.active {
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

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            margin: 0;
            font-weight: 700;
        }

        .subtitle {
            color: #64748b;
            font-size: 12px;
            margin: 5px 0 0;
        }

        .btn-primary-custom {
            background: #166534;
            color: white;
            border: 0;
            border-radius: 6px;
            padding: 10px 15px;
            text-decoration: none;
            font-size: 12px;
        }

        .btn-primary-custom:hover {
            background: #14532d;
            color: white;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 20px;
        }

        .stat {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 17px;
        }

        .stat-label {
            color: #64748b;
            font-size: 11px;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 700;
            margin-top: 5px;
        }

        .table-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 18px;
        }

        .table-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .table-title {
            font-size: 14px;
            font-weight: 700;
        }

        .search {
            width: 230px;
            height: 34px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            color: #64748b;
            font-size: 10px;
            font-weight: 600;
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            font-size: 11px;
            padding: 12px 10px;
            border-bottom: 1px solid #f1f5f9;
        }

        .badge {
            font-size: 9px;
            padding: 5px 8px;
            border-radius: 12px;
        }

        .badge-green {
            color: #166534;
            background: #dcfce7;
        }

        .action {
            color: #2563eb;
            text-decoration: none;
            font-size: 10px;
        }

        @media(max-width:800px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .page-header {
                gap: 15px;
                align-items: flex-start;
                flex-direction: column;
            }
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

        <div class="page-header">

            <div>
                <h1>Agendamentos</h1>
                <p class="subtitle">Gerencie os agendamentos do FABLAB.</p>
            </div>

            <a href="{{ route('agendamento.novo') }}" class="btn-primary-custom">
                + Novo Agendamento
            </a>

        </div>

        <div class="stats">
            <div class="stat">
                <div class="stat-label">Total</div>
                <div class="stat-value">12</div>
            </div>

            <div class="stat">
                <div class="stat-label">Hoje</div>
                <div class="stat-value">04</div>
            </div>

            <div class="stat">
                <div class="stat-label">Pendentes</div>
                <div class="stat-value">03</div>
            </div>

            <div class="stat">
                <div class="stat-label">Concluídos</div>
                <div class="stat-value">05</div>
            </div>
        </div>

        <div class="table-card">

            <div class="table-head">
                <div class="table-title">Lista de agendamentos</div>
                <input type="text" class="search" placeholder="Pesquisar">
            </div>

            <table>
                <thead>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>FUNCIONÁRIO</th>
                        <th>SALA</th>
                        <th>DATA</th>
                        <th>HORÁRIO</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>#0001</td>
                        <td>Funcionário 01</td>
                        <td>FABLAB 01</td>
                        <td>05/10/2026</td>
                        <td>08:00 - 10:00</td>
                        <td>
                            <span class="badge badge-green">Agendado</span>
                        </td>
                        <td>
                            <a href="{{ route('agendamento.detalhe') }}" class="action">
                                Ver detalhes
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </section>

</main>

<script>
    function atualizarData() {
        const agora = new Date();

        let data = agora.toLocaleDateString('pt-BR', {
            timeZone: 'America/Sao_Paulo',
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });

        document.getElementById('data-atual').textContent = data.replace('.', '');
    }

    atualizarData();
</script>

</body>
</html>