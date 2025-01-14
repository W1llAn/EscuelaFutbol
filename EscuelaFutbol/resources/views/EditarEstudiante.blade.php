@extends('template')
@section('title','Editar Inscripción')
@section('content')

<h3 style="text-align: center ; font-weight: bold; "> Inscripción</h3>
<h5 style="text-align: start; margin: 3px 5px 5px 75vh;  ">Editar Datos Personales</h5>

<form action="{{url('Escuela/InscripcionesYpagos/'.$Estudiante['id'].' actualizarEstudiante')}}" method="POST" style="margin: 1% 35% 20% 35%;">
    @method('PUT')
    @csrf
    <div class="mb-3">
        <label for="lblNombres" class="form-label">Nombres</label>
        <input class="form-control" name="nombres" type="text" id="nombres" value="{{$Estudiante['nombre']}}" required>
    </div>
    <div class="mb-3">
        <label for="lbldireccion" class="form-label">Dirección</label>
        <input type="text" name="direccion" class="form-control" id="direccion" value="{{$Estudiante['direccion']}}" required>
    </div>
    <div class=" mb-3">
        <label for="lbltelefono" class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" id="telefono" value="{{$Estudiante['telefono']}}" required>
    </div>

    <div class=" mb-3">
        <label for="lblfechaNaci" class="form-label">Fecha Nacimiento</label>
        <input type="date" name="fechaNaci" class="form-control" id="fechaNaci" value="{{$Estudiante['fecha_nacimiento']}}" required>
    </div>
    <div class=" d-flex justify-content-center">
        <button type="submit" class="btn btn-primary" style="margin-right: 15px;">Actualizar</button>
        <a href="{{ url('Escuela/InscripcionesYpagos') }}" class="btn btn-secondary">Cancelar</a>
    </div>

</form>
@endsection