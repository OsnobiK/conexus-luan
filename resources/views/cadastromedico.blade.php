<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Conexus</title>
    {{-- Isso garante que o caminho para o CSS esteja correto --}}
    <link rel="stylesheet" href="{{ asset('CSS/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="{{ asset('js/medico.js') }}"></script>
</head>
<body>
    @if ($errors->any())
    <div style="background-color: #f8d7da; color: #721c24; padding: 1rem; border: 1px solid #f5c6cb; border-radius: .25rem; margin-bottom: 1rem;">
        <strong>Opa! Algo deu errado.</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="container">
        <div class="form-container">
            <h1 class="logo">C<span class="logo-o">o</span>nexus</h1>
            <h2>Crie sua conta</h2>
            <p>Junte-se à nossa comunidade para cuidar da saúde mental!</p>
            <form action="{{ route('cadastromedico.store') }}" method="POST">
                <input type="hidden" name="role" value="medico">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger" style="color: red; margin-bottom: 20px;">
                        <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Seus input-groups existentes --}}

    <div class="input-group">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required value="{{ old('nome') }}">
    </div>

    <div class="input-group">
        <label for="especialidade">Especialidade</label>
        <input type="text" id="especialidade" name="especialidade" placeholder="Digite sua especialidade" required value="{{ old('especialidade') }}">
    </div>

    <div class="input-group">
        <label for="cpf">CPF</label>
        <input type="text" id="cpf" name="cpf" placeholder="Apenas números" required value="{{ old('cpf') }}">
    
    <div class="input-group">
        <label for="crm">CRM</label>
        <input type="text" id="crm" name="crm" placeholder="Exemplo: 00000000-0/BR" required value="{{ old('crm') }}">
    </div>

    <div class="input-group">
        <label for="telefone">Telefone</label>
        <input type="tel" id="telefone" name="telefone" inputmode="numeric" placeholder="Apenas números" required value="{{ old('telefone') }}">
    </div>

    <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="seu.email@exemplo.com" required value="{{ old('email') }}">
    </div>

    <div class="input-group">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="password" placeholder="Crie uma senha segura" required>
    </div>

    <div class="input-group">
        <label for="confirmar-senha">Confirmar a senha</label>
        <input type="password" id="confirmar-senha" name="password_confirmation" placeholder="Confirme sua senha" required>
    </div>

    <div class="checkbox-group">
        <input type="checkbox" id="termos" name="termos" required {{ old('termos') ? 'checked' : '' }}>
        <label for="termos">Eu li e concordo com os <a href="{{ url('/termos-de-servico') }}" target="_blank">Termos de Serviço</a>.</label>
    </div>

    <button type="submit" class="submit-btn">Cadastrar</button>
    </form>
            <p class="login-link">Já tem uma conta? <a href="">Faça login</a></p>
        </div>
    </div>
</body>
</html>