@extends('layouts.app')

@section ('content')

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('CSS/styles-area.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <title>Conexus</title>
</head>

<body>
  <main>
    <section class="home">
      
      <!-- TOPO: CARROSSEL + TEXTO -->
      <div class="home-top">
        
        <!-- CARROSSEL DE IMAGENS -->
        <div class="carousel">
          <img src="{{ asset('SRC/vicios.png') }}" class="carousel-image" alt="Imagem 1">
          <img src="{{ asset('SRC/abraco.png') }}" class="carousel-image" alt="Imagem 2">
          <img src="{{ asset('SRC/sala-imagem.png') }}" class="carousel-image" alt="Imagem 3">
        </div>

        <!-- TEXTO AO LADO -->
        <div class="home-text">
          <h4 class="text-h4"><strong>Você está na Conexus</strong></h4>
          <h1 class="text-h1">
  Aqui é o seu lugar para se
</h1>
<h2 class="text-h2">
  <strong>“Conectar”</strong>
</h2>
          <p>
            <strong>
              Escolha uma sala com o tema de seu interesse e participe de reuniões de apoio, conselhos 
              e onde você se sentirá acolhido e abraçado por pessoas que te entendem e enfrentam os mesmos desafios, 
              com um ajudando o outro, a cada passo e a cada nova vitória; Esse é o nosso objetivo, criar conexões, 
              gerando esperança e lembrando a cada pessoa que, mesmo nos dias mais difíceis, ninguém precisa caminhar sozinho.
            </strong>
          </p>
          <a href="salas.html" class="homeusuario-btn">Escolha uma sala</a>
        </div>
      </div>

      <!-- CARDS COMO BOTÕES -->
      <div class="cards-container">
        <a href="pagina1.html" class="card">
          <p><strong>Conheça cada um dos temas que são abordados nas salas de bate-papo</strong></p>
        </a>
        <a href="pagina2.html" class="card">
          <p><strong>Nosso objetivo e política da Conexus</strong></p>
        </a>
        <a href="pagina3.html" class="card">
          <p><strong>Agende uma consulta particular com um profissional com valores exclusivos para usuários da Conexus</strong></p>
        </a>
      </div>
    </section>
  </main>

  <!-- SCRIPT DO CARROSSEL -->
  <script>
    window.addEventListener('DOMContentLoaded', () => {
      const imagens = document.querySelectorAll('.carousel-image');
      let index = 0;

      function mostrarImagem(i) {
        imagens.forEach((img) => {
          img.classList.remove('active');
          img.style.opacity = 0;
        });
        imagens[i].classList.add('active');
        imagens[i].style.opacity = 1;
      }

      function proximaImagem() {
        index = (index + 1) % imagens.length;
        mostrarImagem(index);
      }

      mostrarImagem(index);
      setInterval(proximaImagem, 4000);
    });
  </script>
</body>
</html>

@endsection ('content')

