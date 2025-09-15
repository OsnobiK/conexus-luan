<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas</title>
    <link rel="stylesheet" href="{{ asset('css/salas-criadas.css') }}">
</head>
<body>
    <a class="back-button" href="{{ route('perfil.show')}}" >&#8592;</a>
    <div class="container">
        <h1>Consultas Criadas</h1>
 
        <div class="card">
            <div class="info">
                <p><strong>Tema:</strong> Autismo</p>
                <p><strong>Doutor:</strong> Luan</p>
                <p><strong>Data e horário:</strong> 25/08/2025 às 17:00</p>
                <p><strong>Descrição:</strong> Iremos conversar sobre autismo</p>
            </div>
            <div class="actions">
                <a class="editar" href="{{ route('salas.create') }}">✏️ Editar</a>
                <button class="entrar">🚪 Entrar</button>
            </div>
        </div>
 
        <div class="card">
            <div class="info">
                <p><strong>Tema:</strong> Autismo</p>
                <p><strong>Doutor:</strong> Luan</p>
                <p><strong>Data e horário:</strong> 25/08/2025 às 17:00</p>
                <p><strong>Descrição:</strong> Iremos conversar sobre autismo</p>
            </div>
            <div class="actions">
                <a class="editar" href="{{ route('salas.create') }}">✏️ Editar</a>
                <div class="mensagem">
                    Você poderá entrar a partir de 5 minutos antes da conversa começar 😊
                </div>
            </div>
        </div>
    </div>
</body>
</html>