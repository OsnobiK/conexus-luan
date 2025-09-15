<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha seu Perfil - Conexus</title>
    <!-- Importando a fonte Poppins do Google Fonts para um visual consistente -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Reset básico e configuração do corpo da página */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            /* Mantendo o seu gradiente de fundo, mas garantindo que ele cubra toda a tela */
            background: linear-gradient(135deg, #59DDA0 0%, #8F7AF6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            color: #fff;
        }

        /* Container principal que centraliza o conteúdo */
        .main-container {
            text-align: center;
        }

        .title-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .title-section p {
            font-size: 1.1rem;
            font-weight: 300;
            margin-bottom: 3rem;
            opacity: 0.9;
        }

        /* Container que alinha os dois cards de escolha */
        .choice-container {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap; /* Permite que os cards quebrem a linha em telas menores */
            justify-content: center;
        }

        /* Estilo principal do card de escolha, com o efeito de vidro fosco (Glassmorphism) */
        .choice-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2.5rem 2rem;
            width: 300px;
            text-decoration: none;
            color: #fff;
            
            /* A mágica do Glassmorphism */
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px); /* Para compatibilidade com Safari */
            
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
            
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Efeito de hover para interatividade */
        .choice-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 16px 40px 0 rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .icon-wrapper svg {
            width: 40px;
            height: 40px;
        }

        .choice-card h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .choice-card p {
            font-weight: 300;
            line-height: 1.6;
            opacity: 0.9;
            flex-grow: 1; /* Faz com que o parágrafo ocupe o espaço disponível */
        }

        .cta-button {
            display: inline-block;
            margin-top: 1.5rem;
            padding: 0.75rem 2rem;
            background-color: rgba(255, 255, 255, 0.9);
            color: #764ba2;
            border-radius: 50px;
            font-weight: 600;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .choice-card:hover .cta-button {
            background-color: #fff;
            color: #667eea;
        }

    </style>
</head>
<body>
    <main class="main-container">
        <div class="title-section">
            <h1>Junte-se à Nossa Comunidade</h1>
            <p>Escolha como você gostaria de começar sua jornada conosco.</p>
        </div>

        <div class="choice-container">
            <!-- Card de Paciente -->
            <a href="{{ route('cadastro.create') }}" class="choice-card">
                <div class="icon-wrapper">
                    <!-- Ícone SVG para Paciente -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
                <h2>Paciente</h2>
                <p>Crie seu perfil, agende conversas em grupo e cuide da sua saúde mental.</p>
                <span class="cta-button">Selecionar Perfil</span>
            </a>
    
            <!-- Card de Médico -->
            <a href="{{ route('cadastromedico.create') }}" class="choice-card">
                <div class="icon-wrapper">
                    <!-- Ícone SVG para Médico (Estetoscópio) -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M12 2a5.5 5.5 0 0 1 5.5 5.5c0 2.22-1.34 4.13-3.26 5.03a.75.75 0 0 0-.24.57v1.4a.75.75 0 0 0 .75.75h.01a.75.75 0 0 0 .75-.75v-1.4a.75.75 0 0 0-.24-.57C17.66 11.63 19 9.72 19 7.5a7 7 0 1 0-14 0c0 2.22 1.34 4.13 3.26 5.03a.75.75 0 0 0-.24.57v1.4a.75.75 0 0 0 .75.75h.01a.75.75 0 0 0 .75-.75v-1.4a.75.75 0 0 0-.24-.57C6.34 11.63 5 9.72 5 7.5a7 7 0 0 0 7-5.5zM12 15.5a.75.75 0 0 0-.75.75v3a.75.75 0 0 0 .75.75h.01a.75.75 0 0 0 .75-.75v-3a.75.75 0 0 0-.76-.75z"></path></svg>
                </div>
                <h2>Médico</h2>
                <p>Junte-se à nossa equipe de profissionais, crie salas de conversa e ajude mais pessoas.</p>
                <span class="cta-button">Selecionar Perfil</span>
            </a>
        </div>
    </main>
</body>
</html>
