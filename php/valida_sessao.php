<?php

	session_start();

	$retorno["status"] = "n";
	$retorno["funcao"] = "valida-sessao";
	$retorno["mensagem"] = "faça autenticação";
	

	if(isset($_SESSION['id']) == false)
	{

		$retorno["status"] = "n";
		$retorno["funcao"] = "valida-sessao";
		$retorno["mensagem"] = "não existe sessao";
	}
	else
	{
		$segundos = time() - $_SESSION["inicio"];

		if($segundos > $_SESSION["tempolimite"])
		{
			unset($_SESSION["usuario"]);
			unset($_SESSION["inicio"]);
			unset($_SESSION["tempolimite"]);
			unset($_SESSION["id"]);
			session_destroy();

			$retorno["status"] = "n";
			$retorno["mensagem"] = "acabou o tempo";
		}
		else
		{

			$_SESSION["inicio"] = time();
			$retorno["status"] = "s";
			$retorno["mensagem"] = "sessao renovada";
			$retorno["funcao"] = "valida-sessao";

			print_r($_SESSION);
		}
	}

	echo "Voce entrou";
	echo json_encode($retorno);

?>