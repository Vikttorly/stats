<?php

$conexion = new mysqli('localhost','abordnet_miguel','venezuela.1','abordnet_bd');

	if ($conexion->connect_errno) {

		echo 'Falló la conexión' . $conexion->connect_errno;

	}

	$conexion->set_charset("utf8");

?>