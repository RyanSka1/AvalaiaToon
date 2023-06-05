<?php

session_start();
require "config.php";

	//$usuario = $_POST["usuario"] ?? "";
	$codigo = $_POST["codigo"] ?? "";

    $query = "SELECT codigo FROM usuario WHERE codigo = '$codigo'";

	$resultado = mysqli_query($conexao, $query);

	$registro = mysqli_fetch_assoc($resultado);

	if($_SESSION["codigo"] = $registro["codigo"]){
		$retorno["status"] = "1";
	} else {
		echo "Ocorreu um erro";
	}

	echo json_encode($retorno);

?>