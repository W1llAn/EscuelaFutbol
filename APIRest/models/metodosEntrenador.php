<?php

include_once "conexion.php";

class metodosEntrenador
{

    public static function obtenerEntrenadores()
    {
        $con = Conexion::conectar();
        $sql = "SELECT * FROM entrenadores";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($data));
    }

    public static function crearEntrenador()
    {
        $con = Conexion::conectar();

        // Intentar decodificar JSON
        $data = json_decode(file_get_contents('php://input'), true);

        // Verificar si se recibió el dato 'nombre'
        if (empty($data['nombre'])) {
            print_r(json_encode(["success" => false, "message" => "El campo nombre es obligatorio."]));
            return;
        }

        $nombre = $data['nombre'];

        // Consulta SQL segura
        $sql = "INSERT INTO entrenadores (nombre) VALUES (:nombre)";
        $resultado = $con->prepare($sql);
        $resultado->bindParam(':nombre', $nombre, PDO::PARAM_STR);

        if ($resultado->execute()) {
            print_r(json_encode(["success" => true]));
        } else {
            print_r(json_encode(["success" => false, "message" => "Error al insertar el entrenador."]));
        }
    }

    public static function editarEntrenador()
    {
        $con = Conexion::conectar();
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data || !isset($data["id"], $data["nombre"])) {
            http_response_code(400);
            print_r(json_encode([
                "success" => false,
                "message" => "Faltan datos"
            ]));
            return;
        }
        $id = $data["id"];
        $nombre = $data["nombre"];
        $sql = "UPDATE entrenadores SET nombre = '$nombre' WHERE id = $id";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        print_r(json_encode(["success" => true]));
    }

    public static function eliminarEntrenador()
    {
        $con = Conexion::conectar();
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data || !isset($data["id"])) {
            http_response_code(400);
            print_r(json_encode([
                "success" => false,
                "message" => "Faltan datos"
            ]));
            return;
        }
        $id = $data["id"];
        $sql = "DELETE FROM entrenadores WHERE id = $id";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        print_r(json_encode(["success" => true]));
    }
}
