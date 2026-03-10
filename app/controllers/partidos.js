var grupos = ["A","B","C","D","E","F","G","H","2","3","4","5","6"];
var partidosGrupos = [new Array(),new Array];
var partidos = [];
$.ajax({
	method: "POST",
	url: "../models/obtenerPartidosApuestas.php",
	success: function(result){
		partidos = result

		for (grupo of grupos){
			if(isNaN(grupo)){
				partidosGrupos[0][grupo] = partidos.filter(comprobarGrupo,grupo);
			}else{
				partidosGrupos[1][grupo] = partidos.filter(comprobarGrupo,grupo);
			}
		}
		mostrarPartidosPorGrupos(partidosGrupos);
		mostrarPartidosPorFecha(partidos);
		// $("#divPartidosPorGrupos").css("display","none");
		$("#divPartidosPorFecha").css("display","none");
		location.assign("#divPartidosGrupo-2");
	},
	error(xhr,status,error){
		console.log(error)
	},
	dataType: "json"
});

function comprobarGrupo(partido, index, partidos){
	if(partido.faseGrupos == 1){
		if(partido.grupo_1 == partido.grupo_2){
			return partido.grupo_1 == this
		}
		return false;
	}else{
		return partido.faseGrupos == this;
	}
	return false;
}

$("#selectDisplay").change(() => {
	if($("#selectDisplay").val() == "grupo"){
		$("#divPartidosPorGrupos").css("display","block");
		$("#divPartidosPorFecha").css("display","none");
	}else if($("#selectDisplay").val() == "fecha"){
		$("#divPartidosPorGrupos").css("display","none");
		$("#divPartidosPorFecha").css("display","block");
	}
});