<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conexus - Sua Plataforma</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* |--------------------------------------------------------------------------
        | RESET GERAL E ESTILOS GLOBAIS
        |-------------------------------------------------------------------------- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #ffffff;
            color: #2d3748;
        }
        
     
        /* |--------------------------------------------------------------------------
        | Estilos do Header
        |-------------------------------------------------------------------------- */
        .main-header {
            background: linear-gradient(135deg, #14afa0, #6c57d4);
            padding: 0 20px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-interface {
            width: 100%;
            max-width: 1280px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-logo a {
            color: #fff;
            font-size: 2.2rem;
            font-weight: 700;
            text-decoration: none;
        }
        .header-logo span {
            background: #59dda0;
            -webkit-background-clip: text;
            color: transparent;
        }

        .main-nav {
            flex-grow: 1;
        }
        
        .main-nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 40px;
            align-items: center;
        }

        .main-nav a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            position: relative;
            padding-bottom: 5px;
            transition: color 0.3s ease;
        }
        .main-nav a:hover {
            color: #59dda0;
        }
        .main-nav a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #59dda0;
            transition: width 0.3s ease;
        }
        .main-nav a:hover::after {
            width: 100%;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }
        
        .btn-connect {
            color: #fff;
            border: 2px solid #fff;
            background-color: transparent;
            padding: 8px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-connect:hover {
            background-color: #fff;
            color: #6c57d4;
        }

        .user-menu {
            position: relative;
            cursor: pointer;
        }

        /* 👇 MUDANÇA AQUI: Aplicando o degradê na borda do avatar */
        .user-avatar {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            object-fit: cover;
            padding: 3px; /* Espessura da borda */
            background: linear-gradient(45deg, #59dda0, #00a2ff, #ff00ea);
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 70px;
            right: 0;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 220px;
            overflow: hidden;
            z-index: 1001;
        }
        .dropdown-menu.active { display: block; }
        .dropdown-menu a, .dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            text-align: left;
            padding: 14px 20px;
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            background: none;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .dropdown-menu a:hover, .dropdown-menu button:hover { background-color: #f0f2f5; }
        .dropdown-menu .logout-form { margin: 0; }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            z-index: 1002;
        }
        .mobile-menu-toggle .line {
            width: 30px;
            height: 3px;
            background-color: white;
            margin: 6px 0;
            transition: all 0.4s ease;
        }

        /* |--------------------------------------------------------------------------
        | ESTILOS RESPONSIVOS
        |-------------------------------------------------------------------------- */
        @media (max-width: 1024px) {
            .main-nav {
                display: none;
                position: absolute;
                top: 80px;
                left: 0;
                width: 100%;
                background-color: #ffffff;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }
            .main-nav.active {
                display: block;
            }
            .main-nav ul {
                flex-direction: column;
                gap: 0;
                padding: 10px 0;
            }
            .main-nav a {
                color: #2d3748;
                display: block;
                width: 100%;
                padding: 15px 20px;
                text-align: center;
                font-size: 1.2rem;
            }
            .main-nav a:hover {
                background-color: #f0f2f5;
                color: var(--cor-primaria);
            }
            .main-nav a::after {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .mobile-menu-toggle.active .line1 {
                transform: rotate(-45deg) translate(-7px, 7px);
            }
            .mobile-menu-toggle.active .line2 {
                opacity: 0;
            }
            .mobile-menu-toggle.active .line3 {
                transform: rotate(45deg) translate(-7px, -7px);
            }
        }
    </style>
</head>
<body>
    @include('layouts.partials.header') 

    <main>
        @yield('content')
    </main>

    {{-- @include('layouts.partials.footer') --}}
</body>
</html>

