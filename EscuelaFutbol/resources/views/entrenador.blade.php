@extends('template')
@section('title', 'Entrenador')
@section('content')

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h1 class="text-center mb-4">Categorías</h1>

            <!-- Botón para crear nueva categoría -->
            <a href="{{ route('crearEntrenador') }}" class="btn btn-primary mb-3">Crear Nueva Categoría</a>

            <!-- Tabla de categorías -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre del Entrenador</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entrenadorArray as $entrenador)
                        <tr>
                            <td>{{ $entrenador['nombre'] }}</td>
                            <td class="d-flex justify-content-evenly">
                                <!-- Botón Editar -->
                                <button class="btn btn-warning btn-sm" onclick="mostrarModalEditar(
                                    {{ $categoria['id'] }}, 
                                    '{{ $categoria['nombre'] }}', 
                                )">
                                    <i class="bi bi-pencil"></i> Editar
                                </button>
                                <!-- Botón Eliminar -->
                                <form action="{{ route('eliminarEntrenador', $categoria['id']) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
