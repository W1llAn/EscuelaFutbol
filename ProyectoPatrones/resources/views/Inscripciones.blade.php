@extends('template')
@section('title','Inscripciones')
@section('content')

<h3 style="text-align: center ; letter-spacing: 1.1px; "> Datos Personales</h3>
<form action="{{url('Inscripciones/')}}" method="POST" style="margin: 1% 35% 20% 35%;">
    @csrf
    <div class="mb-3">
        <label for="lblNombres" class="form-label">Nombres</label>
        <input class="form-control" name="nombres" type="text" id="nombres" placeholder="Juan David">
    </div>
    <div class="mb-3">
        <label for="lblApellidos" class="form-label">Apellidos</label>
        <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Lopez Lopez">
    </div>
    <div class="mb-3">
        <label for="lblEdad" class="form-label">Edad</label>
        <input type="number" name="edad" class="form-control" id="edad">
    </div>
    <div class="mb-3">
        <label for="lblDireccion" class="form-label">Dirección</label>
        <input type="text" name="direccion" class="form-control" id="direccion">
    </div>
    <div class="mb-3">
        <label for="lblTelefono" class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" id="telefono">
    </div>
    <div class="mb-3">
    <label for="Categoria" class="form-label">Categoría</label>
    <select name="categoria" id="Categoria" class="form-select">
        <option value="Sub7">Sub7</option>
        <option value="Sub10">Sub10</option>
        <option value="Sub12">Sub12</option>
        <option value="Sub15">Sub15</option>
        <option value="Sub17">Sub17</option>
    </select>
</div>

    <button type="submit" class="btn btn-primary">Registrar</button>
       <a href="{{ url('Escuela') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection