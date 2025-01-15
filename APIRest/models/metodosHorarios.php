<?php
include_once "conexion.php";
class metodosHorarios
{

    public static function obtenerHorario()
    {
        $con = Conexion::conectar();
        $sql = "SELECT cat.id as id,cat.nombre, cat.dia_entrenamiento, cat.hora_inicio, cat.hora_fin, ent.nombre as entrenador , can.nombre as cancha
                FROM categorias as cat
                JOIN entrenadores as ent
                ON cat.id_entrenador = ent.id
                JOIN canchas as can
                ON cat.id_cancha = can.id  WHERE dia_entrenamiento != '';";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($data));
    }

    public static function obtenerEntrenadores()
    {
        $con = Conexion::conectar();
        $sql = "SELECT * FROM entrenadores;";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($data));
    }
    public static function obtenerCanchas()
    {
        $con = Conexion::conectar();
        $sql = "SELECT * FROM canchas;";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($data));
    }

    public static function editarHorario()
    {
        $con = Conexion::conectar();
        parse_str(file_get_contents("php://input"), $_PUT);
        $id = $_PUT["idCat"];
        $diaEntrenamiento = $_PUT["diaEntrenamiento"];
        $horaInicio = $_PUT["horaInicio"];
        $horaFin = $_PUT["horaFin"];
        $idCancha = $_PUT["idCancha"];
        $idEntreandor = $_PUT["idEntrenador"];
        $sql = "UPDATE categorias SET 
                dia_entrenamiento ='$diaEntrenamiento',
                hora_inicio='$horaInicio',
                hora_fin='$horaFin',
                id_cancha='$idCancha',
                id_entrenador = $idEntreandor
                WHERE id= '$id';";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($data));
    }
    public static function eliminarHorario()
    {
        $con = Conexion::conectar();
        $id = $_GET['id'];
        $sql = "UPDATE categorias SET
                dia_entrenamiento=null,
                hora_inicio=null,
                hora_fin=null
                WHERE id='$id'";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($data));
    }
}
