@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Categoría</h1>

    <form action="{{ route('categorias.update', $categoria['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $categoria['nombre'] }}" required>
        </div>
        <div class="form-group">
            <label for="dia_entrenamiento">Día de Entrenamiento</label>
            <input type="text" name="dia_entrenamiento" id="dia_entrenamiento" class="form-control" value="{{ $categoria['dia_entrenamiento'] }}" required>
        </div>
        <div class="form-group">
            <label for="hora_inicio">Hora Inicio</label>
            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ $categoria['hora_inicio'] }}" required>
        </div>
        <div class="form-group">
            <label for="hora_fin">Hora Fin</label>
            <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="{{ $categoria['hora_fin'] }}" required>
        </div>
        <div class="form-group">
            <label for="id_cancha">Cancha</label>
            <input type="text" name="id_cancha" id="id_cancha" class="form-control" value="{{ $categoria['cancha'] }}" required>
        </div>
        <div class="form-group">
            <label for="id_entrenador">Entrenador</label>
            <input type="text" name="id_entrenador" id="id_entrenador" class="form-control" value="{{ $categoria['entrenador'] }}" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
