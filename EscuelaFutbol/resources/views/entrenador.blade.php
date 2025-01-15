@extends('template')
@section('title', 'Entrenador')
@section('content')

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h1 class="text-center mb-4">Entrenadores</h1>

            <!-- Botón para crear nueva categoría -->
            <a href="{{ route('crearEntrenador') }}" class="btn btn-primary mb-3">Agregar Entrenador</a>

            <!-- Tabla de categorías -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre del Entrenador</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entrenadorArray as $entrenador)
                        <tr>
                            <td>{{ $entrenador['nombre'] }}</td>
                            <td class="d-flex justify-content-evenly">
                                <!-- Botón Editar -->
                                <button 
                                    class="btn btn-warning btn-sm" 
                                    onclick="mostrarModalEditar(
                                        {{ $entrenador['id'] }}, 
                                        '{{ $entrenador['nombre'] }}'
                                    )"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalEditar"
                                >
                                    <i class="bi bi-pencil"></i> Editar
                                </button>
                                <!-- Botón Eliminar -->
                                <form action="{{ route('eliminarEntrenador', $entrenador['id']) }}" method="POST">
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
        </div>
    </div>
</div>


<!-- Bootstrap JavaScript (con Popper.js incluido) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Modal para Editar Entrenador -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEditarEntrenador" method="POST" action="{{ route('actualizarEntrenador', ['id' => 0]) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarLabel">Editar Entrenador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editarNombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="editarNombre" class="form-control" required>
                        <input type="hidden" name="id" id="editarId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function mostrarModalEditar(id, nombre) {
        // Llenar los campos del modal con los datos del entrenador
        document.getElementById('editarId').value = id;
        document.getElementById('editarNombre').value = nombre;

        // Actualizar la acción del formulario
        const form = document.getElementById('formEditarEntrenador');
        form.action = "{{ url('/Escuela/entrenadores') }}/" + id;
    }
</script>

@endsection
