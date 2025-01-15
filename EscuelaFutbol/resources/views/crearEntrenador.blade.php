@extends('template')
@section('title', 'Crear Categoría')
@section('content')

<h3 style="text-align: center; letter-spacing: 1.1px;">Agregar Entrenador</h3>
<form action="{{ route('guardarEntrenador') }}" method="POST" style="margin: 1% 35% 20% 35%;">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del entrenador" required>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('categorias') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection