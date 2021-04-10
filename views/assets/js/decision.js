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

        if(respuesta.sectorCumplimientoPorFecha.length > 0) {
            construirCumplimientoPorSector(respuesta.sectorCumplimientoPorFecha);
        }
        console.log(respuesta);
      },
    });
  });

  const construirCumplimientoPorSector =(respuesta) => {
      let html = '';
      let color = '';
    respuesta.forEach((key, index) => {
        color = key.porcentaje >= 90 ? "bg-success" : "bg-warning";

        html +=`<div class="progress-group">
                    ${key.sector}
                    <span class="float-right"><b>${key.cumplimiento} Mt3</b>/${key.meta} Mt3</span>
                    <div class="progress progress-sm">
                    <div class="progress-bar ${color}" style="width: ${key.porcentaje}%"></div>
                    </div>
                </div>`;

        console.log('index: ', index);
    });



      // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

  var salesChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label               : 'Digital Goods',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [28, 48, 40, 19, 86, 27, 90]
      },
      {
        label               : 'Electronics',
        backgroundColor     : 'rgba(210, 214, 222, 1)',
        borderColor         : 'rgba(210, 214, 222, 1)',
        pointRadius         : false,
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : [65, 59, 80, 81, 56, 55, 40]
      },
    ]
  }

        ///INICIO DEL GRAFICO

        var salesChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
            display: false
            },
            scales: {
            xAxes: [{
                gridLines : {
                display : false,
                }
            }],
            yAxes: [{
                gridLines : {
                display : false,
                }
            }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas, { 
            type: 'line', 
            data: salesChartData, 
            options: salesChartOptions
            }
        )

        $("#fechaGrafico").html($("#fechaRango").val());

        ///FIN DEL GRAFICO
    $("#cumplimiento").html(html);
  }

});
