@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/cadastrolaudo.css') }}">

        <main>
        <div class="branco">
            <h1>Cadastro de laudo</h1>
            <form action="#" method="POST">
                <div class="form-row">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" placeholder="Nome" required>
                    <label for="data-nascimento">Data de nascimento:</label>
                    <input type="date" id="data-nascimento" name="data-nascimento" required>
                    <label for="rg">RG:</label>
                    <input type="text" id="rg" name="rg" placeholder="RG" required>
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" placeholder="CPF" required>
                </div>
                <div class="form-row">
                    <label for="medico">Nome do médico:</label>
                    <input type="text" id="medico" name="medico" placeholder="Nome do médico" required>
                    <label for="crm">CRM:</label>
                    <input type="text" id="crm" name="crm" placeholder="CRM" required>
                    <label for="especialidade">Especialidade do médico:</label>
                    <input type="text" id="especialidade" name="especialidade" placeholder="Especialidade" required>
                    <label for="contato-medico">Contato do médico:</label>
                    <input type="text" id="contato-medico" name="contato-medico" placeholder="Contato do médico" required>
                </div>
                <div class="form-row">
                    <label for="detalhes">Detalhes sobre o desenvolvimento, histórico de saúde, tratamentos anteriores (terapias, medicamentos), e informações sobre a família:</label>
                    <textarea id="detalhes" name="detalhes" required></textarea>
                </div>
                <div class="form-row">
                    <label for="diagnostico">Diagnóstico:</label>
                    <input type="text" id="diagnostico" name="diagnostico" required>
                </div>
                <button type="submit" class="pdf-button">PDF do laudo, por favor</button>
            </form>
            </div>
        </main>
        <footer>
        <img src="{{ asset('src/cerebro.jpg') }}" alt="Ícone de Cérebro" class="brain-icon">
        </footer>
    </div>

    <script>
        function toggleCard(header) {
      const card = header.parentElement;
      card.classList.toggle('expanded');
    }
 
    function toggleMenu() {
      const dropdown = document.getElementById('dropdown');
      dropdown.style.display = dropdown.style.display === 'flex' ? 'none' : 'flex';
    }
 
    function openModal(e) {
      e.stopPropagation();
      document.getElementById('modal').style.display = 'flex';
    }
 
    function closeModal() {
      document.getElementById('modal').style.display = 'none';
    }
 
    window.addEventListener('click', function (e) {
      const dropdown = document.getElementById('dropdown');
      const button = document.querySelector('.menu-button');
      const modal = document.getElementById('modal');
      if (!dropdown.contains(e.target) && !button.contains(e.target)) {
        dropdown.style.display = 'none';
      }
      if (modal.style.display === 'flex' && !modal.querySelector('.modal-content').contains(e.target)) {
        closeModal();
      }
    });
    </script>
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('css/laudo.css') }}">
@endpush