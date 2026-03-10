var partido;
var fechaPartido;
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
		$("#bandera_1").attr("src","../img/banderas/"+partido.abreviatura_1+".png");
		$("#bandera_2").attr("src","../img/banderas/"+partido.abreviatura_2+".png");
		$("#inputApuesta_1").val(partido.apuesta_1);
		$("#inputApuesta_2").val(partido.apuesta_2);
		$("#labelGanador_1").text(partido.abreviatura_1);
		$("#labelGanador_2").text(partido.abreviatura_2);
		fechaPartido = new Date(partido.fecha);
		//Si el partido no es de fase de grupos (!= 1) 
		//y el resultado es un empate mostrar ganador en penaltis
		if(partido.faseGrupos != 1){
			if($("#inputApuesta_2").val() != "" && $("#inputApuesta_1").val() != ""){
				if($("#inputApuesta_1").val() == $("#inputApuesta_2").val()){
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
		alert("Se ha producido un error");
		console.log(error);
		window.location.assign("../");
	},
	dataType: "json",
	async: false
});

$("#inputApuesta_1").focusout(() => {
	comprobarEmpate();
}).change(() => {
	comprobarEmpate();
}).click(() => {
	comprobarEmpate();
});

$("#inputApuesta_2").focusout(() => {
	comprobarEmpate();
}).change(() => {
	comprobarEmpate();
}).click(() => {
	comprobarEmpate();
});

$("#bttnApostar").click(() => {
	if(fechaPartido > new Date().getTime()){
		var datos = {};
		datos["idPartido"] = idPartido;
		datos["idApuesta"] = partido.idApuesta;
		datos["apuesta1"] = $("#inputApuesta_1").val();
		datos["apuesta2"] = $("#inputApuesta_2").val();
		//Si el partido no es de fase de grupos (!= 1) 
		//y los resultados son iguales obtenemos el ganador con penaltis
		if(partido.faseGrupos != 1){
			if($("#inputApuesta_1").val() == $("#inputApuesta_2").val()){
				datos["ganador"] = $("input[type='radio']:checked").val();
			}
		}
		if(validarDatos(datos)){
			$.ajax({
				method: "POST",
				url: "../models/apostar.php",
				data: datos,
				success: function(result){
					if(!result.error){
						window.location.assign("partidos.php");
					}else{
						alert("Se ha producido un error al guardar tu porra");
					}
				},
				error(xhr,status,error){
					console.error(error)
				},
				dataType: "text"
			});
		}else{
			alert("Los datos introducidos no son correctos");
		}
	}else{
		alert("La porra de este partido esta cerrada, lo siento");
	}
})

if(fechaPartido < new Date().getTime()){
	$("#bttnApostar").hide();
	$.ajax({
		method: "POST",
		url: "../models/obtenerApuestasPartido.php",
		data: {
			idPartido : idPartido,
		},
		success: function(result){
			console.log(result);
			porrasPartido = result["porrasPartido"];
			id = result["id"];
			mostrarPorrasPartido(porrasPartido);
			comprobarEmpate();
		},
		error(xhr,status,error){
			console.error(error)
		},
		dataType: "json"
	});
}

var intervalCountDownFechaPartido = setInterval(() => {
	var now = new Date().getTime();

	var distance = fechaPartido - now;
	var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	if (distance < 0) {
		clearInterval(intervalCountDownFechaPartido);
		$("#countdown-timer").text("");
		$(".contdown").text("Ya no puedes editar tu porra, el partido ya ha comenzado");
	}else{
		$("#countdown-timer").text(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
	}
}, 1000);

function validarDatos(datos){
	let apuesta1 = datos["apuesta1"];
	let apuesta2 = datos["apuesta2"];
	var ganadorCorrecto = true;
	//Si el partido no es de fase de grupos (!= 1)
	//y el partido está empatado comprobamos que datos["ganador"] esta definido
	if(partido.faseGrupos != 1){
		if($("#inputApuesta_1").val() == $("#inputApuesta_2").val()){
			ganadorCorrecto = (datos["ganador"] != undefined);
		}
	}
	//Si las apuestas son numero
	//Comprobamos sin tiene entre 1 y 3 digitos
	//Comprobamos ganadorCorreto
	if(!isNaN(apuesta1) || !isNaN(apuesta2)){
		return (/^[0-9]{1,3}$/.test(apuesta1) && /^[0-9]{1,3}$/.test(apuesta2) && ganadorCorrecto);
	}
	return false;
}