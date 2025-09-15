@extends('layouts.app')

@section('content')

{{-- Adicionando o link para a biblioteca de ícones Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    .approach-page {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    .approach-hero {
        background: linear-gradient(135deg, rgba(20, 175, 160, 0.9), rgba(108, 87, 212, 0.9)), url('https://images.unsplash.com/photo-1516542959825-7c185260a12a?q=80&w=1974&auto=format&fit=crop') no-repeat center center;
        background-size: cover;
        padding: 100px 20px;
        text-align: center;
        color: #fff;
    }

    .approach-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .approach-hero p {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto;
        opacity: 0.9;
    }

    .approach-section {
        padding: 80px 20px;
    }

    .section-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .section-title {
        text-align: center;
        font-size: 2.8rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 50px;
    }

    .pillars-container, .security-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .pillar-card, .security-card {
        background-color: #fff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .pillar-card:hover, .security-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    }

    .pillar-card .icon, .security-card .icon {
        font-size: 3rem;
        margin-bottom: 20px;
        color: #14afa0;
    }
    
    .security-card .icon {
        color: #6c57d4;
    }

    .pillar-card h3, .security-card h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 15px;
    }

    .pillar-card p, .security-card p {
        color: #4a5568;
        line-height: 1.7;
    }
    
    .security-section {
        background-color: #fff;
    }

</style>

<div class="approach-page">
    
    <!-- Seção Herói -->
    <section class="approach-hero">
        <h1>Nossa Abordagem e Sua Segurança</h1>
        <p>Entenda os pilares que guiam a Conexus e como nos comprometemos a proteger cada passo da sua jornada conosco.</p>
    </section>

    <!-- Seção de Abordagem -->
    <section class="approach-section">
        <div class="section-container">
            <h2 class="section-title">Como Trabalhamos</h2>
            <div class="pillars-container">
                <div class="pillar-card">
                    <div class="icon"><i class="fas fa-handshake-angle"></i></div>
                    <h3>Empatia em Primeiro Lugar</h3>
                    <p>Acreditamos no poder da escuta sem julgamentos. Nossas salas são espaços onde cada história é válida e cada sentimento é respeitado, criando um ambiente de apoio mútuo e genuíno.</p>
                </div>
                <div class="pillar-card">
                    <div class="icon"><i class="fas fa-user-secret"></i></div>
                    <h3>Anonimato e Respeito</h3>
                    <p>Você tem a liberdade de se expressar sem a pressão da identidade. O anonimato é uma ferramenta para garantir que o foco esteja no compartilhamento de experiências, não em quem você é fora daqui.</p>
                </div>
                <div class="pillar-card">
                    <div class="icon"><i class="fas fa-seedling"></i></div>
                    <h3>Crescimento Coletivo</h3>
                    <p>Ao compartilhar e ouvir, todos crescem. A Conexus é um ecossistema de aprendizado emocional, onde a vulnerabilidade é vista como força e cada interação é uma oportunidade de evolução.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção de Segurança -->
    <section class="approach-section security-section">
        <div class="section-container">
            <h2 class="section-title">Sua Segurança é Nossa Prioridade</h2>
            <div class="security-features">
                <div class="security-card">
                    <div class="icon"><i class="fas fa-shield-halved"></i></div>
                    <h3>Moderação Ativa</h3>
                    <p>Contamos com uma equipe de moderação dedicada a manter as salas seguras e livres de qualquer tipo de discurso de ódio, assédio ou comportamento inadequado, conforme nossos Termos de Serviço.</p>
                </div>
                <div class="security-card">
                    <div class="icon"><i class="fas fa-lock"></i></div>
                    <h3>Proteção de Dados (LGPD)</h3>
                    <p>Seus dados de cadastro são protegidos e tratados com a máxima confidencialidade, seguindo rigorosamente a Lei Geral de Proteção de Dados (LGPD). Não compartilhamos suas informações com terceiros.</p>
                </div>
                <div class="security-card">
                    <div class="icon"><i class="fas fa-comments-dollar"></i></div>
                    <h3>Comunicação Criptografada</h3>
                    <p>Toda a comunicação dentro da nossa plataforma utiliza criptografia para garantir que suas conversas permaneçam privadas e seguras, protegendo você de acessos não autorizados.</p>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection
