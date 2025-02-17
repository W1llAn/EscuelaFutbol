<?php
include_once "../models/metodosHorarios.php";
include_once "../models/metodosCategorias.php";
include_once "../models/metodosEntrenador.php";
include_once "../models/metodosDashboard.php";
include_once "../models/Inscripcion.php";

#OBTIENE EL MÉTODO 
$opc = $_SERVER['REQUEST_METHOD'];

#OBTIENE UNA VARIABLE PARA RECONOCER EL CRUD DE QUE ES
$action = $_GET["action"];
header('Content-Type: application/json');
switch ($opc) {
        #OBTENER
    case 'GET':
        switch ($action) {
            case 'horario':
                metodosHorarios::obtenerHorario();
                break;
                // DASHBOARD
            case 'obtenerPrimerGrafico':
                $resultado = metodosDashboard::obtenerPrimerGrafico();
                echo json_encode($resultado);
                break;
            case 'obtenerSegundoGrafico':
                $resultado = metodosDashboard::obtenerSegundoGrafico();
                echo json_encode($resultado);
                break;
            case 'obtenerTercerGrafico':
                $resultado = metodosDashboard::obtenerTercerGrafico();
                echo json_encode($resultado);
                break;
            case 'obtenerCuartoGrafico':
                $resultado = metodosDashboard::obtenerCuartoGrafico();
                echo json_encode($resultado);
                break;
            case 'obtener':
                Inscripcion::obtener();
                break;
                case 'obtenerId':
                    Inscripcion::obtenerId();
                    break;
            case 'obtenerNombre':
                Inscripcion::obtenerNombre();
                break;
            case 'entrenadores':
                metodosHorarios::obtenerEntrenadores();
                break;
            case 'canchas':
                metodosHorarios::obtenerCanchas();
                break;
            case 'categorias':
                metodosCategorias::obtenerCategorias();
                break;
            case 'jugadores':
                metodosCategorias::obtenerJugadoresPorCategoria();
                break;
            case 'jugadoresDisponibles':
                metodosCategorias::obtenerJugadoresSinCategoria();
                break;
            case 'entrenador':
                metodosEntrenador::obtenerEntrenadores();
                break;
            default:
                # code...
                break;
        }
        break;
        #CREAR
    case 'POST':
        switch ($action) {
            case 'categorias':
                metodosCategorias::crearCategoria();
                break;
            case 'jugadores':
                metodosCategorias::insertarJugadorACategoria();
                break;
            case 'entrenador':
                metodosEntrenador::crearEntrenador();
                break;
            case 'inscripcion':
                Inscripcion::guardar();
                break;

            default:
                # code...
                break;
        }
        break;
        #EDITAR
    case 'PUT':
        switch ($action) {
            case 'horario':
                metodosHorarios::editarHorario();
                break;
            case 'categorias':
                metodosCategorias::editarCategoria();
                break;
            case 'entrenador':
                metodosEntrenador::editarEntrenador();
                break;
            case 'editarEstudiante':
                Inscripcion::editar();
                break;
                case 'editarEstudiantePago':
                    Inscripcion::editarEstudiantePago();
                    break;
            default:
                # code...
                break;
        }
        break;
        #ELIMINAR
    case 'DELETE':
        switch ($action) {
            case 'horario':
                metodosHorarios::eliminarHorario();
                break;
            case 'categorias':
                metodosCategorias::eliminarCategoria();
                break;
            case 'entrenador':
                metodosEntrenador::eliminarEntrenador();
            case 'eliminarInscripcionId':
                Inscripcion::borrar();
                break;
            default:
                # code...
                break;
        }
        break;
    default:
        # code...
        break;
}
