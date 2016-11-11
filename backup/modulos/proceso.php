<?php

include('conexion.php');

$usuario = $_POST['usuario'];

$sql = $mysqli->query("SELECT * FROM datos_personales WHERE id_operador='$usuario'");

$row_cnt = $sql->num_rows;

print($row_cnt);

?>