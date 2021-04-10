$(function () {

    const formatoFecha =(fecha)=> {
        fecha = fecha.split('/');
        fecha = `${fecha[2]}-${Number(fecha[0])}-${Number(fecha[1])}`;
        return fecha;
    }

  $("#btnBuscar").click(function () {



    let fecha = $("#fechaRango").val();

    fecha = fecha.split(" - ");
    fecha[0] = formatoFecha(fecha[0]);
    fecha[1] = formatoFecha(fecha[1]);
   
    console.log("fecha: ", fecha);

    const dato = new FormData();

    dato.append("exec", "getCumplimientoPorFecha");
    dato.append("fechaInicio", fecha[0]);
    dato.append("fechaFinal", fecha[1]);
    dato.append(
      "sector",
      $("#sector").val().length > 0 ? $("#sector").val() : 0
    );
    dato.append(
      "planta",
      $("#planta").val().length > 0 ? $("#planta").val() : 0
    );

    $.ajax({
      url: "ajax/DecisionAjax.php",
      method: "POST",
      data: dato,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        console.log(respuesta);
      },
    });
  });
});
