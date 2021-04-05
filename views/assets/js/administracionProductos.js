$(function () {
  jQuery(document).ready(function () {
    $("#idTipoProducto").change(function () {
      if ($(this).val()) {
        const data = new FormData();
        data.append("idTipo", $(this).val());
        data.append("exec", "getSubTipo");

        $.ajax({
          url: "ajax/ProductosAjax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (respuesta) {
            console.log("respuesta", respuesta);

            let tipos;
            $("select[name*='idSubTipo']").children().remove().end();
            tipos =
              '<option value="" disabled selected>Seleccione una opción</option>';
            respuesta.forEach((element) => {
              tipos += `<option value=${element["idSub"]}>${element["Subtipo"]}</option>`;
            });

            $("select[name*='idSubTipo']").html(tipos);
          },
        });
      }
    });

    $("select[name*='idCategoria']").change(function () {
      if ($(this).val()) {
        console.log("idCategoria: ", $(this).val());

        const data = new FormData();
        data.append("idCategoria", $(this).val());
        data.append("exec", "getTipo");

        $.ajax({
          url: "ajax/ProductosAjax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (respuesta) {
            // if(respuesta.length > 0) {
            //   $("#idTipoProducto").prop("disabled", false);
            // } else {
            //   $("#idTipoProducto").prop("disabled", true);
            // }

            console.log("respuesta", respuesta);

            let tipos;

            $("select[name*='idTipoProducto']").children().remove().end();
            tipos =
              '<option value="" disabled selected>Seleccione una opción</option>';
            respuesta.forEach((element) => {
              tipos += `<option value=${element["idTipo"]}>${element["tipo"]}</option>`;
            });

            $("select[name*='idTipoProducto']").html(tipos);
          },
        });
      }
    });
  });

  $("#formRegistrarUsuario").validate({
    rules: {
      idCategoria: {
        required: true,
      },
      idTipoProducto: {
        required: true,
      },
      idSubTipo: {
        required: true,
      },
      producto: {
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

    // submitHandler: function (e) {

    //   // Swal.fire({
    //   //   icon: "error",
    //   //   title: "Oops...",
    //   //   text: "El nombre de usaurio que intenta guardar esta asignado!",
    //   // });
    //     console.log();
    // },
  });

  /*=============================================
ELIMINAR PRODUCTO
=============================================*/

  $("#empleados tbody").on("click", "button.btnEliminarProducto", function () {
    var idProducto = $(this).attr("idProducto");
    // var codigo = $(this).attr("codigo");
    // var imagen = $(this).attr("imagen");

    // swal({

    // 	title: '¿Está seguro de borrar el producto?',
    // 	text: "¡Si no lo está puede cancelar la accíón!",
    // 	type: 'warning',
    //       showCancelButton: true,
    //       confirmButtonColor: '#3085d6',
    //       cancelButtonColor: '#d33',
    //       cancelButtonText: 'Cancelar',
    //       confirmButtonText: 'Si, borrar producto!'
    //       }).then(function(result) {
    //       if (result.value) {

    //       	window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;

    //       }

    // })
    console.log('idProducto: ', idProducto);

    Swal.fire({
      title: "Estas seguro?",
      text: "¿Está seguro de borrar el producto?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminarlo!",
    }).then((result) => {
      if (result.isConfirmed) {
          window.location = "index.php?route=administracionProductos&idProducto="+idProducto;
          Swal.fire("Deleted!", "Se ha eliminado.", "success");
      }
    });
  });
});
