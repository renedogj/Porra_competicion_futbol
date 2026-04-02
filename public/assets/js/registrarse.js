$("#formRegistrarse").submit(() => {
	if($("#formRegistrarse").valid()){
		var datosRegistrarse = {};
		datosRegistrarse["email"] = $("#inputEmail").val();
		datosRegistrarse["nombre"] = $("#inputNombre").val();
		datosRegistrarse["password"] = $("#inputPassword").val();
		datosRegistrarse["telefono"] = $("#inputTelefono").val();

		$.ajax({
			method: "POST",
			url: "../models/registrarse.php",
			data: datosRegistrarse,
			success: function(result){
				if(!result.error){
					window.location.assign("../")
				}else{
					if(result.errorInfo.errorCode == 23000 && result.errorInfo.code == 1062){
						if(result.errorInfo.key == "UK_email"){
							$("#inputEmail-error").text("Ya existe una cuenta con ese email");
							$("#inputEmail-error").show();
						}
					}
				}
			},
			dataType: "json"
		});
	}
	return false;
});