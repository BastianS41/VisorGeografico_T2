<?php
// Obtener id
$id = $_POST['id'];

// Crear la conexión a la base de datos
define("PG_DB", "t2sw");
define("PG_HOST", "localhost");
define("PG_USER", "postgres");
define("PG_PSWD", "p");
define("PG_PORT", "5432");

$conn = pg_connect("dbname=" . PG_DB . " host=" . PG_HOST . " user=" . PG_USER . " password=" . PG_PSWD . " port=" . PG_PORT);

// Verificar conexión
if (!$conn) {
    die("Error de conexión a la base de datos.");
}

// Escapar el valor del ID para prevenir inyección de SQL
$id = pg_escape_string($conn, $id);

// Consulta para eliminar dato
$query = "DELETE FROM puntos WHERE id = $id";
$result = pg_query($conn, $query);

// Verificar el resultado de la consulta
if ($result) {
    $affectedRows = pg_affected_rows($result);

    if ($affectedRows > 0) {
        echo "El punto con ID $id ha sido eliminado. Filas afectadas: $affectedRows";
    } else {
        echo "No se encontró un punto con ID $id.";
    }
} else {
    echo "Error al ejecutar la consulta.";
}

// Cerrar la conexión
pg_close($conn);
?>
