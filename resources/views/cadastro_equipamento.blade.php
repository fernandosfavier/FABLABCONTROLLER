<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Equipamento - FABLABCONTROLE</title>

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
            font-size: 11px;
            text-decoration: none;
        }

        h1 {
            font-size: 24px;
            margin: 10px 0 5px;
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
            padding: 22px;
            max-width: 900px;
        }

        .title {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 11px;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            font-size: 11px;
            height: 38px;
            border-color: #cbd5e1;
        }

        textarea.form-control {
            height: 90px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .cancel {
            color: #475569;
            border: 1px solid #cbd5e1;
            background: white;
            border-radius: 5px;
            padding: 9px 17px;
            text-decoration: none;
            font-size: 11px;
        }

        .save {
            color: white;
            background: #166534;
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

        <a href="{{ route('equipamento') }}" class="back">
            ← Voltar para equipamentos
        </a>

        <h1>Novo Equipamento</h1>

        <p class="subtitle">
            Cadastre um novo equipamento no sistema.
        </p>

        <form action="{{ route('equipamento') }}" method="GET">

            <div class="card">

                <div class="title">Informações do equipamento</div>

                <div class="row g-3">

                    <div class="col-md-8">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" placeholder="Nome do equipamento">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Patrimônio</label>
                        <input type="text" class="form-control" placeholder="Ex.: NB001">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tipo</label>
                        <select class="form-select">
                            <option>Selecione</option>
                            <option>Notebook</option>
                            <option>Projetor</option>
                            <option>Impressora</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Modelo</label>
                        <input type="text" class="form-control" placeholder="Modelo do equipamento">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select class="form-select">
                            <option>Disponível</option>
                            <option>Manutenção</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Observação</label>
                        <textarea class="form-control" placeholder="Digite uma observação..."></textarea>
                    </div>

                </div>

            </div>

            <div class="actions">

                <a href="{{ route('equipamento') }}" class="cancel">
                    Cancelar
                </a>

                <button type="submit" class="save">
                    Salvar equipamento
                </button>

            </div>

        </form>

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