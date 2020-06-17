<div><input class="btn btn-primary" type="button" onClick="location.href='index.php?case=302'" value = "Powrót"></div>

<?php

	include("funkcje.php");
	include "nagl.php";
	require_once "connect.php";

	
	$table = "ListaLekow";
	
	$polaczenie = new mysqli($host, $db_user,$db_password, $db_name);
	$polaczenie->query("SET CHARSET utf8");
	$polaczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
	if($polaczenie->connect_errno!=0){
		throw new Exception(mysqli_connect_errno());
	}
	
	$value=$_GET['search'];
	$sposob=$_GET['sposob'];
	
	find($table, $polaczenie, $value, $sposob);
	$polaczenie->close();
	
?>


