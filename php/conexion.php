<?php
 #Archivo de configuracion de la base de datos
define("PG_DB"  , "t2sw");
define("PG_HOST", "localhost");
define("PG_USER", "postgres");
define("PG_PSWD", "p");
define("PG_PORT", "5432");
	
	$dbcon = pg_connect("dbname=".PG_DB." host=".PG_HOST." user=".PG_USER ." password=".PG_PSWD." port=".PG_PORT."");
	// Verificar la conexión
	if (!$dbcon) {
		echo "Error al conectar a la base de datos.";
		exit;}
	$sql="SELECT * FROM puntos";
	$result=pg_query($dbcon,$sql);
?>