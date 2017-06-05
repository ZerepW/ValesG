<?php 
function conectar(){
	//CONECTAR A LA BASE DE DATOS
	//DATOS DE LA BASE
	$servername = "localhost";
	$username = "luis";
	$password = "1234";
	$dbname = "vales";

	// CREAR CONEXION
	$con=mysql_connect($servername,$username,$password) or die(mysql_error());
	//SELECCIONAR BASE DE DATOS
	mysql_select_db($dbname,$con) or die(mysql_error());
	//COTEJAMIENTO
	mysql_query ("SET NAMES 'utf8'");
}
?>