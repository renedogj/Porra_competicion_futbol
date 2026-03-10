$("#formInicioSesion").submit(() => {
	if($("#formInicioSesion").valid()){
		var datosInicioSesion = {};
		datosInicioSesion["nombre"] = $("#inputNombre").val();
		datosInicioSesion["password"] = $("#inputPassword").val();

		$.ajax({
			method: "POST",
			url: "models/iniciarSesion.php",
			data: datosInicioSesion,
			success: function(result){
				console.log(result)
				if(!result.error){
					// location.reload();
				}else{
					$("#label-inicioIncorrecto").text("Email o Contraseña incorrectos");
					$("#label-inicioIncorrecto").show();
				}
			},error(xhr,status,error){
				console.error(error)
			},
			dataType: "json"
		});
	}
	return false;
});