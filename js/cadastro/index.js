$(document).ready(function(){
	$("#bCadastrar").click(function(){

		var u = document.forms["form-cadastro"]["usuario"].value;
		var e = document.forms["form-cadastro"]["email"].value;
		var c = document.forms["form-cadastro"]["cpf"].value;
		var s = document.forms["form-cadastro"]["senha"].value;

		if (u == "" || e == "" || c == "" || s == "") {
	  	alert("Campos não foram preenchidos!");
		}
			if(verificaSenha() != false){
				var sha256 = sjcl.hash.sha256.hash($('#senha').val());
				var sha256_hexa = sjcl.codec.hex.fromBits(sha256);
		
				$("#senha_hash").val(sha256_hexa);

				 //fLocalReqChaveSimetrica();
				// criptografarChaveSimetrica();
				fLocalComunicaServidor('form-cadastro', 'cadastro');
				
				return false;
			}
	});

});

function fLocalComunicaServidor(formulario, arquivo){

	var dados = $("#"+formulario).serialize();

	$.ajax({
		type:"POST",
		dataType: "json",
		url: "/../php/"+arquivo+".php",
		data: dados,
	 	// beforeSend : function(){
		// 	$("#bAcessar").html('Aguarde');
	    // },
		success: function(retorno){
			if(retorno.funcao == "cadastro")
			{
				if(retorno.status == "s")
				{
					alert("Usuário cadastrado!");
					window.location.href = "/../php/envia-email.php";
				} 
				else 
				{
				alert("erro");
				}
			}
		},
		error: function(){
			alert("Ocorreu um erro");
		}
		
	});
}

function verificaSenha() {
	var senha = document.getElementById("senha").value;
	if(senha.length < 8) {
	   alert("Senha muito curta!");
	   return false;
	}
}



function fLocalReqChaveSimetrica(){

	var data = {"usuario": $("#usuario").val(), "senha": CryptoJS.SHA256($("#senha_hash").val()).toString()};

    var data_criptografada = criptografarChaveSimetrica(data);

    $.ajax({
        url: "../php/descriptografar.php", 
        type: 'post', 
        data: {dados: data_criptografada}, 
        dataType: "json"
    });
}

function criptografarChaveSimetrica(data) {


	var iv_random = CryptoJS.enc.Hex.stringify(CryptoJS.lib.WordArray.random(16)).toString();
    var iv = CryptoJS.enc.Utf8.parse(iv_random);
    var valores = JSON.stringify(data);
    valores = CryptoJS.enc.Base64.stringify(CryptoJS.enc.Utf8.parse(valores)).toString();
    var chave = CryptoJS.enc.Utf8.parse('1234567887654321'); 

    var criptografado = CryptoJS.AES.encrypt(valores, chave, {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.ZeroPadding
    });
 
    var criptografado_string = criptografado.toString();
    return iv_random + CryptoJS.enc.Base64.stringify(CryptoJS.enc.Utf8.parse(criptografado_string)).toString();
}






