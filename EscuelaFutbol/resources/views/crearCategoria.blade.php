@extends('template')
@section('title', 'Crear Categoría')
@section('content')

<h3 style="text-align: center; letter-spacing: 1.1px;">Crear Nueva Categoría</h3>
<form action="{{ route('guardarCategoria') }}" method="POST" style="margin: 1% 35% 20% 35%;">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la categoría" required>
    </div>
    
    <div class="mb-3">
        <label for="dia_entrenamiento" class="form-label">Días de Entrenamiento</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="dia_entrenamiento[]" id="lunes" value="Lunes">
            <label class="form-check-label" for="lunes">Lunes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="dia_entrenamiento[]" id="martes" value="Martes">
            <label class="form-check-label" for="martes">Martes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="dia_entrenamiento[]" id="miercoles" value="Miércoles">
            <label class="form-check-label" for="miercoles">Miércoles</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="dia_entrenamiento[]" id="jueves" value="Jueves">
            <label class="form-check-label" for="jueves">Jueves</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="dia_entrenamiento[]" id="viernes" value="Viernes">
            <label class="form-check-label" for="viernes">Viernes</label>
        </div>
    </div>

    <div class="mb-3">
        <label for="hora_inicio" class="form-label">Hora Inicio</label>
        <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="hora_fin" class="form-label">Hora Fin</label>
        <input type="time" name="hora_fin" id="hora_fin" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="id_cancha" class="form-label">Cancha</label>
        <select name="id_cancha" id="id_cancha" class="form-select" required>
            <option value="" disabled selected>Selecciona una cancha</option>
            @foreach($canchasArray as $cancha)
                <option value="{{ $cancha['id'] }}">{{ $cancha['nombre'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_entrenador" class="form-label">Entrenador</label>
        <select name="id_entrenador" id="id_entrenador" class="form-select" required>
            <option value="" disabled selected>Selecciona un entrenador</option>
            @foreach($entrenadoresArray as $entrenador)
                <option value="{{ $entrenador['id'] }}">{{ $entrenador['nombre'] }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('categorias') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
