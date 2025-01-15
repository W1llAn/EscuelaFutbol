<?php
include_once "../models/metodosHorarios.php";
include_once "../models/metodosDashboard.php";

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
