@extends('layouts.app')

@section('content')
<style>
    /* Importando a fonte Poppins do Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

    /* Variáveis CSS para um tema consistente e fácil de customizar */
    :root {
        --cor-primaria: #007bff;
        --cor-secundaria: #8e44ad;
        --cor-perigo: #dc3545;
        --cor-sucesso: #28a745;
        --cor-fundo: #f4f7f6;
        --cor-card: #ffffff;
        --cor-texto-principal: #2c3e50;
        --cor-texto-secundario: #7f8c8d;
        --sombra-card: 0 10px 30px rgba(0, 0, 0, 0.07);
        --borda-raio: 16px; /* Bordas mais arredondadas */
    }

    body {
        font-family: 'Poppins', Arial, sans-serif;
        /* Fundo com um degradê suave para dar profundidade */
        background-color: white;
        margin: 0;
        padding: 20px;
        color: var(--cor-texto-principal);
    }

    .perfil-container {
        background-color: var(--cor-card);
        border: 3px solid transparent;
        background-clip: padding-box;
        border-image: linear-gradient(135deg, var(--cor-primaria), var(--cor-secundaria)) 1;
        
        max-width: 500px;
        margin: 40px auto;
        padding: 40px;
        border-radius: var(--borda-raio);
        box-shadow: var(--sombra-card);
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .perfil-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .perfil-foto {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        padding: 5px; /* Aumentando o espaço da borda */
        background: linear-gradient(45deg, #59dda0, var(--cor-primaria), #6f00ff); /* Degradê mais rico */
        margin: 0 auto 20px auto;
        display: block;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .perfil-nome {
        font-size: 2.2em;
        font-weight: 700;
        margin-bottom: 2px;
        letter-spacing: -1px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Estilo do crachá de identificação de papel (role) */
    .role-badge {
        display: inline-block;
        padding: 4px 12px;
        font-size: 0.7rem;
        font-weight: 700;
        border-radius: 20px;
        margin-left: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .role-badge.medico {
        background-color: var(--cor-primaria);
        color: white;
    }

    .role-badge.paciente {
        background-color: var(--cor-sucesso);
        color: white;
    }

    .perfil-email {
        color: var(--cor-texto-secundario);
        margin-bottom: 35px;
        font-size: 1.1em;
        font-weight: 300;
    }

    .perfil-info {
        text-align: left;
        margin-bottom: 35px;
    }

    .perfil-info-item {
        display: flex;
        align-items: center; /* Alinha ícone e texto verticalmente */
        padding: 15px 5px;
        font-size: 1em;
        border-bottom: 1px solid #f0f0f0;
        color: var(--cor-texto-secundario);
    }
    
    .perfil-info-item:last-child {
        border-bottom: none;
    }
    
    .info-icon {
        margin-right: 15px;
        color: var(--cor-primaria);
    }

    .info-label {
        font-weight: 600;
        color: var(--cor-texto-principal);
    }
    
    .info-value {
        margin-left: auto; /* Empurra o valor para a direita */
    }

    .botoes-container {
        margin-top: 20px;
        display: grid; /* Usando grid para um layout mais robusto */
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .button {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px; /* Espaço entre ícone e texto */
        border: none;
        color: white;
        padding: 14px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        font-size: 0.95em;
        transition: all 0.3s ease;
        line-height: 1; /* Adicionado para normalizar a altura da linha */
    }
    
    .button .btn-icon {
        transition: transform 0.3s ease;
    }
    
    .button .btn-icon svg {
        display: block; /* Remove espaço vertical extra que os SVGs podem ter */
    }

    .button:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .button:hover .btn-icon {
       transform: rotate(-5deg) scale(1.1);
    }

    /* Estilo do Botão Primário */
    .button-primary {
        grid-column: 1 / -1; /* Ocupa a largura total */
        background-image: linear-gradient(45deg, var(--cor-primaria) 0%, #59a5ff 100%);
    }

    /* Estilo dos Botões Secundários */
    .button-secondary {
        background-color: #f0f2f5;
        color: var(--cor-texto-principal);
        border: 1px solid #e0e0e0;
    }
    
    .button-secondary:hover {
        background-color: #e9ecef;
        border-color: #d1d1d1;
    }

    .button-danger {
        background-color: #fff0f2;
        color: var(--cor-perigo);
        border: 1px solid #ffdfe4;
    }
    
    .button-danger:hover {
        background-color: var(--cor-perigo);
        color: white;
    }

    @media (max-width: 600px) {
        .perfil-container {
            padding: 25px;
            margin: 20px auto;
        }
        .botoes-container {
            grid-template-columns: 1fr; /* Botões em coluna única */
        }
    }
</style>

<div class="perfil-container">

    @if(Auth::user()->profile_image)
        <img class="perfil-foto" src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Foto de Perfil">
    @else
        <img class="perfil-foto" src="https://placehold.co/150x150/EFEFEF/AAAAAA?text=Perfil" alt="Foto de Perfil Padrão">
    @endif

    @auth
        <div class="perfil-nome">
            {{ Auth::user()->name }}
            {{-- Mostra o crachá correspondente ao papel do usuário --}}
            @if(Auth::user()->role === 'medico')
                <span class="role-badge medico">Médico</span>
            @else
                <span class="role-badge paciente">Paciente</span>
            @endif
        </div>
        <div class="perfil-email">{{ Auth::user()->email }}</div>

        <div class="perfil-info">
            <div class="perfil-info-item">
                <span class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </span>
                <span class="info-label">Idade:</span>
                <span class="info-value">20</span>
            </div>
            <div class="perfil-info-item">
                <span class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                </span>
                <span class="info-label">Cidade:</span>
                <span class="info-value">{{ Auth::user()->cidade ?? 'Não informado' }}</span>
            </div>
            <div class="perfil-info-item">
                <span class="info-icon">
                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                </span>
                <span class="info-label">Telefone:</span>
                <span class="info-value">{{ Auth::user()->telefone ?? 'Não informado' }}</span>
            </div>
        </div>

        <div class="botoes-container">
            {{-- Botão de Editar Perfil (Comum a todos) --}}
            <a class="button button-primary" href="{{ route('perfil.edit') }}">
                <span class="btn-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                </span>
                Editar Perfil
            </a>

            {{-- Botões que mudam de acordo com o papel do usuário --}}
            @if(Auth::user()->role === 'medico')
                {{-- Botões para Médicos --}}
                <a class="button button-secondary" href="#"> {{-- Substituir '#' pela rota do painel do médico --}}
                     <span class="btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    </span>
                    Painel do Médico
                </a>
                <a class="button button-secondary" href="#"> {{-- Substituir '#' pela rota da agenda do médico --}}
                     <span class="btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </span>
                    Minha Agenda
                </a>
            @else
                {{-- Botões para Pacientes (user padrão) --}}
                <a class="button button-secondary" href="{{ route('cadastrolaudo') }}">
                     <span class="btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    </span>
                    Cadastrar Laudo
                </a>
                <a class="button button-secondary" href="{{ route('home') }}">
                     <span class="btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </span>
                    Meus Laudos
                </a>
            @endif

            {{-- Botão de Logout (Comum a todos) --}}
            <form method="POST" action="{{ route('logout') }}" style="grid-column: 1 / -1;">
                @csrf
                <button type="submit" class="button button-danger" style="width:100%;">
                     <span class="btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    </span>
                    Desconectar
                </button>
            </form>
        </div>
    @endauth
</div>
@endsection

