<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Agendamento - FABLABCONTROLE</title>

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
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .header p {
            color: #64748b;
            font-size: 12px;
            margin: 5px 0 0;
        }

        .back {
            color: #2563eb;
            text-decoration: none;
            font-size: 11px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 22px;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .form-label {
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .form-control,
        .form-select {
            height: 38px;
            font-size: 11px;
            border-color: #cbd5e1;
            border-radius: 5px;
        }

        textarea.form-control {
            height: 90px;
            resize: vertical;
        }

        .equipment {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 10px;
        }

        .add {
            color: #2563eb;
            background: white;
            border: 1px dashed #94a3b8;
            border-radius: 5px;
            width: 100%;
            padding: 9px;
            font-size: 11px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .cancel {
            border: 1px solid #cbd5e1;
            color: #475569;
            background: white;
            padding: 9px 18px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 11px;
        }

        .save {
            border: 0;
            background: #166534;
            color: white;
            padding: 9px 18px;
            border-radius: 5px;
            font-size: 11px;
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

        <div class="header">
            <a href="{{ route('agendamento') }}" class="back">← Voltar para agendamentos</a>
            <h1>Novo Agendamento</h1>
            <p>Preencha as informações para criar um novo agendamento.</p>
        </div>

        <form action="{{ route('agendamento') }}" method="GET">

            <div class="card">

                <div class="card-title">Dados do agendamento</div>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Funcionário</label>
                        <select class="form-select">
                            <option>Selecione o funcionário</option>
                            <option>Funcionário 01</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Sala</label>
                        <select class="form-select">
                            <option>Selecione a sala</option>
                            <option>FABLAB 01</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Data</label>
                        <input type="date" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Horário inicial</label>
                        <input type="time" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Horário final</label>
                        <input type="time" class="form-control">
                    </div>

                </div>

            </div>

            <div class="card">

                <div class="card-title">Equipamentos</div>

                <div id="equipamentos">

                    <div class="equipment">
                        <select class="form-select">
                            <option>Selecione o equipamento</option>
                            <option>Notebook Dell - NB001</option>
                            <option>Projetor Epson - PJ001</option>
                        </select>
                    </div>

                </div>

                <button type="button" class="add" id="adicionar">
                    + Adicionar equipamento
                </button>

            </div>

            <div class="card">

                <div class="card-title">Observação</div>

                <textarea class="form-control" placeholder="Digite uma observação..."></textarea>

            </div>

            <div class="actions">
                <a href="{{ route('agendamento') }}" class="cancel">Cancelar</a>
                <button type="submit" class="save">Salvar Agendamento</button>
            </div>

        </form>

    </section>

</main>

<script>
    function atualizarData() {
        const agora = new Date();

        document.getElementById('data-atual').textContent =
            agora.toLocaleDateString('pt-BR', {
                timeZone: 'America/Sao_Paulo',
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            }).replace('.', '');
    }

    atualizarData();

    document.getElementById('adicionar').addEventListener('click', function () {
        const div = document.createElement('div');

        div.className = 'equipment';

        div.innerHTML = `
            <select class="form-select">
                <option>Selecione o equipamento</option>
                <option>Notebook Dell - NB001</option>
                <option>Projetor Epson - PJ001</option>
            </select>
        `;

        document.getElementById('equipamentos').appendChild(div);
    });
</script>

</body>
</html>