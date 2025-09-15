 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha - Conexus</title>
    <link rel="stylesheet" href="{{ asset('CSS/styles-recuperacao.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="logo">c<span class="logo-o">o</span>nexus</h1>
            <h2>Recuperar sua senha</h2>
            <p>Insira seu e-mail abaixo. Enviaremos um link para você criar uma nova senha.</p>
            <form action="#">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="seu.email@exemplo.com">
                </div>
 
                <button type="submit" class="submit-btn" href="{{ route('redefinicao')}}">Enviar Link de Recuperação </button>
                <br><br>
               <p class="login-link"> <a href="{{ route('redefinicao')}}" class="forgot-password">Defina sua nova senha</a>
               
            </form>
             <p class="login-link"> <a href="{{ route('login')}}">Voltar para o Login</a></p>
        </div>
    </div>
</body>
</html>