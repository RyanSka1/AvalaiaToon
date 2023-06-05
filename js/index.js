$(document).ready(function(){
	$("#bAcessar").click(function(){

			var sha256 = sjcl.hash.sha256.hash($('#senha').val());
			var sha256_hexa = sjcl.codec.hex.fromBits(sha256);
	
			$("#senha_hash").val(sha256_hexa);
	
			//Simetrico(data);
			fLocalComunicaServidor('form-login', 'login');
			return false;
	});
});

function fLocalComunicaServidor(formulario, arquivo){

	var dados = $("#"+formulario).serialize();

	$.ajax({
		type:"POST",
		dataType: "json",
		url: "../php/"+arquivo+".php",
		data: dados,
		 beforeSend : function(){
		 	$("#bAcessar").html('Tente novamente');
	     },
		success: function(retorno){
				if(retorno.status == "s")
				{
					alert(retorno.mensagem);
					window.location.href = "../logado/confidencial.html";
	
				} else {
					alert("Usuario ou Senha incorretos");
			}

		},
		error: function(){
			alert("Ocorreu um erro");
		},
	});
}

function credencial(){

	$.ajax({
		type:"POST",
		dataType: "json",
		url: "/../../php/confidencial.php",
		data: "",
		success: function(retorno){
			if(retorno.credencial == "sim"){

				window.location.href = "../../Paginas/logado/confidencial.html";

			} else {
				alert("Cadastre-se primeiro");
			}
			return false;
		}
	});
}

// function Simetrico(dado){

// 	var aleatorio = Crypto.enc.Hex.stringfy(CryptoJS.lib.WordArray.random(16)).toString();
// 	var vetor = CryptoJS.enc.Utf8.parse(aleatorio);
// 	console.log("Vetor:" + vetor);

// 	var valor = JSON.stringify(data);

// 	valor = Crypto.enc.Base64.stringfy(CryptoJS.enc.Utf8.parse(valor)).toString();
// 	console.log("Valor base64:" + vetor);

// 	var chave = Crypto.enc.Utf8.pase("1234567887654321");

// 	var criptografado = Crypto.AES.encrypt(valor, chave, {
// 		vetor: vetor,
// 		mode: CryptoJS.mode.CBC,
// 		padding: CryptoJS.pad.ZeroPadding
// 	});

// 	var string = criptografado.toString();
// 	console.log("msg cript" + string);

// 	return aleatorio + CryptoJS.enc.Base64.stringfy(CryptoJS.enc.Utf8.parse(criptografado)).toString();
// }
