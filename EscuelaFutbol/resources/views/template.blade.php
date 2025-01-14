<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styleTemplate.css') }}">

</head>

<body>

    <header>
        <img src="{{ asset('imagenes/header.png') }}" alt="Banner" style="width: 100%;">
    </header>

    <nav>
        <ul>
            <li><a href="{{ url('Escuela') }} " class="{{Request::is('Escuela')?'active':''}}" >Inicio</a></li>
            <li><a href="{{url('Escuela/InscripcionesYpagos')}}" class="{{Request::is('Escuela/InscripcionesYpagos')?'active':''}}">Inscripciones/Pagos</a></li>
            <li><a href="" class="{{Request::is('Escuela/Equipos')?'Active':''}}" >Equipos</a></li>
            <li><a href="">Horarios</a></li>
        </ul>

    </nav>

    <div>
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>



</html>