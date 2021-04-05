$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert("Form successful submitted!");
    },
  });

  $("#formRegistrarUsuario").validate({
    rules: {
      idEmpleado: {
        required: true,
      },
      usuario: {
        required: true,
        minlength: 2,
      },
      clave: {
        required: true,
      },
      idEstado: {
        required: true,
      },
    },
    messages: {
      terms: "Please accept our terms",
    },
    errorElement: "span",
    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback");
      element.closest(".form-group").append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("is-invalid");
    },

    submitHandler: function (e) {
      const dato = new FormData();
      console.log("hola mundi");

      dato.append("exec", "registrarUsuario");
      dato.append("idEmpleado", $("#idEmpleado").val());
      dato.append("usuario", $("#usuario").val());
      dato.append("clave", $("#clave").val());
      dato.append("idEstado", $("#idEstado").val());

      $.ajax({
        url: "ajax/UsuariosAjax.php",
        method: "POST",
        data: dato,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        //   beforeSend: function() {

        //   },
        success: function (respuesta) {
          console.log(respuesta.status);
          if (respuesta.status == 200) {
            console.log(respuesta);

            $(".form-control").val("");
            $("#closeEditar").click();

            Swal.fire(
              "Ok!",
              "Se ha actualizado correctamente!",
              "success"
            );
          } else if (respuesta.status == 203) {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "El nombre de usaurio que intenta guardar esta asignado!",
            });
          }
        },
      });
    },
  });
});
