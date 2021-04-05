$(function () {
  //VALIDACION
  $(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        alert("Form successful submitted!");
      },
    });

    $("#formEvento").validate({
      rules: {
        evento: {
          required: true,
        },
        fase: {
          required: true,
        },
        distribucion: {
          required: true,
        },
        estado: {
          required: true,
        },
        descripcion: {
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

        dato.append("exec", "registrarEvento");
        dato.append("evento", $("#evento").val());
        dato.append("fase", $("#fase").val());
        dato.append("distribucion", $("#distribucion").val());
        dato.append("descripcion", $("#descripcion").val());
        dato.append("estado", $("#estado").val());

        $.ajax({
          url: "ajax/SimulacionAjax.php",
          method: "POST",
          data: dato,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (respuesta) {
            console.log(respuesta);

            if (respuesta == true) {
              Swal.fire(
                "Ok!",
                "Se ha actualizado correctamente!",
                "success"
              ).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                  location.reload();
                } else if (result.isDenied) {
                  location.reload();
                }
              });
            }

            //Actualizar el datatable
            // prueba.ajax.reload();

            // console.log(respuesta);
            $(".form-control").val("");
            $("#close").click();
          },
        });
      },
    });
  });

  //ELIMINAR REGISTRO
  $("#empleados tbody").on("click", "button.btnEliminarEvento", function () {
    var idEvento = $(this).attr("idEvento");
    console.log('idEvento: ', idEvento);

    Swal.fire({
      title: "Estas seguro?",
      text: "¿Está seguro de borrar el evento?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminarlo!",
    }).then((result) => {
      if (result.isConfirmed) {
          // window.location = "index.php?route=eventos&idEvento="+idEvento;
          const dato = new FormData();
          dato.append("exec", "eliminarEvento");
          dato.append("idEvento", idEvento);

          $.ajax({
            url: "ajax/SimulacionAjax.php",
            method: "POST",
            data: dato,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
              console.log(respuesta);
    
              if (respuesta == true) {
                Swal.fire(
                  "Ok!",
                  "Se ha eliminado correctamente!",
                  "success"
                ).then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  } else if (result.isDenied) {
                    location.reload();
                  }
                });
              }
            },
          });
          // Swal.fire("Deleted!", "Se ha eliminado.", "success");
      }
    });
  });
});
