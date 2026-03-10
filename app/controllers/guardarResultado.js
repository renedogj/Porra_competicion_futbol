/*La estructura de este archivo es similar a la del archivo apuestas.js*/

var partido;
$.ajax({
	method: "POST",
	url: "../models/obtenerPartido.php",
	data: {
		idPartido: idPartido
	},
	success: function(result){
		partido = result;
		$("#div_pais_1").text(partido.nombre_1);
		$("#div_pais_2").text(partido.nombre_2);
		$("#bandera_1").attr("src","../img/banderas/"+partido.abreviatura_1+".webp");
		$("#bandera_2").attr("src","../img/banderas/"+partido.abreviatura_2+".webp");
		$("#inputResultado_1").val(partido.resultado_1);
		$("#inputResultado_2").val(partido.resultado_2);
		$("#labelGanador_1").text(partido.abreviatura_1);
		$("#labelGanador_2").text(partido.abreviatura_2);
		//Si el partido no es de fase de grupos (!= 1) 
		//y el resultado es un empate mostrar ganador en penaltis
		if(partido.faseGrupos != 1){
			if($("#inputResultado_2").val() != "" && $("#inputResultado_1").val() != ""){
				if($("#inputResultado_1").val() == $("#inputResultado_2").val()){
					$("#divInputGanador").css("display","flex");
				}else{
					$("#divInputGanador").css("display","none");
				}
				//Seleccionar quien es el ganador en penaltis
				if(partido.ganador == 1){
					$("#ganador_1").prop("checked", true);
				}else{
					$("#ganador_2").prop("checked", true);
				}
			}
		}
	},
	error(xhr,status,error){
		console.log(error)
		//window.location.assign("../");
	},
	dataType: "json",
	async: false
});

$("#inputResultado_1").focusout(() => {
	comprobarEmpate();
}).change(() => {
	comprobarEmpate();
}).click(() => {
	comprobarEmpate();
});

$("#inputResultado_2").focusout(() => {
	comprobarEmpate();
}).change(() => {
	comprobarEmpate();
}).click(() => {
	comprobarEmpate();
});

$("#bttnGuardarResultado").click(() => {
	var datos = {};
	datos["idPartido"] = idPartido;
	datos["faseGrupos"] = partido.faseGrupos;
	datos["resultado1"] = $("#inputResultado_1").val();
	datos["resultado2"] = $("#inputResultado_2").val();
	if(partido.faseGrupos != 1){
		if($("#inputResultado_1").val() == $("#inputResultado_2").val()){
			datos["ganador"] = $("input[type='radio']:checked").val();
		}
	}
	if(validarDatos(datos)){
		$.ajax({
			method: "POST",
			url: "../models/guardarResultados.php",
			data: datos,
			success: function(result){
				alert("Resultado y puntuaciones actualizadas con exito");
				window.location.assign("partidos.php");
			},
			error(xhr,status,error){
				console.log(error)
			},
			dataType: "text"
		});
	}else{
		alert("Los datos introducidos no son correctos");
	}

})

function validarDatos(datos){
	let resultado1 = datos["resultado1"];
	let resultado2 = datos["resultado2"];
	var ganadorCorrecto = true;
	if(partido.faseGrupos != 1){
		if($("#inputResultado_1").val() == $("#inputResultado_2").val()){
			ganadorCorrecto = (datos["ganador"] != undefined);
		}
	}
	if(!isNaN(resultado1) || !isNaN(resultado2)){
		return (/^[0-9]{1,3}$/.test(resultado1) && /^[0-9]{1,3}$/.test(resultado2) && ganadorCorrecto);
	}
	return false;
}

function comprobarEmpate(){
	if(partido.faseGrupos != 1){
		if($("#inputResultado_2").val() != "" && $("#inputResultado_1").val() != ""){
			if($("#inputResultado_1").val() == $("#inputResultado_2").val()){
				$("#divInputGanador").css("display","flex");
			}else{
				$("#divInputGanador").css("display","none");
			}
		}
	}
}