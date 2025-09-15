<header class="main-header">
    <div class="header-interface">
        
        <div class="header-logo">
            <a href="{{ route('home') }}">C<span>o</span>nexus</a>
        </div>

        {{-- O menu principal agora não tem mais posicionamento absoluto --}}
        <nav class="main-nav" id="mainNav">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                @auth
                @if(Auth::user()->role === 'user')
                    <li><a href="{{ route('salas.index') }}">Salas</a></li>
                @endif
                @if(Auth::user()->role === 'medico')
                    <li><a href="{{ route('salas.create') }}">Criar Salas</a></li>
                @endif
                @endauth
                <li><a href="{{ route('abordagem') }}">Abordagem</a></li>
                <li><a href="{{ route('salas.index') }}">Agenda</a></li>
                <li><a href="{{ route('sobre') }}">Sobre Nós</a></li>
            </ul>
        </nav>

        <div class="header-right">
            @auth
                <div class="user-menu" id="userMenu">
                    @if(Auth::user()->profile_image)
                        {{-- LINHA CORRIGIDA --}}
                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="" class="user-avatar">
                    @else
                        <img src="https://i.pinimg.com/736x/11/49/7f/11497f10b3711b1b42a9e327159fc50c.jpg" alt="" class="user-avatar">
                    @endif

                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="{{ route('perfil.show') }}">Meu Perfil</a>
                        @if(Auth::user()->role === 'user')
                        <a href="{{ route('area-user') }}">Área de Usuário</a>
                        @endif
                        @if(Auth::user()->role === 'medico')
                        <a href="{{-- route('painel.medico') --}}">Validação de Laudos</a>
                        <a href="{{-- route('painel.medico') --}}">Fluxo de Usuarios</a>
                        
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                            @csrf
                            <button type="submit">Sair</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-connect">Conectar-se</a>
            @endguest

            {{-- Botão do Menu Mobile (Hambúrguer) --}}
            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Abrir menu">
                <div class="line line1"></div>
                <div class="line line2"></div>
                <div class="line line3"></div>
            </button>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Script existente para o menu dropdown do usuário
    const userMenu = document.getElementById('userMenu');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (userMenu && dropdownMenu) {
        userMenu.addEventListener('click', function(event) {
            event.stopPropagation();
            dropdownMenu.classList.toggle('active');
        });

        document.addEventListener('click', function(event) {
            if (!userMenu.contains(event.target)) {
                dropdownMenu.classList.remove('active');
            }
        });
    }

    // NOVO SCRIPT para o menu mobile
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mainNav = document.getElementById('mainNav');

    if (mobileMenuToggle && mainNav) {
        mobileMenuToggle.addEventListener('click', function() {
            // Adiciona/remove a classe 'active' para mostrar/esconder o menu
            mainNav.classList.toggle('active');
            // Adiciona/remove a classe 'active' para animar o ícone
            mobileMenuToggle.classList.toggle('active');
        });
    }
});
</script>

