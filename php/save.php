<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados por el formulario
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];
    $nombre = $_POST['nombre'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    // Crear la conexión a la base de datos
    $conn = conectarBaseDatos();

    if (!$conn) {
        echo "Error de conexión a la base de datos.";
        exit;
    }
    // Insertar los datos del punto en la base de datos
    $insertado = insertarPunto($conn, $id, $tipo, $nombre, $latitude, $longitude);

    if ($insertado) {
        echo "El punto $id se agregó a la base de datos.";
    } else {
        echo "Error al agregar el punto a la base de datos.";
    }

    // Cerrar la conexión a la base de datos
    pg_close($conn);
}
// Función para conectar a la base de datos
function conectarBaseDatos()
{
    define("PG_DB", "t2sw");
    define("PG_HOST", "localhost");
    define("PG_USER", "postgres");
    define("PG_PSWD", "p");
    define("PG_PORT", "5432");

    $conn = pg_connect("dbname=" . PG_DB . " host=" . PG_HOST . " user=" . PG_USER . " password=" . PG_PSWD . " port=" . PG_PORT . "");

    return $conn;
}
// Función para insertar un punto en la base de datos
function insertarPunto($conn, $id, $tipo, $nombre, $latitude, $longitude)
{
    // Crear la geometría del punto
    $point = "POINT($longitude $latitude)";
    // Preparar la consulta SQL con parámetros
    $query = "INSERT INTO puntos (id, tipo, nombre, geom) VALUES ($1, $2, $3, ST_GeomFromText($4, 4326))";
    $params = array($id, $tipo, $nombre, $point);
    // Ejecutar la consulta preparada
    $result = pg_query_params($conn, $query, $params);
    // Verificar el resultado de la consulta
    return $result && pg_affected_rows($result) > 0;
}
?>
