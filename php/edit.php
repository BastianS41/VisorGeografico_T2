<?php
define("PG_DB", "t2sw");
define("PG_HOST", "localhost");
define("PG_USER", "postgres");
define("PG_PSWD", "p");
define("PG_PORT", "5432");

// Obtener el ID enviado por AJAX
$id = isset($_POST['id']) ? $_POST['id'] : null;

// Verificar si el ID está presente
if ($id === null) {
    echo json_encode(['error' => 'ID no proporcionado.']);
    exit;
}

// Conectar a la base de datos
$conn = pg_connect("dbname=" . PG_DB . " host=" . PG_HOST . " user=" . PG_USER . " password=" . PG_PSWD . " port=" . PG_PORT . "");

if (!$conn) {
    echo json_encode(['error' => 'Error al conectar a la base de datos.']);
    exit;
}

// Consultar la base de datos para obtener el registro por ID
$query = "SELECT id, tipo, nombre, ST_X(geom) AS lat, ST_Y(geom) AS long FROM puntos WHERE id='$id'";
$result = pg_query($conn, $query);

if (!$result) {
    echo json_encode(['error' => 'Error al obtener el registro por ID.']);
    exit;
}

$record = pg_fetch_assoc($result);

// Verificar si se envió una solicitud de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $tipo = isset($_POST['edittipo']) ? $_POST['edittipo'] : null;
    $nombre = isset($_POST['editnombre']) ? $_POST['editnombre'] : null;
    $lat = isset($_POST['editlat']) ? $_POST['editlat'] : null;
    $long = isset($_POST['editlong']) ? $_POST['editlong'] : null;

    // Actualizar el registro en la base de datos solo si latitud y longitud son valores numéricos
    if (is_numeric($lat) && is_numeric($long)) {
        $updateQuery = "UPDATE puntos SET tipo='$tipo', nombre='$nombre', geom=ST_SetSRID(ST_MakePoint($long, $lat), 4326) WHERE id='$id'";
        $updateResult = pg_query($conn, $updateQuery);

        // Verificar el resultado de la actualización
        if (!$updateResult) {
            echo json_encode(['error' => 'Error al actualizar el registro.']);
            exit;
        }

        echo json_encode(['success' => 'Actualización exitosa.']);
        exit;
    }
}

// Si no es una solicitud POST o si hubo un problema con los datos, solo devolver los datos
echo json_encode($record);

// Cerrar la conexión a la base de datos
pg_close($conn);
?>
