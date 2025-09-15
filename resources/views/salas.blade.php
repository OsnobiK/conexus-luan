@extends('layouts.app')

@section('content')
<div class="top-bar">
    <input type="text" class="search" placeholder="Pesquisar salas" />
</div>

<div class="cards" id="cards">
    @foreach($salas as $sala)
        <div class="card">
            <div class="card-header" onclick="toggleCard(this)">
                <span class="arrow">▶️</span>
                <span>Tema: {{ $sala->tema }}</span>
                <span>Doutor: {{ $sala->nome_medico }}</span>
                <span>
                Vagas: {{ $sala->numero_participantes }}/8
                @if($sala->numero_participantes >= 8)
                <span class="important">(Sala já está cheia)</span>
                @else
                <span class="not-important">({{ 8 - $sala->numero_participantes }} vagas disponíveis)</span>
                @endif
                </span>
            </div>
            <div class="card-body">
    @if($sala->laudo_obrigatorio == 1)
        <div class="info upload">
            📎 Laudo médico.<br />Anexar o arquivo em PDF por favor.
            <input type="file" accept="application/pdf" />
        </div>
    @endif
    <div class="info">
        O laudo {!! $sala->laudo_obrigatorio ? '<span class="important">é obrigatório</span>' : '<span class="not-important">não é</span>' !!} obrigatório nesta sala
    </div>
    <div class="info">
    Data e horário: {{ \Carbon\Carbon::parse($sala->data)->format('d/m/Y') }} às {{ \Carbon\Carbon::parse($sala->hora)->format('H:i') }}
    </div>
    @if($sala->numero_participantes >= 8)
    <button class="button-full" disabled>Sala já está cheia</button>
    @else
    <button class="button-available" onclick="openModal(event)">Agendar conversa</button>
    @endif
</div>
        </div>
    @endforeach
</div>

<div class="modal" id="modal">
    <div class="modal-content">
        <h3>Conversa agendada!</h3>
        <p>Você será redirecionado por e-mail.</p>
        <button onclick="closeModal()">Fechar</button>
    </div>
</div>

<style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #1ec2b3, #6c5edb); }
    .top-bar {
        display: flex;
        justify-content: center; /* Centraliza horizontalmente */
        margin-top: 30px; /* Adiciona margem superior */
        margin-bottom: 30px; /* Adiciona margem inferior */
        align-items: center;
        width: 100%;
    }
    .search {
        width: 60%;
        max-width: 400px;
        min-width: 180px;
        padding: 10px 15px;
        border-radius: 10px;
        border: none;
        font-size: 16px;
        background-color: #f0f0f0;
        margin: 0 auto;
        display: block;
    }
    .cards {
    display: flex;
    flex-direction: column;
    gap: 15px;
    padding-bottom: 40px;  /* Adicione esta linha */
    }
    .card { background-color: #f7f9f1; border-radius: 10px; padding: 15px 20px; transition: all 0.3s ease-in-out; overflow: hidden; border: 2px solid transparent; }
    .card-header { display: flex; justify-content: space-between; align-items: center; cursor: pointer; flex-wrap: wrap; }
    .arrow { display: inline-block; transition: transform 0.3s; }
    .card.expanded .arrow { transform: rotate(90deg); }
    .card.expanded { border-color: #0066ff; }
    .card-body { display: none; padding-top: 15px; animation: fadeDown 0.3s ease-in-out; }
    .card.expanded .card-body { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 20px; }
    @keyframes fadeDown { 0% { opacity: 0; transform: translateY(-10px); } 100% { opacity: 1; transform: translateY(0); } }
    .info { flex: 1; min-width: 200px; }
    .important { color: red; }
    .not-important { color: green; }
    .button-full, .button-available { padding: 10px 15px; border: none; border-radius: 6px; color: white; font-weight: bold; cursor: pointer; }
    .button-full { background-color: red; }
    .button-available { background-color: #00e6b8; }
    .upload { display: flex; flex-direction: column; gap: 8px; }
    .modal { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; z-index: 100; }
    .modal-content { background-color: white; padding: 20px; border-radius: 10px; width: 300px; }
    .modal-content input[type="file"] { margin-bottom: 10px; }
    @media (max-width: 768px) {
        .top-bar { justify-content: center; }
        .search { width: 95%; max-width: 100%; }
        .card-header { flex-direction: column; align-items: flex-start; gap: 5px; }
        .card { width: 100%; box-sizing: border-box;}
    }
</style>

<script>
    function toggleCard(header) {
        const card = header.parentElement;
        card.classList.toggle('expanded');
    }

    function openModal(e) {
        e.stopPropagation();
        document.getElementById('modal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }
</script>
@endsection