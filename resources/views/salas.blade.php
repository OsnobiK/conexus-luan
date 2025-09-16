@extends('layouts.app')
 
@section('content')
<div class="top-bar">
    <form method="GET" action="{{ route('salas.index') }}" style="width: 100%; display: flex; justify-content: center;">
        <input
            type="text"
            name="search"
            class="search"
            placeholder="Pesquisar por tema ou médico..."
            value="{{ request('search') }}"
        />
    </form>
</div>
 
{{-- Mensagens de sucesso e erro --}}
@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
        {{ session('success') }}
    </div>
@endif
 
@if(session('error'))
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
        {{ session('error') }}
    </div>
@endif
 
<div class="cards" id="cards">
    @if($salas->isEmpty())
        <div style="text-align: center; color: white; margin-top: 20px;">
            Nenhuma sala encontrada com esse critério.
        </div>
    @endif
    @foreach($salas as $sala)
    @php
        $dataHoraSala = \Carbon\Carbon::parse($sala->data . ' ' . $sala->hora)->setTimezone('America/Sao_Paulo');
        $agora = \Carbon\Carbon::now()->setTimezone('America/Sao_Paulo');
        $minutosParaInicio = $agora->diffInMinutes($dataHoraSala, false); // minutos restantes
    @endphp
 
    <div class="card">
        <!-- Resto do código da sala -->
        <div class="card-header" onclick="toggleCard(this)">
            <span class="arrow">▶️</span>
            <span>Tema: {{ $sala->tema }}</span>
            <span>Doutor: {{ $sala->nome_medico }}</span>
            @php
                $ocupadas = $sala->agendamentos->count();
                $limite = $sala->numero_participantes;
            @endphp
 
            <span>
                Vagas: {{ $ocupadas }}/{{ $sala->numero_participantes }}
                @if($sala->agendamentos->count() >= $sala->numero_participantes)
                <button class="button-full" disabled>Sala já está cheia</button>
                @else
                    <span class="not-important">({{ $sala->numero_participantes - $ocupadas }} vaga(s) disponível(eis))</span>
                @endif
            </span>
            <span>Data: {{ \Carbon\Carbon::parse($sala->data)->format('d/m/Y') }}</span>
        </div>
            <div class="card-body">
@if ($sala->laudo_obrigatorio)
    @php
    $usuario = auth()->user();
    $pivot = $usuario ? $usuario->salas()->where('sala_id', $sala->id)->first()?->pivot : null;
    @endphp
 
    @php
    $temLaudoPendente = \App\Models\LaudoPendente::where('user_id', $usuario->id)
                        ->where('sala_id', $sala->id)
                        ->where('condicao', 'pendente')
                        ->exists();
@endphp
 
@if ($temLaudoPendente)
    <button class="button-available" disabled>Validando</button>
    <p>O médico irá validar o seu laudo. Veja a página <strong>"espera de salas"</strong> para o status.</p>
 
    @elseif ($temLaudo)
        {{-- Já tem um laudo geral, pode enviar o PDF específico para a sala --}}
        <form method="POST" action="{{ route('salas.agendar', $sala->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="upload">
                <label>Enviar laudo (PDF) para esta sala:</label>
                <input type="file" name="laudo" accept="application/pdf" required>
                <button type="submit" class="button-available">Enviar PDF</button>
            </div>
        </form>
 
    @else
        {{-- Não tem laudo nenhum, precisa registrar --}}
        <a href="{{ route('cadastrolaudo') }}" class="button-available">Registrar laudo</a>
        <p>Você precisa registrar seu laudo para agendar essa sala.</p>
    @endif
@else
    <form method="POST" action="{{ route('salas.agendar', $sala->id) }}">
        @csrf
        <button type="submit" class="button-available">Agendar conversa</button>
    </form>
@endif
 
    <!-- Exibição da informação de laudo obrigatório -->
    <div class="info">
        O laudo {!! $sala->laudo_obrigatorio ? '<span class="important">é obrigatório</span>' : '<span class="not-important">não é</span>' !!} obrigatório nesta sala
    </div>
    <div class="info">
        Data e horário: {{ \Carbon\Carbon::parse($sala->data)->format('d/m/Y') }} às {{ \Carbon\Carbon::parse($sala->hora)->format('H:i') }}
    </div>
    <div class="info">
        <strong>Descrição:</strong> {{ $sala->descricao }}
    </div>
</div>
            </div>
        </div>
    @endforeach
</div>
 
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #1ec2b3, #6c5edb); }
    .top-bar {
        display: flex;
        justify-content: center;
        margin-top: 30px;
        margin-bottom: 30px;
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
        gap: 20px;
    }
    .card {
        background-color: #f7f9f1;
        border-radius: 10px;
        padding: 15px 20px;
        transition: all 0.3s ease-in-out;
        overflow: hidden;
        border: 2px solid transparent;
        margin-bottom: 20px;
        margin-top: 20px;
    }
   
.cards > .card:first-child {
    margin-top: 0 !important;
}
     
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        flex-wrap: wrap;
    }
    .arrow {
        display: inline-block;
        transition: transform 0.3s;
    }
    .card.expanded .arrow {
        transform: rotate(90deg);
    }
    .card.expanded {
        border-color: #0066ff;
    }
    .card-body {
        display: none;
        padding-top: 15px;
        animation: fadeDown 0.3s ease-in-out;
    }
    .card.expanded .card-body {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }
    @keyframes fadeDown {
        0% { opacity: 0; transform: translateY(-10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .info {
        flex: 1;
        min-width: 200px;
    }
    .important {
        color: red;
    }
    .not-important {
        color: green;
    }
    .button-full, .button-available {
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }
    .button-full {
        background-color: red;
    }
    .button-available {
        background-color: #00e6b8;
    }
    .upload {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 20px;
    }
    .upload input[type="file"] {
    margin-bottom: 10px; /* Adiciona um espaço entre o campo de arquivo e o botão */
    }
    .button-available {
    margin-top: 10px; /* Adiciona um espaço entre o botão e o campo de arquivo */
}
    .button-available:hover {
        background-color: #00c9a3;
    }
    .button-full:hover {
        background-color: #cc0000;
    }
    .button-available:disabled, .button-full:disabled {
        background-color: grey;
        cursor: not-allowed;
    }
 
    @media (max-width: 768px) {
        .top-bar {
            justify-content: center;
        }
        .search {
            width: 95%;
            max-width: 100%;
        }
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
        .card {
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>
 
<script>
    function toggleCard(header) {
        const card = header.parentElement;
        card.classList.toggle('expanded');
    }
</script>
@endsection