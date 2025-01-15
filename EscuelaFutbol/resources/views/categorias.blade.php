@extends('template')
@section('title','Categorias')
@section('content')
<div class="container">
    <h1 class="my-4">Categorías</h1>
    <a href="{{ route('crearCategoria') }}" class="btn btn-primary mb-3">Crear Nueva Categoría</a>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Día de Entrenamiento</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Cancha</th>
                <th>Entrenador</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoriasArray as $categoria)
                <tr>
                    <td>{{ $categoria['nombre'] }}</td>
                    <td>{{ $categoria['dia_entrenamiento'] }}</td>
                    <td>{{ $categoria['hora_inicio'] }}</td>
                    <td>{{ $categoria['hora_fin'] }}</td>
                    <td>{{ $categoria['cancha'] }}</td>
                    <td>{{ $categoria['entrenador'] }}</td>
                    <td>
                        <a href="{{ route('editarCategoria', $categoria['id']) }}" class="btn btn-warning btn-sm">Editar</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
