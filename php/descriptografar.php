<?php

	$dados = $_POST["dados"];

	// quebra a string a partir do 32 caracter
	$mensagem_criptografada_base64 = substr($dados, 32);

	echo "Mensagem criptografada base 64: ".$mensagem_criptografada_base64."\n";

	$mensagem_criptografada = base64_decode($mensagem_criptografada_base64);

	echo "Mensagem criptografada: ".$mensagem_criptografada."\n";

	$chave = "1234567887654321"; 

	// quebra a string até o 32 caracter
	$iv = substr($dados, 0, 32);

	echo "Vetor de inicialização: ".$iv."\n";

	// descriptografa a mensagem
	$mensagem_descriptografada = openssl_decrypt($mensagem_criptografada, 'aes-128-cbc', $chave, OPENSSL_ZERO_PADDING, $iv);

	print_r(json_decode(base64_decode($mensagem_descriptografada), true));

?>