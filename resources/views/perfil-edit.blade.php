<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - Moderno</title>
    <!-- Importação da fonte Poppins do Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Script do Tailwind CSS para estilização rápida -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Script do IMask.js para criar máscaras de input -->
    <script src="https://unpkg.com/imask"></script>
    <style>
        /* Variáveis CSS para um tema consistente, alinhado com a tela de perfil */
        :root {
            --cor-primaria: #007bff;
            --cor-secundaria: #8e44ad;
            --cor-perigo: #dc3545;
            --cor-sucesso: #28a745;
            --cor-fundo: #f4f7f6;
            --cor-card: #ffffff;
            --cor-texto-principal: #2c3e50;
            --cor-texto-secundario: #7f8c8d;
            --sombra-card: 0 10px 30px rgba(0, 0, 0, 0.07);
            --borda-raio: 16px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: linear-gradient(120deg, #fdfbfb 0%, #defffe 100%);
            color: var(--cor-texto-principal);
        }
        
        /* Estilo do container principal, com borda em degradê */
        .form-container {
            border: 3px solid transparent;
            background-clip: padding-box;
            border-image: linear-gradient(135deg, var(--cor-primaria), var(--cor-secundaria)) 1;
        }

        /* Estilização da área de upload de imagem */
        .image-upload-wrapper {
            position: relative;
            width: 140px;
            height: 140px;
        }

        .profile-image-preview {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .file-input-label {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: var(--cor-primaria);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 3px solid white;
            transition: all 0.3s ease;
        }
        .file-input-label:hover {
            transform: scale(1.1) rotate(10deg);
            background-color: var(--cor-secundaria);
        }
        
        /* Estilização dos campos de input com ícones */
        .input-group {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 16px;
            bottom: 13px; /* Valor ajustado para alinhar o ícone verticalmente */
            color: #bdc3c7;
            transition: color 0.3s ease;
            pointer-events: none; /* Para que o ícone não interfira com o clique no campo */
        }
        .form-input {
            padding-left: 48px !important; /* Espaço para o ícone */
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--cor-primaria);
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
        }
        .form-input:focus + .input-icon {
            color: var(--cor-primaria);
        }

        /* Estilização do botão primário */
        .btn-primary {
            background-image: linear-gradient(45deg, var(--cor-primaria) 0%, #59a5ff 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="form-container max-w-2xl mx-auto p-8 bg-white rounded-2xl shadow-2xl w-full">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">Editar Perfil</h1>
            <p class="text-gray-500 mt-2">Atualize suas informações pessoais.</p>
        </div>

        {{-- Alertas de Sucesso e Erro --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                <strong class="font-bold">Opa! Algo deu errado.</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PATCH')

            {{-- Upload de Foto --}}
            <div class="flex flex-col items-center space-y-4">
                <div class="image-upload-wrapper">
                    <img id="imagePreview" src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://placehold.co/140x140/EFEFEF/AAAAAA?text=Perfil' }}" alt="Pré-visualização da foto de perfil" class="profile-image-preview">
                    <label for="profile_image" class="file-input-label" title="Trocar imagem">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                    </label>
                    <input type="file" id="profile_image" name="profile_image" class="hidden" accept="image/*">
                </div>
            </div>

            {{-- Campos de Informações Pessoais --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="input-group">
                    <label for="name" class="block font-semibold text-gray-700 mb-2">Nome</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-input w-full p-3 transition">
                    <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></span>
                </div>
                <div class="input-group">
                    <label for="email" class="block font-semibold text-gray-700 mb-2">E-mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-input w-full p-3 transition">
                    <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></span>
                </div>
                <div class="input-group">
                    <label for="telefone" class="block font-semibold text-gray-700 mb-2">Telefone</label>
                    <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $user->telefone) }}" placeholder="(00) 00000-0000" class="form-input w-full p-3 transition">
                    <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></span>
                </div>
                 <div class="input-group">
                    <label for="cidade" class="block font-semibold text-gray-700 mb-2">Cidade</label>
                    <input type="text" id="cidade" name="cidade" value="{{ old('cidade', $user->cidade) }}" class="form-input w-full p-3 transition">
                    <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></span>
                </div>
            </div>

            <hr class="border-gray-200">

            {{-- Campos de Senha --}}
            <div>
                <p class="text-center text-gray-600 mb-4">Deixe os campos abaixo em branco para não alterar sua senha.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="input-group">
                        <label for="password" class="block font-semibold text-gray-700 mb-2">Nova Senha</label>
                        <input type="password" id="password" name="password" class="form-input w-full p-3 transition">
                        <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg></span>
                    </div>
                    <div class="input-group">
                        <label for="password_confirmation" class="block font-semibold text-gray-700 mb-2">Confirmar Nova Senha</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input w-full p-3 transition">
                        <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg></span>
                    </div>
                </div>
            </div>

            <div class="text-center pt-4">
                <button type="submit" class="w-full md:w-auto btn-primary text-white font-bold py-3 px-10 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300">
                    Salvar Alterações
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <a href="{{ route('perfil.show') }}" class="text-gray-500 hover:text-blue-600 font-medium transition">
                Voltar para o Perfil
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lógica para pré-visualização da imagem
            const profileImageInput = document.getElementById('profile_image');
            const imagePreview = document.getElementById('imagePreview');
            if (profileImageInput) {
                profileImageInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) { imagePreview.src = e.target.result; }
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Lógica para máscara de telefone
            const phoneInput = document.getElementById('telefone');
            if (phoneInput) {
                const phoneMaskOptions = {
                    mask: [ { mask: '(00) 0000-0000' }, { mask: '(00) 00000-0000' } ]
                };
                IMask(phoneInput, phoneMaskOptions);
            }
        });
    </script>

</body>
</html>

