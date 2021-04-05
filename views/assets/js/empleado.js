$(function () {
  var idPuesto = "";

  jQuery(document).ready(function () {
    $("#sexo").change(function () {
      // const dato = $("#sexo").val();
      cargarEstadoCiviles();
    });

    $("#sexoEditar").change(function () {
      // const dato = $("#sexo").val();
      cargarEstadoCivilesEditar();
    });

    $("#departamento").change(function () {
      // const dato = $("#sexo").val();

      cargarPuestoDeTrabajo($("#departamento").val());
      console.log("asdf");
    });

    $("#departamentoEditar").change(function () {
      // const dato = $("#sexo").val();

      cargarPuestoDeTrabajo($("#departamentoEditar").val());
      console.log("asdf");
    });
  });

  cargarEstadoCiviles();

  //EDITAR
  cargarEstadoCivilesEditar();

  function cargarEstadoCiviles() {
    const dato = new FormData();
    dato.append("idSexo", $("#sexo").val());
    // console.log(dato);

    $.ajax({
      url: "ajax/EstadoCivilAjax.php",
      method: "POST",
      data: dato,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        let sexo;
        $("#estadoCivil").children().remove().end();
        sexo =
          '<option value="" disabled selected>Seleccione una opción</option>';
        respuesta.forEach((element) => {
          sexo += `<option value=${element["idEstadoCivil"]}>${element["EstadoCivil"]}</option>`;
        });

        $("#estadoCivil").html(sexo);
      },
    });
  }

  function cargarEstadoCivilesEditar() {
    const dato = new FormData();
    console.log($("#sexoEditar").val());
    dato.append("idSexo", $("#sexoEditar").val());
    // console.log(dato);

    $.ajax({
      url: "ajax/EstadoCivilAjax.php",
      method: "POST",
      data: dato,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        let sexo;
        $("#estadoCivilEditar").children().remove().end();
        sexo =
          '<option value="" disabled selected>Seleccione una opción</option>';
        respuesta.forEach((element) => {
          sexo += `<option value=${element["idEstadoCivil"]}>${element["EstadoCivil"]}</option>`;
        });

        $("#estadoCivilEditar").html(sexo);
      },
    });
  }

  function cargarPuestoDeTrabajo(valor) {
    const dato = new FormData();
    dato.append("idDepartamento", valor);
    // console.log(dato);

    $.ajax({
      url: "ajax/PuestroTrabajoAjax.php",
      method: "POST",
      data: dato,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        let puesto;

        $("#puestoTrabajo").children().remove().end();
        $("#puestoTrabajoEditar").children().remove().end();

        puesto =
          '<option value="" disabled selected>Seleccione una opción</option>';

        respuesta.forEach((element) => {
          puesto += `<option value=${element["idPuesto"]}>${element["PuestoTrabajo"]}</option>`;
        });

        $("#puestoTrabajo").html(puesto);
        $("#puestoTrabajoEditar").html(puesto);
      },
    });
  }

  $(document).ready(function () {
    //$(selector).inputmask("99-9999999");  //static mask
    $("#identificacion").inputmask({ mask: "999-9999999-9" });
    $("#telefono").inputmask({ mask: "(999) 999-9999" }); //specifying options
    $("#celular").inputmask({ mask: "(999) 999-9999" }); //specifying options
  });

  //VALIDACION
  $(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        alert("Form successful submitted!");
      },
    });

    $("#formEmployee").validate({
      rules: {
        correo: {
          required: true,
          email: true,
        },
        nombre: {
          required: true,
          minlength: 2,
        },
        apellido: {
          required: true,
        },
        apellido: {
          required: true,
        },
        sexo: {
          required: true,
        },
        estadoCivil: {
          required: true,
        },
        tipoIdentificacion: {
          required: true,
        },
        identificacion: {
          required: true,
        },
        fechaNacimiento: {
          required: true,
        },
        puestoTrabajo: {
          required: true,
        },
        departamento: {
          required: true,
        },
        centro: {
          required: true,
        },
        fechaIngreso: {
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

        dato.append("foto", $("#nuevaImagen")[0].files[0]);

        dato.append("nombre", $("#nombre").val());
        dato.append("apellido", $("#apellido").val());
        dato.append("idSexo", $("#sexo").val());
        dato.append("idEstadoCivil", $("#estadoCivil").val());
        dato.append("idTipoIdentificacion", $("#tipoIdentificacion").val());
        dato.append("Identificacion", $("#identificacion").val());
        dato.append("telefono", $("#telefono").val());
        dato.append("celular", $("#celular").val());
        dato.append("correo", $("#correo").val());
        dato.append("fechaNacimiento", $("#fechaNacimiento").val());
        dato.append("idCentro", $("#centro").val());
        dato.append("idDepartamento", $("#departamento").val());
        dato.append("idPuestoTrabajo", $("#puestoTrabajo").val());
        dato.append("fechaIngreso", $("#fechaIngreso").val());

        $.ajax({
          url: "ajax/EmpleadoAjax.php",
          method: "POST",
          data: dato,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (respuesta) {
            if (respuesta[0]["status"] == 200) {
              Swal.fire("Ok!", "Se ha guardado correctamente!", "success");
            }

            console.log(respuesta);
            $(".form-control").val("");
            $("#close").click();
          },
        });
      },
    });
  });

  $(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        alert("Form successful submitted!");
      },
    });

    $("#formEmployeeEditar").validate({
      rules: {
        correoEditar: {
          required: true,
          email: true,
        },
        nombreEditar: {
          required: true,
          minlength: 2,
        },
        apellidoEditar: {
          required: true,
        },
        sexoEditar: {
          required: true,
        },
        estadoCivilEditar: {
          required: true,
        },
        tipoIdentificacionEditar: {
          required: true,
        },
        identificacionEditar: {
          required: true,
        },
        fechaNacimientoEditar: {
          required: true,
        },
        puestoTrabajoEditar: {
          required: true,
        },
        departamentoEditar: {
          required: true,
        },
        centroEditar: {
          required: true,
        },
        fechaIngresoEditar: {
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

        dato.append("idEmpleado", $("#idEmpleado").val());
        dato.append("nombre", $("#nombreEditar").val());
        dato.append("apellido", $("#apellidoEditar").val());
        dato.append("idSexo", $("#sexoEditar").val());
        dato.append("idEstadoCivil", $("#estadoCivilEditar").val());
        dato.append("idTipoIdentificacion", $("#tipoIdentificacionEditar").val());
        dato.append("Identificacion", $("#identificacionEditar").val());
        dato.append("telefono", $("#telefonoEditar").val());
        dato.append("celular", $("#celularEditar").val());
        dato.append("correo", $("#correoEditar").val());
        dato.append("fechaNacimiento", $("#fechaNacimientoEditar").val());
        dato.append("idCentro", $("#centroEditar").val());
        dato.append("idDepartamento", $("#departamentoEditar").val());
        dato.append("idPuestoTrabajo", $("#puestoTrabajoEditar").val());
        dato.append("fechaIngreso", $("#fechaIngresoEditar").val());

        $.ajax({
          url: "ajax/EmpleadoAjax.php",
          method: "POST",
          data: dato,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (respuesta) {
            
            console.log(respuesta);

            if (respuesta.length > 0) {
              Swal.fire("Ok!", "Se ha actualizado correctamente!", "success")
              .then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                  location.reload();
                } else if (result.isDenied) {
                  location.reload();
                }
              });
            }

            //Actualizar el datatable
            prueba.ajax.reload();

            console.log(respuesta);
            $(".form-control").val("");
            $("#closeEditar").click();

          },
        });
      },
    });
  });

  //EDITAR EMPLEADOS
  $("#empleados").on("click", ".btnEditEmployee", function () {
    console.log($(".form-control").val());

    const idEmpleado = $(this).attr("idemployee");

    const data = new FormData();
    data.append("idEmpleado", idEmpleado);

    $.ajax({
      url: "ajax/EmpleadoAjax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        $("#nombreP").text(respuesta["nombre"] + " " + respuesta["apellido"]);
        $("#departamentoP").text(
          (
            respuesta["PuestoTrabajo"] +
            " del departamento de " +
            respuesta["Departamento"]
          ).toUpperCase()
        );

        if (respuesta["foto_url"]) {
          $(".previsualizar").attr("src", respuesta["foto_url"]);
        } else {
          $(".previsualizar").attr(
            "src",
            "views/assets/img/empleados/foto_perfil_hombre.jpg"
          );
        }

        $("#idEmpleado").val(respuesta["idEmpleado"]);
        $("#nombreEditar").val(respuesta["nombre"]);
        $("#apellidoEditar").val(respuesta["apellido"]);
        $("#sexoEditar").val(respuesta["sexo"]);
        $("#estadoCivilEditar").val(respuesta["estadoCivil"]);
        $("#tipoIdentificacionEditar").val(respuesta["idTipoIdentificacion"]);
        $("#identificacionEditar").val(respuesta["identificacion"]);
        $("#telefonoEditar").val(respuesta["telefono"]);
        $("#celularEditar").val(respuesta["celular"]);
        $("#correoEditar").val(respuesta["Correo"]);
        $("#fechaNacimientoEditar").val(respuesta["fechaNacimiento"]);
        $("#centroEditar").val(respuesta["idCentro"]);
        $("#departamentoEditar").val(respuesta["idDepartamento"]);
        $("#puestoTrabajoEditar").val(respuesta["idPuesto"]);
        $("#fechaIngresoEditar").val(respuesta["fechaIngreso"]);
      },
    });
  });

  /*=============================================
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/

  $(".nuevaImagen").change(function () {
    var imagen = this.files[0];

    /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
      $(".nuevaImagen").val("");
      swal({
        title: "Error al subir la imagen",
        text: "¡La imagen debe estar en formato JPG o PNG!",
        type: "error",
        confirmButtonText: "¡Cerrar!",
      });
    } else if (imagen["size"] > 2000000) {
      $(".nuevaImagen").val("");

      swal({
        title: "Error al subir la imagen",
        text: "¡La imagen no debe pesar más de 2MB!",
        type: "error",
        confirmButtonText: "¡Cerrar!",
      });
    } else {
      const datosImagen = new FileReader();
      datosImagen.readAsDataURL(imagen);
      $(datosImagen).on("load", function (event) {
        var rutaImagen = event.target.result;
        $(".previsualizar").attr("src", rutaImagen);
      });
    }
  });
});
