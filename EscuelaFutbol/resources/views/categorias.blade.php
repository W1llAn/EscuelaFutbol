@extends('template')
@section('title', 'Categorías')
@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h1 class="text-center mb-4">Categorías</h1>

            <!-- Botón para crear nueva categoría -->
            <a href="{{ route('crearCategoria') }}" class="btn btn-primary mb-3">Crear Nueva Categoría</a>

            <!-- Tabla de categorías -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Día de Entrenamiento</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Cancha</th>
                            <th>Entrenador</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categoriasArray as $categoria)
                        <tr>
                            <td>{{ $categoria['nombre'] }}</td>
                            <td>{{ $categoria['dia_entrenamiento'] }}</td>
                            <td>{{ $categoria['hora_inicio'] }}</td>
                            <td>{{ $categoria['hora_fin'] }}</td>
                            <td>{{ $categoria['cancha'] }}</td>
                            <td>{{ $categoria['entrenador'] }}</td>
                            <td class="d-flex justify-content-evenly">
                                <!-- Botón Editar -->
                                <button class="btn btn-warning btn-sm" onclick="mostrarModalEditar(
                                    {{ $categoria['id'] }}, 
                                    '{{ $categoria['nombre'] }}', 
                                    '{{ $categoria['dia_entrenamiento'] }}', 
                                    '{{ $categoria['hora_inicio'] }}', 
                                    '{{ $categoria['hora_fin'] }}', 
                                )">
                                    <i class="bi bi-pencil"></i> Editar
                                </button>
                                <!-- Botón Eliminar -->
                                <form action="{{ route('eliminarCategoria', $categoria['id']) }}" method="POST">
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

            <h1 class="text-center mb-4">Jugadores con Categoria</h1>

            <!-- Filtro y búsqueda -->
            <div class="row mb-3">

                <div class="col-md-6">
                    <!-- Búsqueda por nombre de jugador -->
                    <label for="buscarJugador" class="form-label">Buscar Jugador</label>
                    <input type="text" id="buscarJugador" class="form-control" placeholder="Buscar por nombre...">
                </div>
            </div>

            <!-- Tabla de jugador por categoria -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tbody id="tablaJugadores">
                        @foreach($jugadorCategoriaArray as $jugador)
                        <tr data-categoria="{{ $jugador['id'] }}" data-nombre="{{ $jugador['jugador'] }}">
                            <td>{{ $jugador['jugador'] }}</td>
                            <td>{{ $jugador['categoria'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h1 class="text-center mb-4">Jugadores sin Categoria</h1>

            <!-- Tabla de jugador sin categoria -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jugadroSinCategoriaArray as $jugadores)
                        <tr>
                            <td>{{ $jugadores['nombre'] }}</td>
                            <td>{{ $jugadores['direccion'] }}</td>
                            <td>{{ $jugadores['telefono'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <a href="javascript:void(0)" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#asignarJugadorModal">
                Asignar Jugador a Categoría
            </a>

        </div>
    </div>
</div>

<!-- Modal para asignar jugador a categoría -->
<div class="modal fade" id="asignarJugadorModal" tabindex="-1" aria-labelledby="asignarJugadorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="asignarJugadorModalLabel">Asignar Jugador a Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para asignar jugador -->
                <form id="asignarJugadorForm" action="{{ route('asignarJugadorACategoria') }}" method="POST">
                    @csrf

                    <!-- Combo box para seleccionar al jugador -->
                    <div class="mb-3">
                        <label for="jugador" class="form-label">Seleccionar Jugador</label>
                        <select class="form-select" id="jugador" name="jugador" required>
                            <option value="">Seleccionar Jugador</option>
                            @foreach($jugadroSinCategoriaArray as $jugador)
                            <option value="{{ $jugador['id'] }}">{{ $jugador['nombre'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Combo box para seleccionar la categoría -->
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Seleccionar Categoría</label>
                        <select class="form-select" id="categoria" name="categoria" required>
                            <option value="">Seleccionar Categoría</option>
                            @foreach($categoriasArray as $categoria)
                            <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Asignar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar categoría -->
<div class="modal fade" id="editarCategoriaModal" tabindex="-1" aria-labelledby="editarCategoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarCategoriaModalLabel">Editar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarCategoriaForm" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="idCategoria" name="id">

                    <!-- Nombre de la categoría -->
                    <div class="mb-3">
                        <label for="categoriaNombre" class="form-label">Nombre</label>
                        <input type="text" id="categoriaNombre" name="nombre" class="form-control" required>
                    </div>

                    <!-- Día de entrenamiento -->
                    <div class="mb-3">
                        <label for="diasEntrenamiento" class="form-label">Días de Entrenamiento</label>
                        <div>
                            @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $dia)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="dia_entrenamiento[]" type="checkbox" id="dia_{{ $dia }}" value="{{ $dia }}">
                                <label class="form-check-label" for="dia_{{ $dia }}">{{ $dia }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Horarios -->
                    <div class="mb-3">
                        <label for="horaInicio" class="form-label">Hora de Inicio</label>
                        <input type="time" id="horaInicio" name="hora_inicio" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="horaFin" class="form-label">Hora de Fin</label>
                        <input type="time" id="horaFin" name="hora_fin" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript (con Popper.js incluido) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Scripts -->
<script>
    function mostrarModalEditar(id, nombre, dias, horaInicio, horaFin) {
        // Configurar la acción del formulario
        const form = document.getElementById('editarCategoriaForm');
        form.action = `{{ route('actualizarCategoria', ':id') }}`.replace(':id', id);

        // Llenar campos del formulario del modal
        document.getElementById('idCategoria').value = id;
        document.getElementById('categoriaNombre').value = nombre;
        document.getElementById('horaInicio').value = horaInicio;
        document.getElementById('horaFin').value = horaFin;

        // Marcar días seleccionados
        const diasArray = dias.split(',');
        document.querySelectorAll('#editarCategoriaModal .form-check-input').forEach(checkbox => {
            checkbox.checked = diasArray.includes(checkbox.value);
        });

        // Mostrar el modal
        const modal = new bootstrap.Modal(document.getElementById('editarCategoriaModal'));
        modal.show();
    }

    // Filtrar jugadores por nombre y categoría
    document.getElementById('filtroCategoria').addEventListener('change', function() {
        filtrarJugadores();
    });

    document.getElementById('buscarJugador').addEventListener('input', function() {
        filtrarJugadores();
    });

    function filtrarJugadores() {
        const categoriaSeleccionada = document.getElementById('filtroCategoria').value;
        const buscarJugador = document.getElementById('buscarJugador').value.toLowerCase();

        const filas = document.querySelectorAll('#tablaJugadores tr');

        filas.forEach(function(fila) {
            const categoria = fila.getAttribute('data-categoria');
            const nombreJugador = fila.getAttribute('data-nombre').toLowerCase();

            let mostrar = true;

            if (categoriaSeleccionada && categoria !== categoriaSeleccionada) {
                mostrar = false;
            }

            if (buscarJugador && !nombreJugador.includes(buscarJugador)) {
                mostrar = false;
            }

            fila.style.display = mostrar ? '' : 'none';
        });
    }
</script>
@endsection