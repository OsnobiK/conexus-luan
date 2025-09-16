@extends('layouts.app')

<style>
    /* Definição de variáveis de cor para fácil customização */
    :root {
        --primary-color: #4A90E2; /* Azul suave */
        --primary-hover: #357ABD;
        --background-color: #F4F7F6; /* Fundo geral um pouco acinzentado */
        --form-background: #FFFFFF;
        --text-color: #333;
        --label-color: #555;
        --border-color: #DDE3E0;
        --border-focus: #4A90E2;
        --danger-color: #D0021B;
    }

    /* Container principal do formulário */
    .form-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 40px;
        background-color: var(--form-background);
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-container h1 {
        text-align: center;
        color: var(--text-color);
        margin-bottom: 8px;
        font-size: 2.2rem;
        font-weight: 600;
    }

    .form-container .subtitle {
        text-align: center;
        color: #777;
        margin-bottom: 40px;
    }

    /* Layout do formulário em Grid */
    .report-form {
        display: grid;
        grid-template-columns: 1fr 1fr; /* Duas colunas de tamanho igual */
        gap: 25px; /* Espaçamento entre os elementos */
    }

    /* Grupo de Label + Input */
    .form-group {
        display: flex;
        flex-direction: column;
    }

    /* Ocupa duas colunas do grid */
    .form-group.span-2 {
        grid-column: span 2;
    }

    .form-group label {
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--label-color);
        font-size: 0.9rem;
    }

    /* Estilo geral para inputs e textarea */
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 1rem;
        color: var(--text-color);
        background-color: #fdfdfd;
        transition: all 0.2s ease-in-out;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #aaa;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--border-focus);
        box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
    }

    .form-group textarea {
        resize: vertical; /* Permite redimensionar apenas na vertical */
        font-family: inherit;
    }

    /* Linha divisória */
    .section-divider {
        grid-column: span 2;
        border: none;
        border-top: 1px solid var(--border-color);
        margin: 15px 0;
    }

    /* Container do botão */
    .button-container {
        text-align: center;
    }

    .submit-button {
        padding: 15px 40px;
        border: none;
        border-radius: 8px;
        background-color: var(--primary-color);
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .submit-button:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
    }

    /* Responsividade para telas menores */
    @media (max-width: 768px) {
        .report-form {
            grid-template-columns: 1fr; /* Uma coluna em telas pequenas */
        }

        /* Todos os grupos passam a ocupar uma coluna */
        .form-group.span-2 {
            grid-column: span 1;
        }
        
        .form-container {
            margin: 20px;
            padding: 25px;
        }

        .form-container h1 {
            font-size: 1.8rem;
        }
    }
</style>


{{-- Conteúdo principal da página --}}
@section('content')
<main class="form-container">
    <h1>Cadastro de Laudo</h1>
    <p class="subtitle">Preencha as informações abaixo para registrar um novo laudo médico.</p>

    <form action="{{ route('laudo.store') }}" method="POST" class="report-form">
        @csrf {{-- Importante para segurança em formulários Laravel --}}

        {{-- Dados do Paciente --}}
        <div class="form-group span-2">
            <label for="nome">Nome Completo</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome completo" required>
        </div>
        <div class="form-group">
            <label for="data-nascimento">Data de Nascimento</label>
            <input type="date" id="data-nascimento" name="data-nascimento" required>
        </div>
        <div class="form-group">
            <label for="rg">RG</label>
            <input type="text" id="rg" name="rg" placeholder="00.000.000-0" required>
        </div>
        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
        </div>

        {{-- Divisor de Seção --}}
        <hr class="section-divider span-2">

        {{-- Dados do Médico --}}
        <div class="form-group span-2">
            <label for="medico">Nome do Médico</label>
            <input type="text" id="medico" name="medico" placeholder="Digite o nome do médico" required>
        </div>
        <div class="form-group">
            <label for="crm">CRM</label>
            <input type="text" id="crm" name="crm" placeholder="000000/SP" required>
        </div>
        <div class="form-group">
            <label for="especialidade">Especialidade</label>
            <input type="text" id="especialidade" name="especialidade" placeholder="Ex: Neurologia" required>
        </div>
         <div class="form-group">
            <label for="contato-medico">Contato do Médico (Telefone)</label>
            <input type="text" id="contato-medico" name="contato-medico" placeholder="(00) 00000-0000" required>
        </div>

        {{-- Divisor de Seção --}}
        <hr class="section-divider span-2">

        {{-- Detalhes do Laudo --}}
        <div class="form-group span-2">
            <label for="detalhes">Detalhes (desenvolvimento, histórico, tratamentos, etc.)</label>
            <textarea id="detalhes" name="detalhes" rows="6" placeholder="Descreva aqui os detalhes clínicos..." required></textarea>
        </div>
        <div class="form-group span-2">
            <label for="diagnostico">Diagnóstico</label>
            <input type="text" id="diagnostico" name="diagnostico" placeholder="Diagnóstico principal" required>
        </div>

        <div class="form-group span-2 button-container">
            <button type="submit" class="submit-button">Gerar PDF do Laudo</button>
        </div>
    </form>
</main>
@endsection

{{-- Injeta os scripts no final do <body> da página --}}

{{-- Inclui a biblioteca IMask.js via CDN --}}
<script src="https://unpkg.com/imask"></script>

{{-- Script para inicializar as máscaras --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Máscara para CPF
        const cpfInput = document.getElementById('cpf');
        if (cpfInput) {
            IMask(cpfInput, {
                mask: '000.000.000-00'
            });
        }

        // Máscara para RG
        const rgInput = document.getElementById('rg');
        if (rgInput) {
            IMask(rgInput, {
                mask: '00.000.000-0'
            });
        }

        // Máscara para CRM (exemplo, pode variar por estado)
        const crmInput = document.getElementById('crm');
        if (crmInput) {
            IMask(crmInput, {
                mask: '000000/SS',
                definitions: {
                    'S': /[A-Z]/
                }
            });
        }

        // Máscara para Telefone (aceita celular e fixo)
        const phoneInput = document.getElementById('contato-medico');
        if (phoneInput) {
            IMask(phoneInput, {
                mask: [
                    { mask: '(00) 0000-0000' },
                    { mask: '(00) 00000-0000' }
                ]
            });
        }
    });
</script>
