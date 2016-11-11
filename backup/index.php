<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="fusioncharts/fusioncharts.js"></script>
	<script type="text/javascript" src="fusioncharts/themes/fusioncharts.theme.fint.js"></script>
</head>

<body>

<form method="post" action="index.php">
	<select name="tipoChart">

		<?php

			if ($tipoChart == 'column2d') {
				echo '<option value="column2d" selected>COLUMNA 2D</option>';
			}else{
				echo '<option value="column2d">COLUMNA 2D</option>';
			}

			if ($tipoChart == 'bar2d') {
				echo '<option value="bar2d" selected>BARRA 2D</option>';
			}else{
				echo '<option value="bar2d">BARRA 2D</option>';
			}

			if ($tipoChart == 'pie2d') {
				echo '<option value="pie2d" selected>TORTA 2D</option>';
			}else{
				echo '<option value="pie2d">TORTA 2D</option>';
			}

		?>
		
	</select>

	<select name="operador">
<?php

include('modulos/conexion.php');

if (isset($_POST['enviar'])) {
	$tipoChart = $_POST['tipoChart'];

}else{

	$tipoChart = 'column2d';

}


$sql = "SELECT * FROM usuario WHERE 
(nombre!='RESERVACIONES' AND nombre!='ADMINISTRACION' AND nombre!='GERENCIA'
AND nombre!='USUARIO A' AND nombre!='USUARIO B' AND nombre!='USUARIO C'
AND nombre!='SUPERVISOR' AND nombre!='RODOLFO')";

$resultado=$conexion->query($sql);

while ($res=$resultado->fetch_assoc()) {
	$operador = $res['nombre'];
	echo '<option>'.$operador.'</option>';
}


?>
	</select>
	<input type="submit" name="enviar" value="Mostrar">
</form>

<script type="text/javascript">
	FusionCharts.ready(function(){
      var revenueChart = new FusionCharts({
        "type": "<?php echo $tipoChart; ?>",
        "renderAt": "chartglobal",
        "width": "600",
        "height": "300",
        "dataFormat": "json",
        "dataSource": {
    "chart": {
        "caption": "Llamadas atendidas por operadores",
        "subcaption": "Abordate.net",
        "numberprefix": "",
        "startingangle": "310",
        "decimals": "0",
        "defaultcenterlabel": "",
        "centerlabel": "Atendidas: $value",
        "theme": "fint"
    },
    "data": [

<?php

$sql = "SELECT * FROM usuario WHERE 
(nombre!='RESERVACIONES' AND nombre!='ADMINISTRACION' AND nombre!='GERENCIA'
AND nombre!='USUARIO A' AND nombre!='USUARIO B' AND nombre!='USUARIO C'
AND nombre!='SUPERVISOR' AND nombre!='RODOLFO')";

	$var = 1;
	$resultado=$conexion->query($sql);
	$tope = $resultado->num_rows;

		while ($fila=$resultado->fetch_assoc()) {

			$usuario = $fila['nombre'];

			$con = $conexion->query("SELECT * FROM datos_personales WHERE id_operador='$usuario'");
			$llamadas = $con->num_rows;

			if ($var == $tope) {
				echo '{
            			"label": "'.$usuario.'",
           		 		"value": "'.$llamadas.'"
        			}';
			}else{
				echo '{
            			"label": "'.$usuario.'",
           		 		"value": "'.$llamadas.'"
        			},';
			}

			$var++;
		}
?>

   ]
}


    });

    revenueChart.render();
})


</script>


<br><br><div id="chartglobal" align="center"></div>




<div id="estadistica"></div>

<script>
	$(document).ready(function(){
		$("select[name=usuario]").change(function(){
				var usuario = $('select[name=usuario]').val();
            	var url = "modulos/proceso.php"; 
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {usuario}, 
                    success: function(data)
                    {
                        $("#estadistica").html(data); 
                    }
                    });
        	});
	});
</script>

</body>
</html>