@extends('template')
@section('title','Horarios')
@section('content')

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h1 class="text-center mb-4">Horarios de Entrenamiento</h1>

            <!-- Tabla de categorías -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Categoría</th>
                            <th>Día de Entrenamiento</th>
                            <th>Hora</th>
                            <th>Cancha</th>
                            <th>Entrenador</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="categoria-table-body">
                        @foreach($horariosArray as $horario)
                        <tr>
                            <td>{{ $horario['id'] }}</td>
                            <td>{{ $horario['nombre'] }}</td>
                            <td>{{ $horario['dia_entrenamiento'] }}</td>
                            <td>{{ $horario['hora_inicio'] }} - {{ $horario['hora_fin'] }}</td>
                            <td>{{ $horario['cancha'] }}</td>
                            <td>Ent. {{ $horario['entrenador'] }}</td>
                            <td class="d-flex justify-content-evenly">
                                <button class="btn btn-primary btn-sm" onclick="mostrarModalEditar({{ $horario['id'] }}, '{{ $horario['nombre'] }}', '{{ $horario['dia_entrenamiento'] }}', '{{ $horario['hora_inicio'] }}', '{{ $horario['hora_fin'] }}', '{{ $horario['cancha'] }}', '{{ $horario['entrenador'] }}')">
                                    <i class="bi bi-pencil"></i> Editar
                                </button>
                                <form action="{{ url('Escuela/horarios/' . $horario['id'].' horario') }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="eliminarHorario()">
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
        <!-- Tabla tipo calendario -->
        <h2 class="text-center mt-5">Calendario de Entrenamientos</h2>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th>Hora</th>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miércoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $horas = ['08:00 - 09:00', '09:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00', '14:00 - 15:00', '15:00 - 16:00', '16:00 - 17:00', '17:00 - 18:00'];
                    $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
                    @endphp

                    @foreach($horas as $hora)
                    @php
                    [$horaInicio, $horaFin] = explode(' - ', $hora);
                    @endphp
                    <tr>
                        <td class="fw-bold">{{ $hora }}</td>
                        @foreach($dias as $dia)
                        <td>
                            @foreach($horariosArray as $horario)
                            @php
                            $diasEntrenamiento = explode(',', $horario['dia_entrenamiento']);
                            @endphp
                            @if(in_array($dia, $diasEntrenamiento) && $horaInicio >= substr($horario['hora_inicio'], 0, 5) && $horaFin <= substr($horario['hora_fin'], 0, 5))
                                <span class="badge bg-primary">{{ $horario['nombre'] }}</span>
                                @endif
                                @endforeach
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>





<!-- Modal para editar horario -->
<div class="modal fade" id="editarHorarioModal" tabindex="-1" aria-labelledby="editarHorarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarHorarioModalLabel">Editar Horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarHorarioForm" action="{{ url('Escuela/horarios/' . $horario['id'].' horario /edit') }}" method="POST">
                    @method("PUT")
                    @csrf
                    <!-- id de la categoría -->
                    <input type="hidden" id="idCat" name="idCat">
                    <!-- Nombre de la categoría -->
                    <div class=" mb-3">
                        <label for="categoriaNombre" class="form-label">Categoría</label>
                        <input type="text" id="categoriaNombre" class="form-control" readonly>
                    </div>

                    <!-- Días de entrenamiento -->
                    <div class="mb-3">
                        <label for="diasEntrenamiento" class="form-label">Días de Entrenamiento</label>
                        <div>
                            @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $dia)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="diasEntrenamiento[]" type="checkbox" id="dia_{{ $dia }}" value="{{ $dia }}">
                                <label class="form-check-label" for="dia_{{ $dia }}">{{ $dia }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Hora inicio y fin -->
                    <div class="mb-3">
                        <label for="horaInicio" class="form-label">Hora de Inicio</label>
                        <select id="horaInicio" name="horaInicio" class="form-select" require>
                            @for($i = 8; $i <= 17; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                                @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="horaFin" class="form-label">Hora de Fin</label>
                        <select id="horaFin" name="horaFin" class="form-select" require>
                            @for($i = 8; $i <= 18; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                                @endfor
                        </select>
                    </div>

                    <!-- Canchas -->
                    <div class="mb-3">
                        <label for="cancha" class="form-label">Cancha</label>
                        <select id="cancha" name="idCancha" class="form-select" require>
                            @foreach($canchasArray as $cancha)
                            <option value="{{ $cancha['id'] }}">{{ $cancha['nombre'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Entrenadores -->
                    <div class="mb-3">
                        <label for="entrenador" class="form-label">Entrenador</label>
                        <select id="entrenador" name="idEntrenador" class="form-select" require>
                            @foreach($entrenadoresArray as $entrenador)
                            <option value="{{ $entrenador['id'] }}">{{ $entrenador['nombre'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-success" value="Guardar Cambios">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href=" https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- JavaScript de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script para manejar el modal -->
<script>
    function mostrarModalEditar(id, nombre, dias, horaInicio, horaFin, cancha, entrenador) {
        console.log(document.getElementById('editarHorarioModal'));

        // Rellenar los campos del modal con la información del horario
        document.getElementById('categoriaNombre').value = nombre;
        document.getElementById('idCat').value = id;

        // Seleccionar días marcados
        const diasArray = dias.split(',');
        document.querySelectorAll('#editarHorarioModal .form-check-input').forEach(checkbox => {
            checkbox.checked = diasArray.includes(checkbox.value);
        });

        // Rellenar horarios, cancha y entrenador
        document.getElementById('horaInicio').value = horaInicio;
        document.getElementById('horaFin').value = horaFin;
        document.getElementById('cancha').value = cancha;
        document.getElementById('entrenador').value = entrenador;

        // Mostrar el modal
        const modal = new bootstrap.Modal(document.getElementById('editarHorarioModal'));
        modal.show();
    }

    function guardarCambios() {
        // Recopilar datos del formulario
        const dias = Array.from(document.querySelectorAll('#editarHorarioModal .form-check-input:checked'))
            .map(checkbox => checkbox.value)
            .join(',');

        const horaInicio = document.getElementById('horaInicio').value;
        const horaFin = document.getElementById('horaFin').value;
        const cancha = document.getElementById('cancha').value;
        const entrenador = document.getElementById('entrenador').value;

        // Aquí puedes enviar estos datos al servidor usando fetch o AJAX
        alert(`Cambios guardados:\nDías: ${dias}\nHora Inicio: ${horaInicio}\nHora Fin: ${horaFin}\nCancha: ${cancha}\nEntrenador: ${entrenador}`);
    }
</script>

@endsection