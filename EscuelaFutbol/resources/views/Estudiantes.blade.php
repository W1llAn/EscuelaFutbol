@extends('template')
@section('title', 'Estudiantes Inscritos')
@section('content')

@if (session('success'))
<div class="alert alert-success" id="successMessage">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger" id="errorMessage">
    {{ session('error') }}
</div>
@endif


<h1 class=" text-center">Jugadores </h1>
<form method="GET" action="{{ url('Escuela/InscripcionesYpagos') }}" id="myForm">
    <div class="container mt-3">
        <div class="mb-2">
            <label for="nombre" class="form-label">Nombre del Jugador</label>
            <input type="text" name="nombre" id="nombre" class="form-control">
        </div>
        <button type="button" class="btn btn-primary" onclick="submitForm()">Buscar</button>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ url('Escuela/InscripcionesYpagos/Inscripciones') }}" class="btn btn-primary me-2">Inscripciones</a>
        </div>
    </div>
</form>


<div class="container">
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center" id="studentTable">
            <thead>
                <tr>
                    <th scope="col" style="width: 15%;">Nombres</th>
                    <th scope="col" style="width: 20%;">Dirección</th>
                    <th scope="col" style="width: 15%;">Teléfono</th>
                    <th scope="col" style="width: 15%;">Edad</th>
                    <th scope="col" style="width: 10% ;">Pago</th>
                    <th scope="col" style="width: 10% ;">Dias Retraso</th>
                    <th scope="col" colspan="2" style="width: 25%;">Acciones</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                <!-- Los estudiantes se llenarán con JavaScript -->
            </tbody>
        </table>
    </div>

    <div id="pagination" class="d-flex justify-content-center mt-3">

    </div>
</div>
<div id="studentData" data-students="{{ json_encode($EstudiantesArray) }}"></div>



<script>
    let studentsData = JSON.parse(document.getElementById('studentData').getAttribute('data-students'));
    const studentsPerPage = 5;
    let currentPage = 1;


    function displayStudents(page) {
        currentPage = page;
        const startIndex = (currentPage - 1) * studentsPerPage;
        const selectedStudents = studentsData.slice(startIndex, startIndex + studentsPerPage);

        const tableBody = document.getElementById('studentTableBody');
        tableBody.innerHTML = '';

        const baseUrl = window.location.origin;
        selectedStudents.forEach(student => {
            const row = document.createElement('tr');

            // Calcular la edad a partir de la fecha de nacimiento
            const birthDate = new Date(student.fecha_nacimiento);
            const age = calculateAge(birthDate); // Función para calcular la edad

            // Calcular los días de retraso
            const fechaPago = new Date(student.fecha_pago_mensual); // Asegúrate de que la fecha de pago esté en un formato correcto
            const today = new Date();
            const diasRetraso = Math.floor((today - fechaPago) / (1000 * 60 * 60 * 24)); // Convertir la diferencia a días

            // Cambiar estado de pago si los días de retraso son mayores a 30
            if (diasRetraso > 30) {
                student.estado_pago = 'Pendiente'; // Cambiar el estado a Retrasado si son más de 30 días
            }

            if (student.estado_pago === 'Pendiente') {
                buttonClass = 'btn btn-danger  btn-sm';
                buttonText = 'Pendiente';
                disabled = 'active';

            } else if (student.estado_pago === 'Pagado') {
                buttonClass = 'btn btn-success  btn-sm';
                buttonText = 'Pagado';
                disabled = 'disabled';
            }

            // Creamos la fila de la tabla
            row.innerHTML = `
            <td class="text-center">${student.nombre}</td>
            <td class="text-center">${student.direccion}</td>
            <td class="text-center">${student.telefono}</td>
            <td class="text-center">${age}</td>
            <td>
                <form action="${baseUrl}/Escuela/InscripcionesYpagos/${student.id}/Pagos" method="GET" >
                <button type="submit" class="${buttonClass}" ${disabled}>${buttonText}</button>
                </form>
            </td>
            <td class="text-center">${diasRetraso > 30 ? `${diasRetraso-30} días` : '-'}</td>
            <td>
                <form action="${baseUrl}/Escuela/InscripcionesYpagos/${student.id} eliminar" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
            <td>
                <a href="${baseUrl}/Escuela/InscripcionesYpagos/${student.id}/InscripcionesEditar" class="btn btn-primary">Editar</a>
            </td>
           
        `;

            tableBody.appendChild(row);
        });

        generatePagination();
    }

    // Función para calcular la edad a partir de la fecha de nacimiento
    function calculateAge(birthDate) {
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const month = today.getMonth();
        const day = today.getDate();

        // Ajustar la edad si no se ha cumplido años este año
        if (month < birthDate.getMonth() || (month === birthDate.getMonth() && day < birthDate.getDate())) {
            age--;
        }
        return age;
    }


    function generatePagination() {
        const totalPages = Math.ceil(studentsData.length / studentsPerPage);
        const paginationContainer = document.getElementById('pagination');
        paginationContainer.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement('button');
            button.classList.add('btn', 'btn-outline-primary', 'mx-1');
            button.innerText = i;
            button.onclick = () => displayStudents(i);

            if (i === currentPage) {
                button.classList.add('active');
            }

            paginationContainer.appendChild(button);
        }
    }

    displayStudents(currentPage);

    // Función para esconder el mensaje después de 5 segundos
    setTimeout(function() {
        // Ocultar el mensaje de éxito con animación
        var successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.classList.add('fade');
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 1000); // Esperar 1 segundo para que termine la animación
        }

        // Ocultar el mensaje de error con animación
        var errorMessage = document.getElementById('errorMessage');
        if (errorMessage) {
            errorMessage.classList.add('fade');
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 1000); // Esperar 1 segundo para que termine la animación
        }
    }, 3000); // Tiempo en milisegundos (5000 ms = 5 segundos)
</script>
<script>
    function submitForm() {
        var cedulaValue = document.getElementById('nombre').value;
        var formAction = "{{ url('Escuela/InscripcionesYpagos') }}" + "/" + cedulaValue + " buscar";
        document.getElementById('myForm').action = formAction;
        document.getElementById('myForm').submit();
    }
</script>
@endsection