@extends('template')

@section('title', 'Editar Categoría')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Categoría</h1>

    <!-- Formulario de edición -->
    <form action="{{ route('actualizarCategoria', $categoria['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $categoria['nombre']) }}" required>
        </div>

        <!-- Día de Entrenamiento -->
        <div class="form-group">
            <label for="dia_entrenamiento">Día de Entrenamiento</label>
            <div>
                @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $dia)
                    <label>
                        <input type="checkbox" name="dia_entrenamiento[]" value="{{ $dia }}" 
                        @if(in_array($dia, explode(',', $categoria['dia_entrenamiento']))) checked @endif>
                        {{ $dia }}
                    </label>
                    <br>
                @endforeach
            </div>
        </div>

        <!-- Hora de Inicio -->
        <div class="form-group">
            <label for="hora_inicio">Hora Inicio</label>
            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ old('hora_inicio', $categoria['hora_inicio']) }}" required>
        </div>

        <!-- Hora de Fin -->
        <div class="form-group">
            <label for="hora_fin">Hora Fin</label>
            <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="{{ old('hora_fin', $categoria['hora_fin']) }}" required>
        </div>

        <!-- Cancha -->
        <div class="form-group">
            <label for="id_cancha">Cancha</label>
            <select name="id_cancha" id="id_cancha" class="form-control" required>
                @foreach($canchasArray as $cancha)
                    <option value="{{ $cancha['id'] }}" 
                        @if($cancha['id'] == $categoria['id_cancha']) selected @endif>
                        {{ $cancha['nombre'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Entrenador -->
        <div class="form-group">
            <label for="id_entrenador">Entrenador</label>
            <select name="id_entrenador" id="id_entrenador" class="form-control" required>
                @foreach($entrenadoresArray as $entrenador)
                    <option value="{{ $entrenador['id'] }}" 
                        @if($entrenador['id'] == $categoria['id_entrenador']) selected @endif>
                        {{ $entrenador['nombre'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Botones -->
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('categorias') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
