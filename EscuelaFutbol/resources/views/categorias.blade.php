@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Categorías</h1>
    <a href="{{ route('categorias.create') }}" class="btn btn-primary mb-3">Crear Nueva Categoría</a>

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
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria['nombre'] }}</td>
                    <td>{{ $categoria['dia_entrenamiento'] }}</td>
                    <td>{{ $categoria['hora_inicio'] }}</td>
                    <td>{{ $categoria['hora_fin'] }}</td>
                    <td>{{ $categoria['cancha'] }}</td>
                    <td>{{ $categoria['entrenador'] }}</td>
                    <td>
                        <a href="{{ route('categorias.edit', $categoria['id']) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('categorias.destroy', $categoria['id']) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
