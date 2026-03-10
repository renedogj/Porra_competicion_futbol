function mostrarClasificaciones(clasificacion, id){
	for(i in clasificacion){
		$("#tablaClasificaciones").append(
			tdClasificacion(clasificacion[i], i, id)
		);
	}
}

function tdClasificacion(persona, index, id){
	var tr = $("<tr>").append(
		$("<td>").addClass("tdPosicion").text(++index),
		$("<td>").addClass("tdNombre").text(persona.nombre),
		$("<td>").addClass("tdpuntuacion").text(persona.puntuacion),
	);
	if(persona.id == id){
		tr.addClass("tuPuntuacion");
	}
	return tr;
}