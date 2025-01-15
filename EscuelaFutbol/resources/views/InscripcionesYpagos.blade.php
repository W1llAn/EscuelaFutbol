@extends('template')
@section('title','Inscripciones')
@section('content')

<h3 style="text-align: center ; font-weight: bold; "> Inscripción</h3>
<h5 style="text-align: start; margin: 3px 5px 5px 75vh;  ">Datos Personales</h5>

<form action="{{url('Escuela/InscripcionesYpagos')}}" method="POST" style="margin: 1% 35% 20% 35%;">
    @csrf
    <div class="mb-3">
        <label for="lblNombres" class="form-label">Nombres</label>
        <input class="form-control" name="nombres" type="text" id="nombres" placeholder="Juan David" required>
    </div>
    <div class="mb-3">
        <label for="lbldireccion" class="form-label">Direccion</label>
        <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Calle 123" required>
    </div>
    <div class="mb-3">
        <label for="lbltelefono" class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" id="telefono" placeholder="0320000" required>
    </div>

    <div class="mb-3">
        <label for="lblfechaNaci" class="form-label">Fecha Nacimiento</label>
        <input type="date" name="fechaNaci" class="form-control" id="fechaNaci" required>
    </div>
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary" style="margin-right: 15px;">Registrar</button>
        <a href="{{ url('Escuela/InscripcionesYpagos') }}" class="btn btn-secondary">Cancelar</a>
    </div>

</form>
@endsection