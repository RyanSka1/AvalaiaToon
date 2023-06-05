<?php

session_start();
require "config.php";

$email = $_POST["recuperar"] ?? "";

function geraSenha($fim)
{
  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
  return substr(str_shuffle($data), 0, $fim);
};


  $gerado = geraSenha(10);
  $_SESSION['senhaNova'] = $gerado;

$query = mysqli_query($conexao, "UPDATE usuario SET senha = '". $gerado. "' WHERE email = '".$email."'");
//echo json_encode($retorno);

?>


