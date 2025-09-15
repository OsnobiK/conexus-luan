@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/criar-salas.css') }}">

  <main>
    <section class="formulario-sala">
       <center><h1>Criar Nova Sala</h1></center>

      <form action="{{ route('salas.store') }}" method="POST">
        @csrf
        <label for="tema">Tema da Sala:</label>
        <input type="text" id="tema" placeholder="Tema que o doutor quer conversar" name="tema" required />

        <label for="descricao">Descrição (opcional):</label>
        <textarea id="descricao" name="descricao" rows="4" placeholder="Descreva o objetivo da sala..."></textarea>

        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required />

        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" required />

        <label for="numero_participantes">Número de Participantes:</label>
        <input type="number" id="numero_participantes" name="numero_participantes" min="2" max="8" required />

        <label for="nome_medico">Nome do Médico:</label>
        <input type="text" id="nome_medico" name="nome_medico" required />

        <label for="laudo">Laudo Obrigatório:</label>
        <select id="laudo" name="laudo" required>
          <option value="sim">Sim</option>
          <option value="nao">Não</option>
        </select>

        <button type="submit">Criar Sala</button>
      </form>
    </section>
  </main>
@endsection