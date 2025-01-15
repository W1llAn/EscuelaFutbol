<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styleTemplate.css') }}">
    <link rel="stylesheet" href="{{ asset('tailwind/flowbite.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleInicio.css') }}">
</head>

<body>

    <header>
        <img src="{{ asset('imagenes/header.png') }}" alt="Banner" style="width: 100%;">
    </header>

    <nav>
        <ul>
            <li><a href="{{ url('Escuela') }} " class="{{ Request::is('Escuela') ? 'active' : '' }}">Inicio</a></li>
            <li><a href="{{ url('Escuela/create') }}"
                    class="{{ Request::is('Escuela/create') ? 'active' : '' }}">Inscripciones</a></li>
            <li><a href="" class="{{ Request::is('Escuela/Equipos') ? 'Active' : '' }}">Equipos</a></li>
            <li><a href="">Entrenadores</a></li>
            <li><a href="">Horarios</a></li>
        </ul>

    </nav>

    <div class="container-inicio">
        @yield('content')
    </div>
</body>

</html>
