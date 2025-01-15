@extends('template')
@section('title','Pagos')
@section('content')

<h3 style="text-align: center ;font-weight: bold; "> Registro de Pago Mensual</h3>
<h5 style="text-align: start; margin: 3px 5px 5px 75vh;  ">Datos Personales</h5>

<form action="{{url('Escuela/InscripcionesYpagos/'.$Estudiante['id'])}}" method="POST" style="margin: 1% 35% 20% 35%;">
    @method('PUT')
    @csrf
    <div class="row mb-3">
        <!-- Primer campo: Nombres -->
        <div class="col-md-6">
            <label for="lblNombres" class="form-label">Nombres</label>
            <input class="form-control" name="nombres" type="text" id="nombres" value="{{$Estudiante['nombre']}}" readonly>
        </div>

        <!-- Segundo campo: Fecha de Inscripción -->
        <div class="col-md-6">
            <label for="lblFechaIns" class="form-label">Fecha de Inscripción</label>
            <input type="text" name="FechaIns" class="form-control" id="FechaIns" value="{{$Estudiante['fecha_inscripcion']}}" readonly>
        </div>
    </div>

    <div class="row mb-3">
        <!-- Tercer campo: Ultimo Pago -->
        <div class="col-md-6">
            <label for="lblEstadoPago" class="form-label">Estado de Pago</label>
            <input type="text" name="EstadoPago" class="form-control" id="EstadoPago" value="{{$Estudiante['estado_pago']}}" readonly>
        </div>
        <!-- Cuarto campo: Cantidad -->
        <div class="col-md-6">
            <label for="lblUltimoPago" class="form-label">Fecha Último Pago</label>
            <input type="text" name="UltimoPago" class="form-control" id="UltimoPago" value="{{$Estudiante['fecha_pago_mensual']}}" required readonly>
        </div>

    </div>

    <div class="row mb-3">
        <!-- Quinto campo: Fecha de Pago -->
        <div class="col-md-6">
            <label for="lblCantidad" class="form-label">Monto a Pagar</label>
            <input type="floatval" name="cantidad" class="form-control" id="cantidad" required>
        </div>

        <div class="col-md-6">
            <label for="lblfechaPago" class="form-label">Fecha Pago</label>
            <input type="date" name="fechaPago" class="form-control" id="fechaPago" required>
        </div>

    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary" style="margin-right: 15px;">Registrar</button>
        <a href="{{ url('Escuela/InscripcionesYpagos') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

@endsection