<?php
	
	include 'Conexion.php';
	conectar();
	
	
	if(isset($_GET["id"])){
		$idVale = $_GET["id"];
		$sql ="SELECT * FROM vale WHERE idVale = ".$idVale."";
		$vales=mysql_query ($sql) or die(mysql_error());
		while ( $row=mysql_fetch_assoc($vales)) {
			$idVale2 = $row["idVale"];
			$folioVale = $row["folioVale"];
			$mes = $row["mes"];
			$yearV = $row["yearV"];
			$emisor = $row["emisor"];
			$receptor = $row["receptor"];
			$cantidad = $row["cantidad"];
		}
		if(isset($_POST["guardar"])){
			if(isset($_POST["emisorN"]) && isset($_POST["receptorN"])  && isset($_POST["cantidadN"])  && isset($_POST["idVale"])){
				
				$emisor = $_POST["emisorN"];
				$receptor = $_POST["receptorN"];
				$cantidad = $_POST["cantidadN"];
				$sql ="UPDATE vale SET emisor ='".$emisor."',receptor='".$receptor."',cantidad='".$cantidad."' WHERE idVale='".$idVale2."'";;
				$actualizarVale=mysql_query ($sql) or die(mysql_error());
				header("Location: vales.php");
			}
		}
			
	}else{
		header("Location: vales.php");
	}
?>
<html>
	<head>
		<title>Perfil Vale</title>
	</head>
	<body>
		<a href="vales.php">Inicio</a>
		<h1>Vale de Gasolina</h1>
		<button>Generar PDF</button><br><br>
		<form method="POST" action "">
		ID: <?php echo $idVale;?><br>
		Folio: <?php echo $folioVale;?><br>
		Fecha: <?php echo $mes."-".$yearV;?><br>
		<input type="hidden" name="idVale" value="<?php echo $idVale;?>" required>
		Emisor: <input type="text" name="emisorN" value="<?php echo $emisor;?>" required><br>
		Receptor:  <input type="text" name="receptorN" value="<?php echo $receptor;?>" required><br>
		Cantidad:  <input type="text" name="cantidadN" value="<?php echo $cantidad;?>" required><br><br>
		<button name="guardar" value="guardar">Guardar</button>
		</form>
		<br><br>
		SMProduciones<br>
		Zerep, 2017. Version 1.0
	</body>
</html>