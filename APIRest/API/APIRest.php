<?php
include_once "../models/metodosHorarios.php";
include_once "../models/metodosCategorias.php";
include_once "../models/metodosEntrenador.php";

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
