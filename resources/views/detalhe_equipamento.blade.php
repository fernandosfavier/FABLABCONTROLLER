<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Equipamento - FABLABCONTROLE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8fafc;
            color: #1f2937;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 150px;
            height: 100vh;
            background: #062b43;
            color: white;
            padding: 18px 10px;
            z-index: 10;
        }

        .brand {
            text-align: center;
            margin-bottom: 25px;
        }

        .brand-logos {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            width: 100%;
            height: 38px;
            margin-bottom: 7px;
        }

        .logo-sesi {
            display: block;
            width: auto;
            height: 30px;
            max-width: 48px;
            object-fit: contain;
        }

        .logo-fablab {
            display: block;
            width: auto;
            height: 30px;
            max-width: 62px;
            object-fit: contain;
        }

        .brand-name {
            font-size: 12px;
            font-weight: 700;
            line-height: 1.2;
        }

        .brand-name span {
            color: #22c55e;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 10px 9px;
            border-radius: 7px;
            color: #dbe7ef;
            text-decoration: none;
            font-size: 12px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: rgba(255,255,255,0.08);
            color: white;
        }

        .menu a.active {
            background: #166534;
            color: white;
        }

        .menu-icon {
            width: 17px;
            text-align: center;
            font-size: 14px;
        }

        .main {
            margin-left: 150px;
            min-height: 100vh;
        }

        .topbar {
            height: 52px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .date {
            font-size: 13px;
            color: #64748b;
        }

        .user {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .user-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #166534;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
        }

        .content {
            padding: 30px;
            max-width: 1200px;
        }

        .page-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .back-button {
            width: 38px;
            height: 38px;
            border: 1px solid #dbe2e8;
            border-radius: 8px;
            background: white;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 18px;
        }

        .back-button:hover {
            background: #f1f5f9;
        }

        .page-title {
            margin: 0;
            font-size: 25px;
            font-weight: 700;
            color: #1f2937;
        }

        .page-subtitle {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .status {
            margin-left: auto;
            padding: 6px 12px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
            font-weight: 600;
        }

        .card-custom {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .card-title {
            margin: 0 0 20px;
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px 35px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .info-label {
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 600;
        }

        .info-value {
            font-size: 14px;
            color: #1f2937;
            font-weight: 500;
        }

        .equipment-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .equipment-box:last-child {
            margin-bottom: 0;
        }

        .equipment-info {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .equipment-icon {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            background: #e0f2fe;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .equipment-name {
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
        }

        .equipment-code {
            margin-top: 3px;
            font-size: 11px;
            color: #64748b;
        }

        .equipment-status {
            padding: 5px 10px;
            border-radius: 15px;
            background: #dcfce7;
            color: #166534;
            font-size: 11px;
            font-weight: 600;
        }

        .observation {
            background: #f8fafc;
            border-radius: 8px;
            padding: 15px;
            font-size: 13px;
            color: #475569;
            line-height: 1.6;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        .button {
            height: 40px;
            padding: 0 18px;
            border-radius: 7px;
            font-size: 13px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .back-action {
            border: 1px solid #cbd5e1;
            background: white;
            color: #475569;
        }

        .edit-button {
            border: none;
            background: #166534;
            color: white;
            font-weight: 600;
        }

        .edit-button:hover {
            background: #14532d;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 75px;
            }

            .main {
                margin-left: 75px;
            }

            .brand-name {
                display: none;
            }

            .logo-sesi {
                height: 25px;
                max-width: 40px;
            }

            .logo-fablab {
                height: 25px;
                max-width: 52px;
            }

            .menu a {
                justify-content: center;
                padding: 11px 5px;
            }

            .menu a span:not(.menu-icon) {
                display: none;
            }

            .content {
                padding: 20px;
            }

            .topbar {
                padding: 0 15px;
            }

            .user-name {
                display: none;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .status {
                margin-left: 0;
            }

            .page-header {
                flex-wrap: wrap;
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

            <a href="#">
                <span class="menu-icon">⌂</span>
                <span>Dashboard</span>
            </a>

            <a href="#">
                <span class="menu-icon">▣</span>
                <span>Agendamentos</span>
            </a>

            <a href="#" class="active">
                <span class="menu-icon">▤</span>
                <span>Equipamentos</span>
            </a>

            <a href="#">
                <span class="menu-icon">♙</span>
                <span>Funcionários</span>
            </a>

            <a href="#">
                <span class="menu-icon">⌂</span>
                <span>Salas</span>
            </a>

            <a href="#">
                <span class="menu-icon">◷</span>
                <span>Histórico</span>
            </a>

            <a href="#">
                <span class="menu-icon">▥</span>
                <span>Relatórios</span>
            </a>

            <a href="#">
                <span class="menu-icon">⇥</span>
                <span>Sair</span>
            </a>

        </nav>

    </aside>

    <main class="main">

        <header class="topbar">

            <div class="topbar-right">

                <span class="date" id="data-atual"></span>

                <div class="user">
                    <div class="user-icon">U</div>
                    <span class="user-name">Usuário</span>
                </div>

            </div>

        </header>

        <section class="content">

            <div class="page-header">

                <a href="#" class="back-button">
                    ←
                </a>

                <div>
                    <h1 class="page-title">Detalhes do Equipamento</h1>
                    <p class="page-subtitle">
                        Visualize as informações e o histórico do equipamento.
                    </p>
                </div>

                <span class="status">
                    Disponível
                </span>

            </div>

            <div class="card-custom">

                <h2 class="card-title">
                    Informações do equipamento
                </h2>

                <div class="info-grid">

                    <div class="info-item">
                        <span class="info-label">Nome</span>
                        <span class="info-value">Notebook Dell</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Patrimônio</span>
                        <span class="info-value">NB001</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Tipo</span>
                        <span class="info-value">Notebook</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Modelo</span>
                        <span class="info-value">Dell Latitude 3420</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Status</span>
                        <span class="info-value">Disponível</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Cadastro</span>
                        <span class="info-value">05/10/2026</span>
                    </div>

                </div>

            </div>

            <div class="card-custom">

                <h2 class="card-title">
                    Observação
                </h2>

                <div class="observation">
                    Equipamento disponível para uso no FABLAB.
                    Verificar as condições do equipamento antes da retirada.
                </div>

            </div>

            <div class="card-custom">

                <h2 class="card-title">
                    Últimos registros
                </h2>

                <div class="equipment-box">

                    <div class="equipment-info">

                        <div class="equipment-icon">
                            💻
                        </div>

                        <div>
                            <div class="equipment-name">
                                Notebook Dell
                            </div>

                            <div class="equipment-code">
                                NB001 • Última movimentação
                            </div>
                        </div>

                    </div>

                    <span class="equipment-status">
                        Disponível
                    </span>

                </div>

                <div class="equipment-box">

                    <div class="equipment-info">

                        <div class="equipment-icon">
                            ◷
                        </div>

                        <div>
                            <div class="equipment-name">
                                Nenhum empréstimo registrado
                            </div>

                            <div class="equipment-code">
                                Este equipamento ainda não possui histórico.
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="actions">

                <a href="#" class="button back-action">
                    Voltar
                </a>

                <a href="#" class="button edit-button">
                    Editar equipamento
                </a>

            </div>

        </section>

    </main>

    <script>
        function atualizarData() {
            const agora = new Date();

            const opcoes = {
                timeZone: 'America/Sao_Paulo',
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            };

            let data = agora.toLocaleDateString('pt-BR', opcoes);

            data = data.replace('.', '');

            document.getElementById('data-atual').textContent = data;
        }

        atualizarData();
        setInterval(atualizarData, 60000);
    </script>

</body>
</html>
