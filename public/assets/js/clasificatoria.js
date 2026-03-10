fechaInicioCompeticion = new Date("2024-06-14 21:00");

$.ajax({
	method: "POST",
	url: "../models/obtenerPaises.php",
	success: function(paises){
		for(pais of paises){
			$(".selectPaises").append(
				$("<option>").val(pais.id).text(pais.nombre)
			);
		}
		if(fechaInicioCompeticion < new Date().getTime()){
			$(".selectPaises").attr('disabled','disabled');
		}
	},
	error(xhr,status,error){
		console.error(error)
	},
	dataType: "json",
	async: false
});

$.ajax({
	method: "POST",
	url: "../models/clasificatoria.php",
	success: function(result){
		if(result.length != 0){
			$("#puesto_1").val(result[0].puesto_1);
			$("#puesto_2").val(result[0].puesto_2);
			$("#puesto_3").val(result[0].puesto_3);
			$("#puesto_4").val(result[0].puesto_4);
		}
	},
	error(xhr,status,error){
		console.error(error)
	},
	dataType: "json"
});

if(fechaInicioCompeticion < new Date().getTime()){
	$("#guardarPorraClasificacion").hide();

	$.ajax({
		method: "POST",
		url: "../models/obtenerApuestasClasificatoria.php",
		success: function(result){
			apuestasClasificatoria = result["clasificatoria"];
			id = result["id"];
			console.log(apuestasClasificatoria);
			mostrarPorraClasificatoria(apuestasClasificatoria);
		},
		error(xhr,status,error){
			console.error(error)
		},
		dataType: "json"
	});
}

$("#guardarPorraClasificacion").click(() => {
	if(fechaInicioCompeticion > new Date().getTime()){
		if(!hayRepetidos($("#puesto_1").val(), $("#puesto_2").val())){
			alert("No puedes poner un mismo pais en 2 puestos");
		}else{
			$.ajax({
				method: "POST",
				url: "../models/porraClasificatoria.php",
				data: {
					puesto_1 : $("#puesto_1").val(),
					puesto_2 : $("#puesto_2").val(),
					puesto_3 : $("#puesto_3").val(),
					puesto_4 : $("#puesto_4").val()
				},
				success: function(result){
					if(result.error){
						alert("Se ha producido un error al guardar la apuesta");
					}else{
						alert("Porra guardada");
					}
				},
				error(xhr,status,error){
					console.error(error)
				},
				dataType: "json"
			});
		}
	}else{
		alert("Ya no se aceptan más cambios en esta porra");
	}
});

function hayRepetidos(val1,val2){
	if(val1 != val2){
		return true;
	}
	return false;
}

var intervalCountDownFechaPartido = setInterval(() => {
	var now = new Date().getTime();

	var distance = fechaInicioCompeticion - now;
	var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	var seconds = Math.floor((distance % (1000 * 60)) / 1000);
	
	if (distance < 0) {
		clearInterval(intervalCountDownFechaPartido);
		$("#countdown-timer").text("");
		$(".contdown").text("Ya no puedes editar tu porra, el mundial ya ha comenzado");
	}else{
		$("#countdown-timer").text(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
	}
}, 1000);

function mostrarPorraClasificatoria(apuestasClasificatoria) {
	$("#divClasificatoriaApuestas").append(
		$("<div>").addClass("divTh").text("Nombre"),
		$("<div>").addClass("divTh").text("1º puesto"),
		$("<div>").addClass("divTh").text("2º puesto"),
		// $("<div>").addClass("divTh").text("3º puesto"),
		// $("<div>").addClass("divTh").text("4º puesto"),
		$("<div>").addClass("divTh").text("Puntuacion")
	);

	for (apuesta of apuestasClasificatoria){
		if(id == apuesta.id){
			$("#divClasificatoriaApuestas").append(
				$("<div>").addClass("divTd").addClass("tuPuntuacion").text(apuesta.nombre),
				$("<div>").addClass("divTd").addClass("tuPuntuacion").text(apuesta.puesto_1),
				$("<div>").addClass("divTd").addClass("tuPuntuacion").text(apuesta.puesto_2),
				// $("<div>").addClass("divTd").addClass("tuPuntuacion").text(apuesta.puesto_3),
				// $("<div>").addClass("divTd").addClass("tuPuntuacion").text(apuesta.puesto_4),
				$("<div>").addClass("divTd").addClass("tuPuntuacion").text(apuesta.puntuacion)
			);
		}else{
			$("#divClasificatoriaApuestas").append(
				$("<div>").addClass("divTd").text(apuesta.nombre),
				$("<div>").addClass("divTd").text(apuesta.puesto_1),
				$("<div>").addClass("divTd").text(apuesta.puesto_2),
				// $("<div>").addClass("divTd").text(apuesta.puesto_3),
				// $("<div>").addClass("divTd").text(apuesta.puesto_4),
				$("<div>").addClass("divTd").text(apuesta.puntuacion)
			);
		}
	}
}