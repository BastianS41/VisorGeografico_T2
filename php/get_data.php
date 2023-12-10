<?php
define("PG_DB"  , "t2sw");
define("PG_HOST", "localhost");
define("PG_USER", "postgres");
define("PG_PSWD", "p");
define("PG_PORT", "5432");

// Conexión a la base de datos
$dbcon = pg_connect("dbname=".PG_DB." host=".PG_HOST." user=".PG_USER." password=".PG_PSWD." port=".PG_PORT);

// Verificar la conexión
if (!$dbcon) {
    echo "Error al conectar a la base de datos.";
    exit;
}

// Consulta SQL para obtener los puntos
$query = "SELECT id, tipo, nombre, ST_X(geom) as lng, ST_Y(geom) as lat FROM puntos";
$result = pg_query($dbcon, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    echo "Error al obtener los puntos.";
    exit;
}

// Array para almacenar los datos
$data = array();

while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}

// Devuelve los datos como JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
