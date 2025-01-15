<?php
include_once "conexion.php";
class metodosDashboard
{

    public static function obtenerPrimerGrafico()
    {
        $con = Conexion::conectar();

        // Inicializar un array para almacenar los resultados
        $resultados = [];

        // Consulta SQL para obtener el total de jugadores
        $consultaJugadores = "SELECT COUNT(*) as total_jugadores FROM jugadores";
        $resultadoJugadores = $con->query($consultaJugadores);
        $jugadores = $resultadoJugadores->fetch(PDO::FETCH_ASSOC);
        $resultados['total_jugadores'] = $jugadores['total_jugadores'];

        // Consulta SQL para obtener el total de entrenadores
        $consultaEntrenadores = "SELECT COUNT(*) as total_entrenadores FROM entrenadores";
        $resultadoEntrenadores = $con->query($consultaEntrenadores);
        $entrenadores = $resultadoEntrenadores->fetch(PDO::FETCH_ASSOC);
        $resultados['total_entrenadores'] = $entrenadores['total_entrenadores'];

        // Consulta SQL para obtener el total de canchas
        $consultaCanchas = "SELECT COUNT(*) as total_canchas FROM canchas";
        $resultadoCanchas = $con->query($consultaCanchas);
        $canchas = $resultadoCanchas->fetch(PDO::FETCH_ASSOC);
        $resultados['total_canchas'] = $canchas['total_canchas'];

        // Retornar los resultados en formato array
        return $resultados;
    }
    public static function obtenerSegundoGrafico()
    {
        $con = Conexion::conectar();

        // Consulta para obtener el número de jugadores por categoría
        $sql = "
        SELECT c.nombre AS categoria, COUNT(cj.id_jugador) AS total_jugadores
        FROM categorias c
        LEFT JOIN categorias_jugadores cj ON c.id = cj.id_categoria
        GROUP BY c.nombre
    ";

        $resultado = $con->query($sql);

        $datos = [];

        // Verificar si la consulta tiene resultados
        if ($resultado) {
            // Iterar a través de los resultados y almacenar en el array
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $datos[] = [
                    'categoria' => $row['categoria'],
                    'total_jugadores' => $row['total_jugadores']
                ];
            }
        }

        return $datos;
    }
    public static function obtenerTercerGrafico()
    {
        $con = Conexion::conectar(); // Obtén la conexión a la base de datos

        try {
            $sql = "
            SELECT 
                DATE_FORMAT(fecha_pago_mensual, '%Y-%m') AS mes, -- Extrae el mes y año del pago
                SUM(pago_mensual) AS total_pago                 -- Suma los pagos del mes
            FROM jugadores
            WHERE estado_pago = 'Pagado'                      -- Considera solo pagos realizados
            GROUP BY DATE_FORMAT(fecha_pago_mensual, '%Y-%m') -- Agrupa por mes
            ORDER BY mes ASC;                                 -- Ordena por fecha ascendente
        ";

            $stmt = $con->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultados; // Devuelve los resultados como un arreglo asociativo
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }
    public static function obtenerCuartoGrafico()
    {
        $con = Conexion::conectar(); // Obtén la conexión a la base de datos
        try {
            $sql = "
            SELECT 
            estado_pago,                -- Tipo de estado de pago
            COUNT(*) AS total_jugadores -- Cuenta el número de jugadores por estado de pago
            FROM jugadores
            GROUP BY estado_pago           -- Agrupa por estado de pago
            ORDER BY total_jugadores DESC; -- Ordena por el total de jugadores en orden descendente
        ";

            $stmt = $con->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultados; // Devuelve los resultados como un arreglo asociativo
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
        
    }
}
