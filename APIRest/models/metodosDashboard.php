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
}
