<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styleTemplate.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Estilos del menú lateral */
        #sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            background: #f8f9fa;
            transition: left 0.3s ease-in-out;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }

        #sidebar.active {
            left: 0;
        }

        /* El contenido principal no se mueve */
        #content {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* Botón para alternar el menú */
        .sidebar-toggle {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1000;
        }

        /* Estilos de enlaces en el menú */
        .nav-item a {
            padding: 10px 15px;
            display: flex;
            align-items: center;
            color: #212529;
            text-decoration: none;
            transition: background 0.3s ease-in-out;
            border-radius: 5px;
        }

        .nav-item a i {
            margin-right: 10px;
            font-size: 18px;
        }

        .nav-item a.active {
            background: #007bff;
            color: #fff;
        }

        .nav-item a:hover {
            background: #007bff;
            color: #fff;
        }

        .menu-header {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <header>
        <img src="{{ asset('imagenes/header.png') }}" alt="Banner" style="width: 100%;">
    </header>

    <!-- Botón para mostrar/ocultar el menú -->
    <button class="btn btn-primary sidebar-toggle" id="sidebarToggle">☰</button>

    <!-- Menú lateral -->
    <div id="sidebar" class="p-3">
        <div class="menu-header mt-5">Menú Principal</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('Escuela') ? 'active' : '' }}" href="{{ url('Escuela') }}">
                    <i class="fas fa-home"></i> Inicio
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('Escuela/InscripcionesYpagos') ? 'active' : '' }}" href="{{ url('Escuela/InscripcionesYpagos') }}">
                    <i class="fas fa-file-invoice-dollar"></i> Inscripciones/Pagos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('Escuela/categorias') ? 'active' : '' }}" href="{{ url('Escuela/categorias') }}">
                    <i class="fas fa-list-alt"></i> Categorías
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('Escuela/entrenadores') ? 'active' : '' }}" href="{{ url('Escuela/entrenadores') }}">
                    <i class="fas fa-user-friends"></i> Entrenadores
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('Escuela/horarios') ? 'active' : '' }}" href="{{ url('Escuela/horarios') }}">
                    <i class="fas fa-clock"></i> Horarios
                </a>
            </li>
        </ul>
    </div>

    <!-- Contenido principal -->
    <div id="content" class="p-3">
        @yield('content')
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        // Alternar la visibilidad del menú lateral
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>