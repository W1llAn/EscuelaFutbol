<?php
include_once "conexion.php";
class Inscripcion
{

    public static function guardar()
    {
        $con = Conexion::conectar();
        $nombres = $_POST['nombres'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $fechaNaci = $_POST['fechaNaci'];

        $sql = "INSERT INTO jugadores (id,nombre, direccion, telefono, fecha_inscripcion, fecha_pago_mensual, fecha_nacimiento, pago_mensual, estado_pago)
        VALUES (null,'$nombres', '  $direccion', ' $telefono', CURRENT_DATE,  CURRENT_DATE, ' $fechaNaci', 00.00, 'Pagado')";
        $resultado = $con->prepare($sql);
        $resultado->execute();
    }

    public static function obtener()
    {
        $con = Conexion::conectar();
        $sql = "SELECT * FROM jugadores";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($data));
    }
    public static function editar()
    {
        parse_str(file_get_contents("php://input"), $_PUT);
        $con = Conexion::conectar();
        $id = $_PUT['id'];
        $nombres = $_PUT['nombres'];
        $direccion = $_PUT['direccion'];
        $telefono = $_PUT['telefono'];
        $fechaNaci = $_PUT['fechaNaci'];

        $sql = "UPDATE  jugadores SET nombre='$nombres',direccion='$direccion',telefono='$telefono',fecha_nacimiento='$fechaNaci'   WHERE id='$id'";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        $data = json_encode("Se edito correctamente");
        print_r($data);
    }
    public static function obtenerId()
    {
        $id = $_GET['id'];
        $con = Conexion::conectar();
        $sql = "SELECT * FROM jugadores WHERE id = :id";
        $resultado = $con->prepare($sql);
        $resultado->bindParam(':id', $id, PDO::PARAM_INT);  // Vincula el parámetro 'id'
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($data));
    }
    public static function borrar()
    {
        $objetoConexion = new Conexion();
        $conn = $objetoConexion->conectar();

        $id = $_GET['id'];

        try {
            // Primero, obtener el nombre del jugador antes de intentar eliminarlo
            $sql = "SELECT nombre FROM jugadores WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Verificar si el jugador existe
            if ($stmt->rowCount() > 0) {
                $jugador = $stmt->fetch(PDO::FETCH_ASSOC);
                $nombreJugador = $jugador['nombre'];

                // Eliminar los registros relacionados en la tabla categorias_jugadores
                $sql1 = "DELETE FROM `categorias_jugadores` WHERE id_jugador = :id";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt1->execute();

                // Intentar eliminar el jugador
                $sql2 = "DELETE FROM jugadores WHERE id = :id";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt2->execute();

                // Verificar si la eliminación fue exitosa
                if ($stmt2->rowCount() > 0) {
                    echo json_encode(["message" => "Jugador '$nombreJugador' eliminado correctamente"]);
                } else {
                    echo json_encode(["error" => "No se pudo eliminar el jugador '$nombreJugador'. Puede que ya haya sido eliminado o no exista."]);
                }
            } else {
                echo json_encode(["error" => "Jugador no encontrado con el ID '$id'."]);
            }
        } catch (PDOException $e) {
            // Si se detecta una violación de clave foránea (foreign key constraint)
            if ($e->getCode() == 23000) {
                echo json_encode(["error" => "No se pudo eliminar el jugador '$nombreJugador'. Posiblemente tiene registros dependientes."]);
            } else {
                // Si ocurre otro tipo de error
                echo json_encode(["error" => "Error al eliminar el jugador '$nombreJugador': " . $e->getMessage()]);
            }
        }
    }

    public static function obtenerNombre()
    {
        // Obtener el parámetro 'nombre' de la URL
        $nombre = $_GET['nombre'];

        // Establecer la conexión con la base de datos
        $con = Conexion::conectar();

        // Preparar la consulta SQL
        $sql = "SELECT * FROM jugadores WHERE nombre = :nombre";
        $resultado = $con->prepare($sql);

        // Vincular el parámetro 'nombre' con la consulta SQL
        $resultado->bindParam(':nombre', $nombre, PDO::PARAM_STR);

        // Ejecutar la consulta
        $resultado->execute();

        // Obtener los resultados y codificarlos a formato JSON
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
    public static function editarEstudiantePago()
    {
        parse_str(file_get_contents("php://input"), $_PUT);
        $con = Conexion::conectar();
        $id = $_PUT['id'];
        $cantidad = $_PUT['cantidad'];
        $fechaPago = $_PUT['fechaPago'];

        $sql = "UPDATE  jugadores SET pago_mensual='$cantidad',fecha_pago_mensual='$fechaPago',estado_pago='Pagado' WHERE id='$id'";
        $resultado = $con->prepare($sql);
        $resultado->execute();
        $data = json_encode("Se edito los pagos correctamente");
        print_r($data);
    }
}
