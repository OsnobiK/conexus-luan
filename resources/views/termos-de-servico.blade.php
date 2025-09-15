@extends('layouts.app')

@section('content')

{{-- Adicionando estilos diretamente na view para facilitar --}}
<style>
    .terms-page-container {
        background-color: #f4f4f4;
        padding: 50px 20px;
        font-family: 'Poppins', sans-serif;
    }

    .terms-card {
        max-width: 800px;
        margin: 0 auto;
        background-color: #ffffff;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .terms-header h1 {
        text-align: center;
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 30px;
        background: linear-gradient(135deg, #14afa0, #6c57d4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .terms-content {
        line-height: 1.7;
        color: #4a5568;
    }

    .terms-content h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2d3748;
        margin-top: 30px;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e2e8f0;
    }

    .terms-content p {
        margin-bottom: 15px;
    }

    .terms-content strong {
        color: #2d3748;
    }

    .terms-content ul {
        list-style-position: inside;
        padding-left: 0;
    }

    .terms-content li {
        margin-bottom: 10px;
    }

    .terms-content a {
        color: #6c57d4;
        text-decoration: none;
        font-weight: 600;
    }

    .terms-content a:hover {
        text-decoration: underline;
    }

    .signature {
        text-align: center;
        font-style: italic;
        margin-top: 40px;
        color: #718096;
    }

</style>

<div class="terms-page-container">
    <div class="terms-card">
        <div class="terms-header">
            <h1>Termos de Serviço</h1>
        </div>

        <div class="terms-content">
            <section>
                <h2>1. Aceitação dos Termos</h2>
                <p>Ao se cadastrar e utilizar o aplicativo Conexus, o usuário declara que leu, entendeu e concorda com os presentes Termos e Condições de Uso. O não aceite destes termos impede o uso da plataforma.</p>
            </section>

            <section>
                <h2>2. Objetivo do Aplicativo</h2>
                <p>O Conexus tem como finalidade proporcionar um espaço seguro e acolhedor para:</p>
                <ul>
                    <li>Participação em grupos de apoio emocional e compartilhamento de experiências;</li>
                    <li>Realização de consultas com psicólogos credenciados;</li>
                    <li>Promoção de saúde mental por meio de escuta ativa e troca de vivências.</li>
                </ul>
            </section>

            <section>
                <h2>3. Cadastro do Usuário</h2>
                <p>Para utilizar os serviços, o usuário deverá fornecer informações verdadeiras e atualizadas no momento do cadastro. O uso de dados falsos ou de terceiros sem autorização implicará em suspensão imediata da conta.</p>
            </section>

            <section>
                <h2>4. Regras de Conduta</h2>
                <p>O usuário se compromete a:</p>
                <ul>
                    <li>Respeitar os demais participantes dos grupos e os profissionais da plataforma;</li>
                    <li>Evitar qualquer tipo de discurso de ódio, preconceito, intimidação, assédio ou cyberbullying;</li>
                    <li>Não fazer brincadeiras de mau gosto, ironias mal-intencionadas ou comentários ofensivos nos grupos;</li>
                    <li>Utilizar a plataforma apenas para os fins propostos, de maneira ética e responsável.</li>
                </ul>
            </section>

            <section>
                <h2>5. Penalidades e Multas</h2>
                <p>Caso o usuário viole qualquer regra de conduta, especialmente em relação à prática de cyberbullying, desrespeito ou comportamento abusivo nos grupos, estará sujeito a:</p>
                <ul>
                    <li>Suspensão ou banimento imediato da plataforma, sem aviso prévio;</li>
                    <li>Cobrança de multa no valor de R$ 500,00 (quinhentos reais), a título de penalidade administrativa, além de possível responsabilização civil ou criminal, conforme a legislação aplicável.</li>
                </ul>
                <p>A reincidência poderá resultar em penalidades mais severas, incluindo ações judiciais.</p>
            </section>

            <section>
                <h2>6. Responsabilidade dos Usuários</h2>
                <p>Os conteúdos publicados nos grupos de apoio são de responsabilidade exclusiva dos usuários. O aplicativo não se responsabiliza por opiniões, conselhos ou comentários emitidos por participantes, embora se comprometa a moderar e remover conteúdos inadequados assim que identificados.</p>
            </section>

            <section>
                <h2>7. Consultas com Psicólogos</h2>
                <p>As consultas são realizadas com profissionais devidamente registrados nos órgãos competentes (CRP). A relação entre usuário e psicólogo é regida por princípios éticos da psicologia e sigilo profissional.</p>
            </section>

            <section>
                <h2>8. Privacidade e Proteção de Dados</h2>
                <p>Todos os dados fornecidos pelos usuários serão tratados conforme a <a href="https://www.gov.br/cidadania/pt-br/acesso-a-informacao/lgpd" target="_blank" rel="noopener noreferrer">LGPD - Lei Geral de Proteção de Dados Pessoais</a>, com confidencialidade, segurança e respeito à privacidade.</p>
            </section>

            <section>
                <h2>9. Alterações nos Termos</h2>
                <p>Reservamo-nos o direito de alterar estes Termos a qualquer momento, mediante aviso prévio aos usuários. O uso contínuo da plataforma após alterações implica concordância com as novas condições.</p>
            </section>

            <section>
                <h2>10. Foro</h2>
                <p>Fica eleito o foro da comarca de São Paulo/SP para dirimir quaisquer questões oriundas deste termo, com renúncia de qualquer outro por mais privilegiado que seja.</p>
            </section>

            <div class="signature">
                <p>Conexus</p>
                <p>Data da última atualização: 27 de agosto de 2025</p>
            </div>
        </div>
    </div>
</div>
@endsection
