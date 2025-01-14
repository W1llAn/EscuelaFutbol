<?php
include_once "../models/metodosHorarios.php";
include_once "../models/Inscripcion.php";

#OBTIENE EL MÉTODO 
$opc = $_SERVER['REQUEST_METHOD'];

#OBTIENE UNA VARIABLE PARA RECONOCER EL CRUD DE QUE ES
$action = $_GET["action"];
switch ($opc) {
        #OBTENER
    case 'GET':
        switch ($action) {
            case 'horario':
                metodosHorarios::obtenerHorario();
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
            default:
                # code...
                break;
        }
        break;
        #CREAR
    case 'POST':
        switch ($action) {
            case '':
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
