<?php
include_once "conexion.php";

class metodosCategorias
{
    // Obtener todas las categorías con información detallada
    public static function obtenerCategorias()
    {
        $con = Conexion::conectar();
        $sql = "SELECT 
                    cat.id as id,
                    cat.nombre,
                    cat.dia_entrenamiento,
                    cat.hora_inicio,
                    cat.hora_fin,
                    ent.nombre as entrenador,
                    can.nombre as cancha
                FROM categorias as cat
                JOIN entrenadores as ent ON cat.id_entrenador = ent.id
                JOIN canchas as can ON cat.id_cancha = can.id;";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($data));
    }

    // Crear una nueva categoría
    public static function crearCategoria()
    {
        $con = Conexion::conectar();
        $nombre = $_POST["nombre"];
        $diaEntrenamiento = $_POST["dia_entrenamiento"];
        $horaInicio = $_POST["hora_inicio"];
        $horaFin = $_POST["hora_fin"];
        $idCancha = $_POST["id_cancha"];
        $idEntrenador = $_POST["id_entrenador"];

        $sql = "INSERT INTO categorias 
                (nombre, dia_entrenamiento, hora_inicio, hora_fin, id_cancha, id_entrenador) 
                VALUES 
                ('$nombre', '$diaEntrenamiento', '$horaInicio', '$horaFin', '$idCancha', '$idEntrenador');";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        print_r(json_encode(["success" => true]));
    }

    // Editar una categoría existente
    public static function editarCategoria()
    {
        $con = Conexion::conectar();
        parse_str(file_get_contents("php://input"), $_PUT);
        $id = $_PUT["id"];
        $nombre = $_PUT["nombre"];
        $diaEntrenamiento = $_PUT["dia_entrenamiento"];
        $horaInicio = $_PUT["hora_inicio"];
        $horaFin = $_PUT["hora_fin"];
        $idCancha = $_PUT["id_cancha"];
        $idEntrenador = $_PUT["id_entrenador"];

        $sql = "UPDATE categorias SET 
                nombre = '$nombre',
                dia_entrenamiento = '$diaEntrenamiento',
                hora_inicio = '$horaInicio',
                hora_fin = '$horaFin',
                id_cancha = '$idCancha',
                id_entrenador = '$idEntrenador'
                WHERE id = '$id';";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        print_r(json_encode(["success" => true]));
    }

    // Eliminar una categoría
    public static function eliminarCategoria()
    {
        $con = Conexion::conectar();
        $id = $_GET["id"];
        $sql = "DELETE FROM categorias WHERE id = '$id';";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        print_r(json_encode(["success" => true]));
    }
}
