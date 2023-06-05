$(document).ready(function(){
	$("#bConfidencial").click(function(){
		
        fLocalComunicaServidor('confidencial')

		return false;
	});
});

function fLocalComunicaServidor(arquivo){

	var dados = $("#form-confirma").serialize();

	$.ajax({
		type:"POST",
		dataType: "json",
		url: "/Project/php/"+arquivo+".php",
		data: dados,
		success: function(retorno){

			if(retorno.status == "1")
			{
				window.location.href = "../Paginas/logado/index.php";

			} else {
				alert("Erro interno")
            }
		},
		error: function(){
			alert("Código inválido");
		}
		
	});

}