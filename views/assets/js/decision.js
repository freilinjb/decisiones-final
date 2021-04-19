$(function () {
  const formatoFecha = (fecha) => {
    fecha = fecha.split("/");
    fecha = `${fecha[2]}-${Number(fecha[0])}-${Number(fecha[1])}`;
    return fecha;
  };

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
        if (respuesta.sectorCumplimientoPorFecha.length > 0) {
          construirCumplimientoPorSector(respuesta.sectorCumplimientoPorFecha);
        }
        if (respuesta.cumplimientoPorMesCliente[0].length > 0) {
          cumplimientoPorMesCliente(respuesta.cumplimientoPorMesCliente);
        }
        if (respuesta.getProblemasOcurridos.length > 0) {
          getProblemasOcurridos(respuesta.getProblemasOcurridos);
        }
        if (respuesta.getCausasEncontradas.length > 0) {
          getCausasEncontradas(respuesta.getCausasEncontradas);
        }
        if (respuesta.getRelacionPlantaCausas.length > 0) {
          getRelacionPlantaCausas(respuesta.getRelacionPlantaCausas);
        }
      },
    });
  });

  const getRelacionPlantaCausas = (respuesta) => {
    let temp = [];

    respuesta.forEach((key) => {
      temp.push({
        planta: key.planta,
        causa: key.causa,
        problema: key.problema,
        date: key.date,
        cantidad: Number(key.cantidad),
      });
    });

    // $("#pivotteProblemasPlantas").pivotUI(respuesta, {
    //   rows: ["planta", "causa"],
    //   cols: ["problema"],
    //   vals: ["cantidad"],
    //   aggregatorName: "Sum over Sum",
    //   rendererName: "Heatmap",
    // });

    graficoPlantas(temp);

  };

  const getCausasEncontradas = (respuesta) => {
    let dataPoints = [];
    respuesta.forEach((key, index) => {
      dataPoints.push({
        label: key.causa,
        y: key.cantidad,
        legendText: key.causa,
      });
    });

    construirGraficoDonat(
      "chartContainerCausas",
      dataPoints,
      "Causas relacioadas",
      "Causas in"
    );
  };

  const getProblemasOcurridos = (respuesta) => {
    /**
     * DONA CHART
     */

    let dataPoints = [];
    //CARGA LA TABLA DE LOS PROBLEMAS ENCONJTRADOS
    let html = `<div class="table-responsive">
                  <table class="table m-0">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Interrucción</th>
                              <th>Duracion</th>
                              <th>Porcentaje</th>
                              <th>Proporcion Mt3</th>
                          </tr>
                      </thead>
                      <tbody>`;
    let totalParo = 0,
      tiempoMedioArranque = 0,
      metaPromedio = 0,
      metaPorcentual = 0;

    respuesta.forEach((key, index) => {
      //CARGA LA INFORMACION AL CHART CIRCULAR
      dataPoints.push({
        label: key.problema,
        y: key.porcentaje_perdida,
        legendText: key.problema,
      });

      totalParo += Number(key.duracion);
      metaPromedio += Number(key.meta);

      html += `
              <tr>
                  <td>${index + 1}</td>
                  <td>${key.problema.replace(".", ":")}</td>
                  <td> H ${key.duracion}</td>
                  <td> <span class="badge badge-alert">  % ${
                    key.porcentaje_perdida
                  } </span> </td>
                  <td> ${Math.round(
                    key.meta -
                      Number(key.meta) * (Number(key.porcentaje_perdida) / 100)
                  )}</td>
              </tr>`;
    });

    html += `
            </tbody>
          </table>
          </div>`;

    //RESUMEN
    $("#totalParo").html(totalParo);
    $("#tiempoMedioArranque").html(totalParo / respuesta.length);
    $("#metaPromedio").html(
      Math.round(metaPromedio / respuesta.length, 2) + " Mt3 "
    );

    $("#tableProblema").html(html);

    $("#chartContainerProblemas").CanvasJSChart({
      title: {
        text: "Porcentaje de atraso",
        fontSize: 24,
      },
      axisY: {
        title: "Products in %",
      },
      legend: {
        verticalAlign: "center",
        horizontalAlign: "right",
      },
      data: [
        {
          type: "pie",
          showInLegend: true,
          toolTipContent: "{label} <br/> {y} %",
          indexLabel: "{y} %",
          dataPoints,
        },
      ],
    });
  };

  const construirGraficoDonat = (clase, dataPoints, titulo, tituloY) => {
    console.log("construirGraficoDonat: ", dataPoints);
    $(`#${clase}`).CanvasJSChart({
      title: {
        text: titulo,
        fontSize: 24,
      },
      axisY: {
        title: tituloY,
      },
      legend: {
        verticalAlign: "center",
        horizontalAlign: "right",
      },
      data: [
        {
          type: "pie",
          showInLegend: true,
          toolTipContent: "{label} <br/> {y} %",
          indexLabel: "{y} %",
          dataPoints,
        },
      ],
    });
  };
  const cumplimientoPorMesCliente = (respuesta) => {
    if (respuesta.length == 0) {
      return;
    }

    datasets = [];
    tempMeses = [];

    respuesta.forEach((key, index) => {
      console.log("key: ", key);

      tempValores = [];

      key.forEach((element) => {
        tempValores.push(element.cumplimiento);
        if (!tempMeses.includes(element.mes)) tempMeses.push(element.mes);
        //tempMeses.push(element.mes);
      });

      console.log("cumplimitno: ", index);
      pointColor = [
        "#3b8bba",
        "#C7B04A",
        "#C77149",
        "#c1c7d1",
        "#5124B2",
        "#B5CE9B",
        "#9CDCFE",
        "#658FA6",
      ];

      backgroundColor = [
        "rgba(210, 214, 222, 1)",
        "rgba(60,141,188,0.9)",
        "rgba(101, 143, 166, 0.8)",
        "rgba(156, 220, 255,0.7)",
        "rgba(43, 123, 255,0.5)",
        "rgba(174, 204, 255, 0.7)",
        "rgba(221, 81, 69, 0.4)",
        "rgba(255, 206, 68, 0.6)",
      ];

      datasets.push({
        label: key[0].sector,
        backgroundColor: `${backgroundColor[index]}`,
        borderColor: `${backgroundColor[index]}`,
        pointRadius: true,
        pointColor: `${pointColor[index]}`,
        pointStrokeColor: `${backgroundColor[index]}`,
        pointHighlightFill: "#fff",
        pointHighlightStroke: `${backgroundColor[index]}`,
        data: tempValores,
      });
    });

    console.log("datasets: ", datasets);
    console.log("tempMeses: ", tempMeses);

    // Get context with jQuery - using jQuery's .get() method.
    $("#salesChart").html("");
    var salesChartCanvas = $("#salesChart").get(0).getContext("2d");

    var salesChartData = {
      labels: tempMeses,
      datasets,
    };

    ///INICIO DEL GRAFICO
    var salesChartOptions = {
      maintainAspectRatio: true,
      responsive: true,
      legend: {
        display: true,
      },
      scales: {
        xAxes: [
          {
            gridLines: {
              display: true,
            },
          },
        ],
        yAxes: [
          {
            gridLines: {
              display: true,
            },
          },
        ],
      },
    };

    // This will get the first returned node in the jQuery collection.
    var salesChart = new Chart(salesChartCanvas, {
      type: "bar",
      data: salesChartData,
      options: salesChartOptions,
    });
  };

  const construirCumplimientoPorSector = (respuesta) => {
    let html = "";
    let color = "";
    respuesta.forEach((key, index) => {
      color = key.porcentaje >= 90 ? "bg-success" : "bg-warning";

      html += `<div class="progress-group">
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
  };

  //PRUEBA INICIO

  const graficoPlantas = (data) => {

    var pivotGridChart = $("#pivotgrid-chart")
      .dxChart({
        commonSeriesSettings: {
          type: "bar",
        },
        tooltip: {
          enabled: true,
          format: "currency",
          customizeTooltip: function (args) {
            return {
              html:
                args.seriesName +
                " | Total<div class='currency'>" +
                args.valueText +
                "</div>",
            };
          },
        },
        size: {
          height: 200,
        },
        adaptiveLayout: {
          width: 450,
        },
      })
      .dxChart("instance");

    var pivotGrid = $("#pivotgrid")
      .dxPivotGrid({
        allowSortingBySummary: true,
        allowFiltering: true,
        showBorders: true,
        showColumnGrandTotals: false,
        showRowGrandTotals: false,
        showRowTotals: false,
        showColumnTotals: false,
        fieldChooser: {
          enabled: true,
          height: 400,
        },
        dataSource: {
          fields: [
            {
              caption: "Planta",
              width: 120,
              dataField: "planta",
              area: "row",
              sortBySummaryField: "Total",
            },
            {
              caption: "Causa",
              dataField: "causa",
              width: 150,
              area: "row",
            },
            {
              caption: "Problema",
              dataField: "problema",
              width: 150,
              area: "row",
            },
            {
              dataField: "date",
                dataType: "date",
                area: "column"
            },
            
            {
              caption: "Total",
              dataField: "cantidad",
              dataType: "number",
              summaryType: "sum",
              format: "currency",
              area: "data",
            },
          ],
          store: data,
        },
      })
      .dxPivotGrid("instance");

    pivotGrid.bindChart(pivotGridChart, {
      dataFieldsDisplayMode: "splitPanes",
      alternateDataFields: false,
    });

    function expand() {
      var dataSource = pivotGrid.getDataSource();
      dataSource.expandHeaderItem("row", ["North America"]);
      dataSource.expandHeaderItem("column", [2013]);
    }

    setTimeout(expand, 0);
  };
  //PRUEBA FIN
});
