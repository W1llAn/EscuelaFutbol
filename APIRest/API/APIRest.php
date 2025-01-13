<?php
include_once "../models/metodosHorarios.php";

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

            default:
                # code...
                break;
        }
        break;
        #CREAR
    case 'POST':
        switch ($action) {
            case 'horario':
                metodosHorarios::crearHorario();
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

            default:
                # code...
                break;
        }
        break;
    default:
        # code...
        break;
}
