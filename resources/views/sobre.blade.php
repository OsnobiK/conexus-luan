    @extends ('layouts.app')
 
    @section ('content')
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós</title>
    <link rel="stylesheet" href="">
</head>
 
<style>
        /* Import da fonte (pode ser mantido no HTML ou no topo do CSS) */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
 
    /* Variáveis de Cor para fácil customização */
    :root {
        --brand-green: #34D399; /* Um verde moderno e vibrante */
        --dark-blue: #1E293B;  /* Para textos principais, mais suave que o preto puro */
        --gray-text: #475569;   /* Para parágrafos */
        --background-light: #F8FAFC;
        --white: #FFFFFF;
    }
 
    /* Reset básico e configurações do Body */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
 
    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--background-light);
        color: var(--gray-text);
        line-height: 1.7; /* Melhora a legibilidade */
    }
 
    /* Container principal da seção "Sobre" */
    .about-section {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 60px 20px; /* Espaçamento generoso */
        min-height: 100vh;
    }
 
    .about-container {
        display: flex;
        align-items: center; /* Alinha verticalmente a imagem e o texto */
        max-width: 1100px;
        width: 100%;
        margin: 0 auto;
        background-color: var(--white);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07); /* Sombra mais suave */
        border-radius: 16px;
        overflow: hidden; /* Garante que os cantos da imagem fiquem arredondados */
        gap: 40px; /* Espaço entre a imagem e o conteúdo */
        padding: 40px;
    }
 
    /* Estilização da imagem */
    .about-image {
        flex: 1 1 40%; /* Flex-grow, flex-shrink, flex-basis */
        min-width: 300px;
    }
 
    .about-image img {
        width: 100%;
        height: auto;
        display: block;
    }
 
    /* Estilização do conteúdo de texto */
    .about-content {
        flex: 1 1 60%;
    }
 
    .about-content h2 {
        font-size: 2.5rem; /* 40px */
        font-weight: 700;
        margin-bottom: 16px;
        background: linear-gradient(135deg, #14afa0, #6c57d4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
 
    .about-content > p { /* O primeiro parágrafo, logo após o h2 */
        font-size: 1rem; /* 16px */
        margin-bottom: 32px;
        color: var(--gray-text);
    }
 
    .mission-vision {
        display: flex;
        flex-direction: column;
        gap: 24px; /* Espaço entre Missão e Visão */
    }
 
    .mission-vision .item h3 {
        color: var(--brand-green);
        font-size: 1.5rem; /* 24px */
        font-weight: 600;
        margin-bottom: 8px;
        /* Adicionando um ícone sutil antes do título */
        display: flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, #14afa0, #6c57d4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
 
    .mission-vision .item p {
        font-size: 0.95rem;
        color: var(--gray-text);
    }
 
 
    /* --- Responsividade para dispositivos móveis --- */
    @media (max-width: 992px) {
        .about-container {
            flex-direction: column; /* Empilha a imagem sobre o texto */
            padding: 30px;
            gap: 30px;
        }
 
        .about-content h2 {
            font-size: 2rem; /* Reduz o tamanho da fonte */
        }
    }
 
    @media (max-width: 480px) {
        .about-section {
            padding: 40px 15px;
        }
 
        .about-container {
            padding: 20px;
        }
 
        .about-content h2 {
            font-size: 1.8rem;
        }
 
        .mission-vision .item h3 {
            font-size: 1.3rem;
        }
    }
</style>
 
<body>
 
   <section class="about-section">
        <div class="about-container">
            <div class="about-image">
                <img src="{{ asset('SRC/Image-1.png') }}" alt="Interface de chat da plataforma Conxeus">
            </div>
            <div class="about-content">
                <h2>Quem somos</h2>
                <p>A Conxeus é uma plataforma virtual e anônima para pessoas que buscam apoio emocional. Oferecemos um espaço seguro para desabafar, com reuniões conduzidas por profissionais, promovendo a interação e a inclusão.</p>
               
                <div class="mission-vision">
                    <div class="item">
                        <h3>Missão</h3>
                        <p>Fornecer um espaço online seguro e anônimo para que pessoas com dificuldades emocionais possam se conectar, desabafar e receber apoio de profissionais, promovendo a saúde mental e o bem-estar.</p>
                    </div>
                    <div class="item">
                        <h3>Visão</h3>
                        <p>Nossa visão de longo prazo é tornar a Conxeus a principal plataforma de apoio emocional online, reconhecida por oferecer um ambiente seguro e inclusivo, onde a saúde mental é acessível e a conexão humana transforma vidas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
</body>
</html>
 
 @endsection ('content')
 