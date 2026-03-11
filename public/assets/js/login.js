$("#formInicioSesion").submit(() => {
	if($("#formInicioSesion").valid()){
		var datosInicioSesion = {};
		datosInicioSesion["email"] = $("#inputEmail").val();
		datosInicioSesion["password"] = $("#inputPassword").val();

		$.ajax({
			method: "POST",
			url: "login",
			data: datosInicioSesion,
			success: function(result){
				if(result.userVerified){
					location.reload();
				}else{
					$("#label-inicioIncorrecto").text("Email o Contraseña incorrectos");
					$("#label-inicioIncorrecto").show();
				}
			},error(xhr,status,error){
				console.error(error)
					$("#label-inicioIncorrecto").text("Se ha producido un error al iniar sesión");
					$("#label-inicioIncorrecto").show();
			},
			dataType: "json"
		});
	}
	return false;
});

$("#bttn-cerrarSesion").click(() => {
	$.ajax({
		method: "POST",
		url: "logout",
		success: function(infoUsuario){
			console.log(infoUsuario)
			location.reload();
		},
		dataType: "text"
	});
});