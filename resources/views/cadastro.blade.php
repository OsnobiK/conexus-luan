
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Conexus</title>
    <link rel="stylesheet" href="{{ asset('CSS/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    
    <div class="container">
        <div class="form-container">
            <h1 class="logo">C<span class="logo-o">o</span>nexus</h1>
            <h2>Crie sua conta</h2>
            <p>Junte-se à nossa comunidade para compartilhar experiências.</p>
            <form action="{{ route('cadastro.store') }}" method="POST">
                <input type="hidden" name="role" value="user">
            
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger" style="color: red; margin-bottom: 20px; text-align: left; background-color: #fdd; padding: 10px; border-radius: 5px;">
                        <strong>Opa! Algo deu errado.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="input-group">
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" placeholder="Digite seu nome completo" required value="{{ old('name') }}">
                </div>

                <div class="input-group">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" inputmode="numeric" placeholder="Apenas números" required value="{{ old('cpf') }}">
                </div>

                <div class="input-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" inputmode="numeric" placeholder="Apenas números" required value="{{ old('telefone') }}">
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="seu.email@exemplo.com" required value="{{ old('email') }}">
                </div>

                {{-- 👇 CORREÇÃO AQUI 👇 --}}
                <div class="input-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" placeholder="Crie uma senha segura" required>
                </div>

                {{-- 👇 E AQUI 👇 --}}
                <div class="input-group">
                    <label for="password_confirmation">Confirmar a senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirme sua senha" required>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="termos" name="termos" required>
                    <label for="termos">Eu li e concordo com os <a href="{{ route('termos') }}" target="_blank">Termos de Serviço</a>.</label>
                </div>

                <button type="submit" class="submit-btn">Cadastrar</button>
            </form>
            <p class="login-link">Já tem uma conta? <a href="{{ route('login') }}">Faça login</a></p>
            <p class="login-link">Voltar para o <a href="{{ route('home') }}">Início</a></p>
        </div>
    </div>

    
    <script src="{{ asset('js/masks.js') }}"></script>
    
</body>
</html>
