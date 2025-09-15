<link rel="stylesheet" href="{{ asset('CSS/styles-parciais.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <div class="footer-logo">
                <a href="#">C<span>o</span>nexus</a>
            </div>
            <br>
            <p>Conectando você ao futuro. Sinta-se bem e acolhido.</p>
        </div>

        <div class="footer-section">
            <h4>Links Rápidos</h4>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('area-user') }}">Area do Usuario</a></li>
                <li><a href="{{ route('sobre') }}">Sobre Nós</a></li>
                <li><a href="{{ route('termos') }}">Termos e Serviços</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Contato</h4>
            <p>Email: contato@conexus.com</p>
            <p>Telefone: (11) 1234-5678</p>
            <p>Endereço: Rua Exemplo, 123, São Paulo - SP</p>
        </div>

        <div class="footer-section">
            <h4>Redes Sociais</h4>
            <div class="social-icons">
                <a href="https://www.facebook.com/?locale=pt_BR" target="_blank" arial-label="Facebook"><i
                        class="fab fa-facebook"></i></a>
                <a href="https://www.linkedin.com/?locale=pt_BR" target="_blank" arial-label="Linkedin"><i
                        class="fab fa-linkedin"></i></a>
                <a href="https://www.instagram.com/ocaleb_soares/" target="_blank" arial-label="Instgram"><i
                        class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 Conexus. Todos os direitos reservados.</p>
    </div>
</footer>