<?php 
	include 'Conexion.php';
	conectar();
	function getCodigo(){
		$codigo = "";
		$caracteres="A2BC3DE4FH5KM8NP9RUVWXY";
		$maximo = strlen($caracteres);
		for ($i=1; $i<=8; $i++){
			$generar_codigo = mt_rand(1, $maximo);
			$codigo.=$caracteres[$generar_codigo-1];
		}
		return $codigo;
	}
	
	function AgregarVale($codigoCorrecto){
			$queryValeCodigo =mysql_query("SELECT folioVale FROM vale WHERE folioVale='".$codigoCorrecto."'");
			$numrows=mysql_num_rows($queryValeCodigo);
			if($numrows==0){
				mysql_query("INSERT INTO vale(folioVale, mes, yearV, emisor) VALUES('".$codigoCorrecto."','".date('m')."','".date('Y')."','Luis Arturo Pérez Díaz') ") or die(mysql_error());
			}else{
				$codigo = getCodigo();
				AgregarVale($codigo);
			}		
	}
	if(isset($_POST["generar"])){
		$codigo = getCodigo();
		AgregarVale($codigo);
		header("Location: vales.php");
	}
	//ELIMINAR VALE
	if(isset($_POST["eliminarVale"])){
		if(isset($_POST["idVale"])){
			$idVale = $_POST["idVale"];
			$queryUsuario2 =mysql_query("DELETE FROM vale WHERE idVale = '".$idVale."'") or die(mysql_error());
		}
	}
	//VALOR TOTAL DE LOS VALES
		$queryValorTotal =mysql_query("SELECT SUM(cantidad) AS 'cantidadt' FROM vale");
		$numrows4=mysql_num_rows($queryValorTotal);
		if($numrows4==1){
			while ( $row4=mysql_fetch_assoc($queryValorTotal)) {
				$valorTotal = $row4["cantidadt"];
			}
		}

?>
<html>
	<head>
		<title>Vales de Gasolina</title>
		<style>
			table{
				margin:10px;
			}
			td,th{
				padding:10px 50px 0px 0px;
			}
			th{
				text-align:left;
			}
		</style>
	</head>
	<body>
		<h1>Vales de Gasolina</h1>
		<b>Opciones</b><br><br>
		<form method="POST" action="">
			<input type="hidden" name="generar" value="generar">
			<button>Generar Vales</button>
		</form>
		
			<button>Generar PDF</button>
			<button>Generar Excel</button><br><br>
			
			Valor TOTAL: $<?php echo $valorTotal;?>.00<br>
		<table>
			<thead>
				<tr>
					<th data-field="year">Año</th>
					<th data-field="mes">Mes</th>
					<th data-field="name">Folio</th>
					<th data-field="permiso">Emisor</th>
					<th data-field="permiso">Receptor</th>
					<th data-field="permiso">Cantidad</th>
					<th data-field="opcionE"></th>
					<th data-field="opcionC"></th>
				</tr>
			</thead>
			<tbody>
				<?php // SELECCIONAR USUARIOS
				$sql ="SELECT * FROM vale";
				$vales=mysql_query ($sql) or die(mysql_error());
				$numVale = -1;
				while ( $row=mysql_fetch_assoc($vales)) {
					$numVale++;
					$idVale = $row["idVale"];
					$folioVale = $row["folioVale"];
					$mes = $row["mes"];
					$yearV =$row["yearV"];
					$emisor =$row["emisor"];
					$receptor =$row["receptor"];
					$cantidad =$row["cantidad"];
				?>
				<form id="EliminarUsuario" style="display:block;" method="POST" action="">
					<input type="hidden" name="idVale" value="<?php echo $idVale;?>">
					<tr>
						<td><?php echo $yearV;?></td>
						<td><?php echo $mes;?></td>
						<td><?php echo $folioVale;?></td>
						<td><?php echo $emisor;?></td>
						<td><?php echo $receptor;?></td>
						<td>$<?php echo $cantidad;?>.00</td>
						<td style="vertical-align:text-bottom;" ><a style="cursor:pointer;" onclick="eliminarVale(<?php echo $numVale;?>)">Eliminar</a><button style="display:none;"  type="submit" name="eliminarVale" class="btn  red darken-4 right eliminarBoton"><span class="fa fa-times"></span></button></td>
						<td style="vertical-align:text-bottom;" ><a style="cursor:pointer;" href="perfilVale?id=<?php echo $idVale;?>">Editar</a></td>
					</tr>
				</form>
				<?php } ?>
			</tbody>
		</table>
		<br><br>
		SMProduciones<br>
		Zerep, 2017. Version 1.0
		<script>
		function eliminarVale(x){
			var botonEliminar = document.getElementsByClassName("eliminarBoton");
			botonEliminar[x].click();	
		}
		</script>
	</body>
</html>