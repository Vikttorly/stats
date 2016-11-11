<?php

$conexion = new mysqli('localhost','root','','abordnet_bd');

	if ($conexion->connect_errno) {

		echo 'Falló la conexión' . $conexion->connect_errno;

	}

	$conexion->set_charset("utf8");

?>