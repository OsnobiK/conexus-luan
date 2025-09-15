@extends('layouts.app')
 
@section('content')
 
{{-- Estilos específicos para a página Home --}}
<style>
    /* Reset e Fontes */
    .home-container * {
        font-family: 'Poppins', sans-serif;
    }
 
    /* Container Principal */
    .home-container {
        width: 100%;
        overflow-x: hidden;
    }
 
    /* Seção Herói (Principal) */
    .hero-section {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 80px 40px;
        background-color: #f8f9fa;
        text-align: center;
        margin-top: -90px;
    }
    .hero-text {
        max-width: 800px;
    }
    .hero-text .welcome-text {
        font-size: 1.5rem;
        font-weight: 600;
        background: linear-gradient(135deg, #14afa0, #6c57d4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
       
    }
    .hero-text .welcome-text span {
        color: #14afa0;
    }
    .hero-text .main-title {
        font-size: 3.5rem;
        font-weight: 700;
        color: #2d3748;
        margin: 10px 0;
    }
    .hero-text .main-title strong {
        color: #14afa0;
    }
    .hero-text .subtitle {
        font-size: 1.2rem;
        color: #4a5568;
        max-width: 600px;
        margin: 20px auto 30px;
        line-height: 1.6;
    }
    .hero-btn {
        background: linear-gradient(135deg, #14afa0, #6c57d4);
        color: #fff;
        padding: 15px 35px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: inline-block;
    }
    .hero-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
 
    /* Seção do Carrossel de Imagens */
    .carousel-section {
        padding: 60px 0;
        background-color: #f8f9fa;
    }
    .carousel-container {
        max-width: 2000px;
        margin: 0 auto;
        margin-top: -60px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    .carousel-slide {
        display: flex;
        width: 100%;
        transition: transform 0.5s ease-in-out;
    }
    .carousel-slide img {
        width: 100%;
        flex-shrink: 0;
        object-fit: cover;
        height: 500px; /* Altura fixa para o carrossel */
    }
    .carousel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 0 20px;
    }
    .carousel-nav button {
        background-color: rgba(255, 255, 255, 0.7);
        border: none;
        color: #2d3748;
        font-size: 2rem;
        margin-top: -150px;
        cursor: pointer;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .carousel-nav button:hover {
        background-color: #fff;
        transform: scale(1.1);
    }
 
    /* Seção "Como Funciona" */
    .how-it-works-section {
        padding: 80px 40px;
        text-align: center;
    }
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 50px;
    }
    .steps-container {
        display: flex;
        justify-content: center;
        gap: 40px;
        flex-wrap: wrap;
    }
    .step-card {
        background-color: #fff;
        border-radius: 15px;
        padding: 30px;
        max-width: 300px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
    }
    .step-card:hover {
        transform: translateY(-10px);
    }
    .step-number {
        background: linear-gradient(135deg, #14afa0, #6c57d4);
        color: #fff;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 2rem;
        font-weight: 700;
        margin: 0 auto 20px;
    }
    .step-card h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 10px;
    }
    .step-card p {
        color: #4a5568;
        line-height: 1.6;
    }
 
    /* Seção do Vídeo */
    .video-section {
        padding: 80px 40px;
        background-color: #fff;
        text-align: center;
    }
    .video-container {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }
    .video-container video {
        width: 100%;
        display: block;
    }
    #audio-btn {
        position: absolute;
        bottom: 20px;
        right: 20px;
        background-color: rgba(0, 0, 0, 0.6);
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s ease;
        z-index: 10;
    }
    #audio-btn:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }
 
 
    /* Seção de Depoimentos */
    .testimonials-section {
        padding: 80px 40px;
        background-color:rgba(255, 250, 250, 0.7);
        text-align: center;
    }
    .testimonials-container {
        display: flex;
        justify-content: center;
        gap: 40px;
        flex-wrap: wrap;
    }
    .testimonial-card {
        background-color: #fff;
        border-left: 5px solid #14afa0;
        padding: 30px;
        max-width: 350px;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        text-align: left;
    }
    .testimonial-text {
        font-style: italic;
        color: #4a5568;
        margin-bottom: 20px;
        line-height: 1.7;
    }
    .testimonial-author {
        font-weight: 700;
        color: #2d3748;
    }
 
    /* Seção CTA Final */
    .final-cta-section {
        padding: 80px 40px;
        background: linear-gradient(135deg, #14afa0, #6c57d4);
        text-align: center;
        color: #fff;
    }
    .final-cta-section h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }
    .final-cta-section p {
        font-size: 1.2rem;
        max-width: 600px;
        margin: 0 auto 30px;
        opacity: 0.9;
    }
 
</style>
 
<div class="home-container">
 
 <!-- Seção do Carrossel de Imagens -->
    <section class="carousel-section">
        <div class="carousel-container">
            <div class="carousel-slide">
                <img src="{{ asset('SRC/Gemini_Generated_Image_rrxvi9rrxvi9rrxv (1).png') }}" alt="Pessoas conversando em um ambiente acolhedor">
                <img src="{{ asset('SRC/Gemini_Generated_Image_rrxvi9rrxvi9rrxv (2).png') }}" alt="Grupo de amigos se apoiando">
                <img src="{{ asset('SRC/Gemini_Generated_Image_gl5aojgl5aojgl5a (1).png') }}" alt="Pessoa recebendo ajuda profissional online">
            </div>
            <div class="carousel-nav">
                <button id="prevBtn">&#10094;</button>
                <button id="nextBtn">&#10095;</button>
            </div>
        </div>
    </section>
 
 
    <!-- Seção Herói -->
    <section class="hero-section">
        <div class="hero-text">
            @auth
                <h4 class="welcome-text">Bem-vindo(a) de volta, <span>{{ Auth::user()->name }}</span>!</h4>
            @else
                <h4 class="welcome-text">Você está na C<span>o</span>nexus</h4>
            @endauth
           
            <h1 class="main-title">Porque todo mundo precisa de um lugar para se <strong>"conectar"</strong></h1>
            <p class="subtitle">
                Uma plataforma segura e anônima para compartilhar sentimentos e encontrar apoio com respeito, empatia e sem julgamentos.
            </p>
 
            @guest
                <a href="{{ route('escolha') }}" class="hero-btn">Cadastre-se ou Faça Login</a>
            @else
                <a href="{{ route('area-user') }}" class="hero-btn">Ir para Minha Área</a>
            @endauth
        </div>
    </section>
 
    <!-- Seção "Como Funciona" -->
    <section class="how-it-works-section">
        <h2 class="section-title">Como Funciona</h2>
        <div class="steps-container">
            <div class="step-card">
                <div class="step-number">1</div>
                <h3>Crie seu Perfil</h3>
                <p>Faça um cadastro rápido e seguro. Sua privacidade é nossa prioridade.</p>
            </div>
            <div class="step-card">
                <div class="step-number">2</div>
                <h3>Encontre uma Sala</h3>
                <p>Navegue por salas de bate-papo com temas específicos e encontre um grupo que te entenda.</p>
            </div>
            <div class="step-card">
                <div class="step-number">3</div>
                <h3>Conecte-se</h3>
                <p>Participe das conversas, compartilhe suas experiências e ouça outras histórias. Você não está sozinho.</p>
            </div>
        </div>
    </section>
 
    <!-- Seção de Vídeo -->
    <section class="video-section">
        <h2 class="section-title">Uma Mensagem Para Você</h2>
        <div class="video-container">
            <video id="narracao" muted playsinline loop poster="https://images.unsplash.com/photo-1543269865-cbf427effbad?q=80&w=2070&auto=format&fit=crop">
                <source src="{{ asset('SRC/narracao.mp4') }}" type="video/mp4">
                Seu navegador não suporta o elemento de vídeo.
            </video>
            <button id="audio-btn">🔊 Ativar Som</button>
        </div>
    </section>
 
    <!-- Seção de Depoimentos -->
    <section class="testimonials-section">
        <h2 class="section-title">O que nossos usuários dizem</h2>
        <div class="testimonials-container">
            <div class="testimonial-card">
                <p class="testimonial-text">"Encontrei na Conexus um espaço seguro para falar sobre coisas que eu não conseguia compartilhar com ninguém. Foi transformador."</p>
                <p class="testimonial-author">- Ana, 28 anos</p>
            </div>
            <div class="testimonial-card">
                <p class="testimonial-text">"Acolhimento de verdade, sem olhares tortos. É um lugar para ser você mesmo. Recomendo para todos que se sentem um pouco perdidos."</p>
                <p class="testimonial-author">- Marcos, 34 anos</p>
            </div>
            <div class="testimonial-card">
                <p class="testimonial-text">"Eu amo muito de verdade essa plataforma, não pela interface ou desenvolvimento muito bem feito... Mais sim pelo Acolhimento e lugar de nos expressar de forma anônima."</p>
                <p class="testimonial-author">- Calebi, 19 anos</p>
            </div>
        </div>
    </section>
 
    <br><br>
    <!-- Seção CTA Final -->
    <section class="final-cta-section">
        <h2>Pronto para começar sua jornada?</h2>
        <p>Junte-se a milhares de pessoas que encontraram um lugar de escuta e acolhimento. A conexão que você procura está a um clique de distância.</p>
        @guest
            <a href="{{ route('escolha') }}" class="hero-btn">Criar minha conta gratuita</a>
        @else
            <a href="{{ route('salas.index') }}" class="hero-btn">Explorar Salas</a>
        @endauth
    </section>
 
</div>
 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lógica do Carrossel
        const slide = document.querySelector('.carousel-slide');
        if (slide) {
            const images = document.querySelectorAll('.carousel-slide img');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            let counter = 0;
            let size = images.length > 0 ? images[0].clientWidth : 0;
 
            function updateSlidePosition() {
                if (size > 0) {
                    slide.style.transform = 'translateX(' + (-size * counter) + 'px)';
                }
            }
           
            function nextSlide() {
                if (images.length === 0) return;
                if (counter >= images.length - 1) {
                    counter = 0;
                } else {
                    counter++;
                }
                updateSlidePosition();
            }
 
            nextBtn.addEventListener('click', nextSlide);
 
            prevBtn.addEventListener('click', () => {
                if (images.length === 0) return;
                if (counter <= 0) {
                    counter = images.length - 1;
                } else {
                    counter--;
                }
                updateSlidePosition();
            });
           
            setInterval(nextSlide, 5000);
 
            window.addEventListener('resize', () => {
                if (images.length > 0) {
                    size = images[0].clientWidth;
                    updateSlidePosition();
                }
            });
        }
 
        // Lógica do Vídeo
        const video = document.getElementById('narracao');
        const audioBtn = document.getElementById('audio-btn');
       
        if (video && audioBtn) {
            video.addEventListener('click', () => {
                if (video.paused || video.ended) {
                    video.play();
                } else {
                    video.pause();
                }
            });
 
            audioBtn.addEventListener('click', (e) => {
                e.stopPropagation(); // Impede que o clique no botão pause/play o vídeo
                video.muted = !video.muted;
                audioBtn.textContent = video.muted ? "🔊 Ativar Som" : "🔇 Desativar Som";
            });
        }
    });
</script>
 
@endsection
 
 