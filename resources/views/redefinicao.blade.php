<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Conexus</title>
    <link rel="stylesheet" href=" {{ asset('CSS/styles-redefinicao.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="logo">C<span class="logo-o">o</span>nexus</h1>
            <h2>Crie sua nova senha</h2>
            <form action="#">
                <div class="input-group">
                    <label for="senha">Crie uma nova senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>
 
                <div class="input-group">
                    <label for="senha">Confirme sua nova senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Confirme sua senha" required>
                </div>
 
                <button type="submit" class="submit-btn">Confirmar Alteração</button><a href="{{ route('login')}}"></a>
            </form>
             <p class="login-link">Lembrou a senha? <a href="{{ route('login')}}">Faça o Login</a></p>
        </div>
    </div>
</body>
</html>