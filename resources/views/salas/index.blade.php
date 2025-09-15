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
                    Vagas: 
                    @php
                        $vagas_disponiveis = 8 - $sala->numero_participantes;
                    @endphp
                    {{ $vagas_disponiveis > 0 ? $vagas_disponiveis : 0 }}/8
                </span>
            </div>
            <div class="card-body">
                <div class="info">
                    O laudo 
                    @if($sala->laudo_obrigatorio)
                        <span class="important">é obrigatório</span>
                    @else
                        <span class="not-important">não é</span>
                    @endif
                    nesta sala
                </div>
                @if($sala->laudo_obrigatorio)
                    <div class="info upload">
                        📎 Laudo médico.<br />Anexar o arquivo em PDF por favor.
                        <input type="file" accept="application/pdf" />
                    </div>
                @endif
                <div class="info">
                    Horário: de {{ $sala->hora }}
                </div>
                @if($vagas_disponiveis <= 0)
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
        <p>Você irá receber o link da conversa por e-mail.</p>
        <button onclick="closeModal()">Fechar</button>
    </div>
</div>

<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #1ec2b3, #6c5edb); }
    .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
    .search { width: 60%; padding: 10px 15px; border-radius: 10px; border: none; font-size: 16px; background-color: #f0f0f0; }
    .cards { display: flex; flex-direction: column; gap: 15px; }
    .card { background-color: #f7f9f1; border-radius: 10px; padding: 15px 20px; transition: all 0.3s ease-in-out; overflow: hidden; border: 2px solid transparent; }
    .card-header { display: flex; justify-content: space-between; align-items: center; cursor: pointer; }
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
        .search { width: 100%; margin-bottom: 10px; }
        .top-bar { flex-direction: column; align-items: stretch; }
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