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
        if(respuesta.cumplimientoPorMesCliente.length > 0) {
          cumplimientoPorMesCliente(respuesta.cumplimientoPorMesCliente);
        }
      },
    });
  });

  const cumplimientoPorMesCliente = (respuesta) => {
    if(respuesta.length == 0) {
      return;
    }

    datasets = [];
    tempMeses = [];

    respuesta.forEach((key, index) => {
      console.log('key: ', key);

      tempValores = [];

      key.forEach(element => {
        tempValores.push(element.cumplimiento);
        if (!tempMeses.includes(element.mes))
          tempMeses.push(element.mes);
       //tempMeses.push(element.mes);
      });

      console.log('cumplimitno: ', index);
      pointColor = ["#3b8bba", "#C7B04A","#C77149","#c1c7d1","#5124B2","#B5CE9B","#9CDCFE","#658FA6"];
      backgroundColor = ["rgba(210, 214, 222, 1)", "rgba(60,141,188,0.9)","rgba(101, 143, 166, 0.8)","rgba(156, 220, 255,0.7)","rgba(60,141,188,0.9)","rgba(60,141,188,0.9)","rgba(60,141,188,0.9)","rgba(60,141,188,0.9)"];
      
      datasets.push({
        label               : key[0].sector,
        backgroundColor     : `${backgroundColor[index]}`,
        borderColor         : `${backgroundColor[index]}`,
        pointRadius          : true,
        pointColor          : `${pointColor[index]}`,
        pointStrokeColor    : `${backgroundColor[index]}`,
        pointHighlightFill  : '#fff',
        pointHighlightStroke: `${backgroundColor[index]}`,
        data                : tempValores,
      })
    });

    console.log('datasets: ', datasets);
    console.log('tempMeses: ', tempMeses);

    

      // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

  var salesChartData = {
    labels  : tempMeses,
    datasets
  }

        ///INICIO DEL GRAFICO
        var salesChartOptions = {
            maintainAspectRatio : true,
            responsive : true,
            legend: {
            display: true
            },
            scales: {
            xAxes: [{
                gridLines : {
                display : true,
                }
            }],
            yAxes: [{
                gridLines : {
                display : true,
                }
            }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas, { 
            type: 'bar', 
            data: salesChartData, 
            options: salesChartOptions
            }
        );
  }

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

    });

    $("#fechaGrafico").html($("#fechaRango").val());

        ///FIN DEL GRAFICO
    $("#cumplimiento").html(html);
  }

});
