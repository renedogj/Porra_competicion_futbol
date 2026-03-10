function mostrarPorrasPartido(porrasPartido) {
	$("#divPorrasPartido").append(
		$("<div>").addClass("divTh").text("Nombre"),
		$("<div>").addClass("divTh").text("Porra"),
		$("<div>").addClass("divTh").text("Porra"),
		$("<div>").addClass("divTh").text("Puntuacion"),
	);

	for (porra of porrasPartido){
		porra = validarNulos(porra);
		if(id == porra.id){
			$("#divPorrasPartido").append(
				$("<div>").addClass("divTd").addClass("tuPuntuacion").text(porra.nombre),
				$("<div>").addClass("divTd").addClass("tuPuntuacion").text(porra.apuesta_1),
				$("<div>").addClass("divTd").addClass("tuPuntuacion").text(porra.apuesta_2),
				$("<div>").addClass("divTd").addClass("tuPuntuacion").text(porra.puntuacion),
			);
		}else{
			$("#divPorrasPartido").append(
				$("<div>").addClass("divTd").text(porra.nombre),
				$("<div>").addClass("divTd").text(porra.apuesta_1),
				$("<div>").addClass("divTd").text(porra.apuesta_2),
				$("<div>").addClass("divTd").text(porra.puntuacion),
			);
		}
	}
}

function comprobarEmpate(){
	//Si el partido no es de fase de grupos (!= 1)
	if(partido.faseGrupos != 1){
		//Si se han introducido apuesta
		if($("#inputApuesta_2").val() != "" && $("#inputApuesta_1").val() != ""){
			//Si los valores introducidos son iguales se muestra elegir ganador por penaltis
			if($("#inputApuesta_1").val() == $("#inputApuesta_2").val()){
				$("#divInputGanador").css("display","flex");
			}else{
				//Si no son iguales se oculta todo y se deselecciona el ganador
				$("#divInputGanador").css("display","none");
				$("#ganador_1").prop("checked", false);
				$("#ganador_2").prop("checked", false);
			}
		}
	}
}

function validarNulos(partido){
	if(porra.apuesta_1 == undefined || porra.apuesta_1 == null || porra.apuesta_1 == ""){
		porra.apuesta_1 = "-";
	}
	if(porra.apuesta_2 == undefined || porra.apuesta_2 == null || porra.apuesta_2 == ""){
		porra.apuesta_2 = "-";
	}
	if(porra.puntuacion == undefined || porra.puntuacion == null || porra.puntuacion == ""){
		porra.puntuacion = "-";
	}
	return porra;
}