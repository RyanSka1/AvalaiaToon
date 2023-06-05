$(document).ready(function(){
	$("#bRecuperar").click(function(){
        
        fLocalComunicaServidor('recuperar')

        return false;
    });
});

function fLocalComunicaServidor(arquivo){

	var dados = $("#form-recuperar").serialize();

	$.ajax({
		type:"POST",
		dataType: "json",
		url: "/Project/php/"+arquivo+".php",
		data: dados,
		success: function(){

			window.location.href = "../php/recupera-email.php";
		}
	});

}