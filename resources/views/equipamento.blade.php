<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipamentos - FABLABCONTROLE</title>

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

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            margin: 0;
        }

        .subtitle {
            color: #64748b;
            font-size: 12px;
            margin: 5px 0 0;
        }

        .new {
            background: #166534;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 11px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 14px;
            margin-bottom: 20px;
        }

        .stat {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
        }

        .label {
            font-size: 10px;
            color: #64748b;
        }

        .number {
            font-size: 22px;
            font-weight: 700;
            margin-top: 5px;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 18px;
        }

        .card-title {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .search {
            width: 240px;
            height: 34px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            padding: 7px 10px;
            font-size: 11px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
        }

        th {
            color: #64748b;
            font-size: 10px;
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            font-size: 11px;
            padding: 12px 10px;
            border-bottom: 1px solid #f1f5f9;
        }

        .status {
            background: #dcfce7;
            color: #166534;
            padding: 5px 8px;
            border-radius: 10px;
            font-size: 9px;
        }

        .details {
            color: #2563eb;
            text-decoration: none;
            font-size: 10px;
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
        <a href="{{ route('agendamento') }}">Agendamentos</a>
        <a href="{{ route('equipamento') }}" class="active">Equipamentos</a>
        <a href="{{ route('login') }}">Sair</a>
    </nav>

</aside>

<main class="main">

    <header class="topbar">
        <span class="date" id="data-atual"></span>
    </header>

    <section class="content">

        <div class="header">

            <div>
                <h1>Equipamentos</h1>
                <p class="subtitle">Gerencie os equipamentos cadastrados no sistema.</p>
            </div>

            <a href="{{ route('equipamento.cadastro') }}" class="new">
                + Novo Equipamento
            </a>

        </div>

        <div class="stats">

            <div class="stat">
                <div class="label">Total de equipamentos</div>
                <div class="number">12</div>
            </div>

            <div class="stat">
                <div class="label">Disponíveis</div>
                <div class="number">08</div>
            </div>

            <div class="stat">
                <div class="label">Em uso</div>
                <div class="number">04</div>
            </div>

        </div>

        <div class="card">

            <div class="card-title">Lista de equipamentos</div>

            <input type="text" class="search" placeholder="Pesquisar equipamento">

            <table>

                <thead>
                    <tr>
                        <th>PATRIMÔNIO</th>
                        <th>EQUIPAMENTO</th>
                        <th>TIPO</th>
                        <th>MODELO</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>NB001</td>
                        <td>Notebook Dell</td>
                        <td>Notebook</td>
                        <td>Latitude 3420</td>
                        <td><span class="status">Disponível</span></td>
                        <td>
                            <a href="{{ route('equipamento.detalhe') }}" class="details">
                                Ver detalhes
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>PJ001</td>
                        <td>Projetor Epson</td>
                        <td>Projetor</td>
                        <td>EB-X06</td>
                        <td><span class="status">Disponível</span></td>
                        <td>
                            <a href="{{ route('equipamento.detalhe') }}" class="details">
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