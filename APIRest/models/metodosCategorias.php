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
        $data = json_decode(file_get_contents("php://input"), true);
        $nombre = $data["nombre"];
        $diaEntrenamiento = implode(',', $data["dia_entrenamiento"]);
        $horaInicio = $data["hora_inicio"];
        $horaFin = $data["hora_fin"];
        $idCancha = $data["id_cancha"];
        $idEntrenador = $data["id_entrenador"];

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

        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || !isset($data["id"], $data["nombre"], $data["dia_entrenamiento"], $data["hora_inicio"], $data["hora_fin"])) {
            http_response_code(400);
            print_r(json_encode([
                "success" => false,
                "message" => "Datos inválidos o incompletos enviados"
            ]));
            return;
        }

        // Obtener los datos
        $id = $data["id"];
        $nombre = $data["nombre"];
        $diaEntrenamiento = implode(',', $data["dia_entrenamiento"]);
        $horaInicio = $data["hora_inicio"];
        $horaFin = $data["hora_fin"];

        try {
            // Actualizar en la base de datos
            $sql = "UPDATE categorias SET 
                        nombre = :nombre,
                        dia_entrenamiento = :dia_entrenamiento,
                        hora_inicio = :hora_inicio,
                        hora_fin = :hora_fin
                    WHERE id = :id";

            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':dia_entrenamiento', $diaEntrenamiento, PDO::PARAM_STR);
            $stmt->bindParam(':hora_inicio', $horaInicio, PDO::PARAM_STR);
            $stmt->bindParam(':hora_fin', $horaFin, PDO::PARAM_STR);

            $stmt->execute();

            // Respuesta de éxito
            print_r(json_encode([
                "success" => true,
                "message" => "Categoría actualizada correctamente"
            ]));
        } catch (PDOException $e) {
            // Manejo de errores
            http_response_code(500);
            print_r(json_encode([
                "success" => false,
                "message" => "Error al actualizar la categoría",
                "error" => $e->getMessage()
            ]));
        }
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

    //Obtener jugador por categorias
    public static function obtenerJugadoresPorCategoria()
    {
        $con = Conexion::conectar();
        $sql = "SELECT cj.id AS id ,cat.nombre AS categoria, jug.nombre AS jugador
                FROM categorias_jugadores AS cj
                JOIN categorias AS cat ON cj.id_categoria = cat.id
                JOIN jugadores AS jug ON cj.id_jugador = jug.id;";

        $resultado = $con->prepare($sql);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

        print_r(json_encode($data));
    }

    //Obtener jugador sin categoria
    public static function obtenerJugadoresSinCategoria()
    {
        $con = Conexion::conectar();

        $sql = "SELECT jug.id, jug.nombre, jug.direccion, jug.telefono
                FROM jugadores AS jug
                LEFT JOIN categorias_jugadores AS cj ON jug.id = cj.id_jugador
                WHERE cj.id_categoria IS NULL";

        $resultado = $con->prepare($sql);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

        print_r(json_encode($data));
    }

    //Asignar jugador a categoria
    public static function insertarJugadorACategoria()
    {
        $idCategoria = $_POST['categoria'] ?? null;
        $idJugador = $_POST['jugador'] ?? null;

        if (!$idCategoria || !$idJugador) {
            echo json_encode(["mensaje" => "Faltan parámetros (idCategoria o idJugador)."]);
            return;
        }

        $con = Conexion::conectar();

        // Comprobar si el jugador ya está asignado a la categoría
        $sqlCheck = "SELECT 1 FROM categorias_jugadores WHERE id_categoria = :categoria AND id_jugador = :jugador";
        $check = $con->prepare($sqlCheck);
        $check->execute([':categoria' => $idCategoria, ':jugador' => $idJugador]);

        if ($check->fetch()) {
            echo json_encode(["mensaje" => "El jugador ya está asignado a esta categoría."]);
            return;
        }

        // Insertar el jugador en la categoría
        $sql = "INSERT INTO categorias_jugadores (id_categoria, id_jugador) VALUES (:categoria, :jugador)";
        $stmt = $con->prepare($sql);
        $success = $stmt->execute([':categoria' => $idCategoria, ':jugador' => $idJugador]);

        echo json_encode(["mensaje" => $success ? "Jugador asignado correctamente a la categoría." : "Error al asignar el jugador a la categoría."]);
    }
}
