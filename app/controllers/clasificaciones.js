$.ajax({
	method: "POST",
	url: "../models/obtenerClasificacion.php",
	success: function(result){
		console.log(result);
		clasificacion = result["clasificacion"];
		id = result["id"];
		mostrarClasificaciones(clasificacion,id);
	},
	error(xhr,status,error){
		console.log(error)
	},
	dataType: "json"
});

