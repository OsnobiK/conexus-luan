<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Minhas Conversas</title>
  <!-- ✅ Fonte Inter do Google -->
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #1ec2b3, #6c5edb);
      padding: 20px;
      margin: 0 !important;
      min-height: 100vh;
    }
 
    .card {
      background: white;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
 
    .card .info {
      max-width: 70%;
    }
 
    .card .action {
      background-color: #007bff;
      color: white;
      padding: 15px 25px;
      border-radius: 5px;
      text-align: center;
      font-weight: bold;
      cursor: default;
    }
 
    .card .action.hidden {
      display: none;
    }
 
    .back-button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      background-color: #007bff;
      color: black;
      border-radius: 50%;
      text-decoration: none;
      font-size: 24px;
      font-weight: bold;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
      transition: background-color 0.3s;
    }
 
    .back-button:hover {
      background-color: #0056b3;
      color: white;
    }
 
    .btn-success {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }
    .btn-success:hover {
      background-color: #0056b3;
    }
    h2 {
      color: white;
      margin-bottom: 20px;
      background: rgba(0, 0, 0, 0.2);
      padding: 10px;
      border-radius: 8px;
      text-align: center;
    }
 
  </style>
</head>
<body>
 
  <!-- Botão de voltar -->
  <a class="back-button" href="{{ route('perfil.show') }}">
    &#x2190; <!-- ← seta para esquerda -->
  </a>
 
  <!-- Card de conversa -->
  <div class="container" style="margin-top: 40px;">
    <h2 class="text-white">Suas conversas agendadas</h2>
 
    @if($salasFiltradas->isEmpty())
      <div style="color: white; text-align: center;">Você ainda não agendou nenhuma conversa.</div>
    @endif
 
    @foreach($salasFiltradas as $sala)
    @php
        $dataHoraSala = \Carbon\Carbon::parse($sala->data . ' ' . $sala->hora)->setTimezone('America/Sao_Paulo');
        $agora = \Carbon\Carbon::now()->setTimezone('America/Sao_Paulo');
        $minutosFaltando = $agora->diffInMinutes($dataHoraSala, false);
        $laudo = $sala->laudosPendentes->first(); // Verifica o laudo pendente para a sala
    @endphp
 
    <div class="card">
        <h4>Tema: {{ $sala->tema }}</h4>
        <p><strong>Doutor:</strong> {{ $sala->nome_medico }}</p>
        <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($sala->data)->format('d/m/Y') }}</p>
        <p><strong>Horário:</strong> {{ \Carbon\Carbon::parse($sala->data . ' ' . $sala->hora)->format('H:i') }}</p>
 
        @if($laudo)
            @switch($laudo->condicao)
                @case('pendente')
                    <p style="color: orange; font-weight: bold;">⚠️ Laudo pendente para validação</p>
                    @break
                @case('aprovado')
                    <p style="color: green; font-weight: bold;">✅ Laudo aprovado! Você poderá entrar 5 minutos antes.</p>
                    @break
                @case('rejeitado')
                    <p style="color: red; font-weight: bold;">❌ Laudo rejeitado. Envie um novo para participar.</p>
                    @break
            @endswitch
        @else
            <p style="color: gray;">⚠️ Laudo ainda não enviado.</p>
        @endif
 
        @if($minutosFaltando > 5)
            <p style="color: #555;">⏳ Você poderá entrar a partir de 5 minutos antes da conversa começar 😊</p>
        @elseif($minutosFaltando <= 5 && $minutosFaltando >= -60)
            <form action="#" method="POST">
                @csrf
                <button class="btn-success">Entrar</button>
            </form>
        @else
            <p style="color: red;">❌ Esta sala já foi encerrada.</p>
        @endif
    </div>
@endforeach
  </div>
 
  <script>
    function atualizarCondicaoConversas() {
      const cards = document.querySelectorAll('.card[data-date]');
      const agora = new Date();
 
      cards.forEach(card => {
        const dataStr = card.getAttribute('data-date');
        const dataConversa = new Date(dataStr);
        const diffMs = dataConversa - agora;
        const diffMin = diffMs / 1000 / 60;
 
        const condicaoDiv = card.querySelector('.condicao');
 
        if (diffMin <= 5 && diffMin > -60) {
          // Até 5 minutos antes ou já começou há pouco
          statusDiv.textContent = 'Entrar';
          statusDiv.style.cursor = 'pointer';
          statusDiv.onclick = () => alert("Entrando na sala...");
        } else if (diffMin > 5) {
          // Mais de 5 minutos antes
          statusDiv.textContent = 'Você poderá entrar a partir de 5 minutos antes da conversa começar 😊';
          statusDiv.style.cursor = 'default';
        } else {
          // Passou do tempo
          statusDiv.textContent = 'Conversa encerrada';
          statusDiv.style.backgroundColor = 'gray';
          statusDiv.style.cursor = 'not-allowed';
        }
      });
    }
 
    // Atualiza status ao carregar e a cada 30 segundos
    atualizarStatusConversas();
    setInterval(atualizarStatusConversas, 30000);
  </script>
 
</body>
</html>
 
 