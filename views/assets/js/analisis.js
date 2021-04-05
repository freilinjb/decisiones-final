  $(function () {
    let fasesServicio = [];
    let productosServicio = [];
    let EventosServicio = [];

    let fasesGrafico = [];
    let productosGrafico = [];
    let probabilidadSum = 0;
    let tiempoTotalServicio = 0;

    let datosGenerales = [];
    let eventosEncontrados = [];
    let productoSeleccionado = [];

    let fecha = new Date();
    /**
     * SIMULACION
     */

    var numero = 1;
    function Factorial(num) {
      var numero = 1;
      for (var sw = 1; sw <= num; sw += 1) {
        numero *= sw;
      }
      return numero;
    }

    function NumComb(sup, inf) {
      return Factorial(sup) / (Factorial(inf) * Factorial(sup - inf));
    }

    function Binomial(n, p, k) {
      // miForm = document.forms[0];
      n = parseInt(n);
      k = parseInt(k);
      // miForm.pruebas.value = n;
      // miForm.exitos.value = k;
      var vResp;

      if (n > 0 && p >= 0 && p <= 1 && k >= 0 && k <= n) {
        vResp = NumComb(n, k) * Math.pow(p, k) * Math.pow(1 - p, n - k);
        if (isNaN(vResp) == true) {
          vResp = " � E R R O R ! ";
        }
      } else {
        vResp = " � E R R O R ! ";
      }

      return vResp;
    }
    //--------------------------------------------
    function BinomialAcu(n, p, k) {
      // miForm = document.forms[1];
      n = parseInt(n);
      k = parseInt(k);
      // miForm.pruebas.value = n;
      // miForm.exitos.value = k;
      var vResp = 0;
      var i = 0;

      if (n > 0 && p >= 0 && p <= 1 && k >= 0 && k <= n) {
        while (i <= k) {
          vResp += NumComb(n, i) * Math.pow(p, i) * Math.pow(1 - p, n - i);
          i++;
        }
        if (isNaN(vResp) == true) {
          vResp = " � E R R O R ! ";
        }
        // miForm.respuesta.value = vResp;
      } else {
        vResp = " � E R R O R ! ";
        // miForm.respuesta.value = vResp;
      }
    }

    function exponencial(u) {
      const aleatorio = Math.random();
      return -u * Math.LN10;
    }

    /**
     * Distribucion Poisson canal unico
     * @param {float} lambda
     */

    function distroPoisson(lambda) {
      const aleatorio = Math.random();
      return (-1 / lambda) * Math.LN2(aleatorio);
    }

    $("#btnProcesar").click(function () {
      simulacion();
    });

    let lambda = 0;
    let mew = 0;

    let lambdaSum = 0;
    let mewSum = 0;

    function simulacion() {

      datosGenerales = [];
      eventosEncontrados = [];
      productoSeleccionado = [];

      let iteraciones = $("#numOrdenes").val();

      for (let i = 0; i < iteraciones; i++) {
        let productoElegidoObj = null;
        productosServicio.forEach((key, index) => {
          const aleatorio = Math.round(Math.random() * 100, 2);

          console.log("aleatorio: ", aleatorio);
          if (key["desde"] >= aleatorio && aleatorio <= key["hasta"]) {
            productoElegidoObj = key;
            return;
          }
        });

        productoSeleccionado.push({
          idProducto: productoElegidoObj["idProducto"],
          producto: productoElegidoObj["producto"],
          tanda: productoElegidoObj["tanda"],
          probabilidad: productoElegidoObj["idProducto"],
          lambda: lambda,
          mew: mew,
          fecha: fecha.setHours(
            fecha.getHours() + parseInt($("#numPromedioDuracion").val())
          ),
        });

        fasesServicio.forEach((fase, indexFase) => {
          lambda = fase["llegada"];

          EventosServicio.forEach((evento, indexEvento) => {
            if (fase["fase"] == evento["fase"]) {
              // console.log(fase["fase"]);
              // console.log("evento: ", evento);
              // const aleatorio = binomial(aleatorio);
              const aleatorio = Math.round(parseFloat(Math.random() * 100), 2);

              if (evento["desde"] >= aleatorio && aleatorio <= evento["hasta"]) {
                console.log("cumplio: ", aleatorio);

                eventosEncontrados.push({
                  numOrden: i,
                  fase: evento["fase"],
                  evento: evento["evento"],
                  accionCorrectiva: evento["accionCorrectiva"],
                  t_servicio: evento["t_servicio"],
                  fase: evento["fase"],
                  fecha: fecha.setHours(
                    fecha.getHours() + parseInt($("#numPromedioDuracion").val())
                  ),
                });
                tiempoTotalServicio +=
                  parseFloat(tiempoTotalServicio) *
                  parseFloat(evento["t_servicio"]);
              }
            }
          });
        });

        console.log("productoElegidoObj: ", productoElegidoObj);
        lambda =
          parseFloat($("#numOrdenes").val() * 24) /
          parseFloat(tiempoTotalServicio);
        mew = parseFloat($("#numPromedioDuracion").val()) / 8;

        console.log("mew: ", mew);
        console.log("lambda: ", lambda);
        console.log("tiempoTotalServicio: ", tiempoTotalServicio / 60);

        //SUMATORIA TOTAL DE LAS VARIABLES;
        lambdaSum += lambda;
        mewSum += mew;


        datosGenerales.push({
          mew: mew,
          lambda: lambda,
          producto: productoElegidoObj,
        });
      }

      console.log("lambdaSum: ",lambdaSum);
      // console.log("eventosEncontrados: ",eventosEncontrados);
      console.log("mewSum: ",mewSum);


      generarConclusion(lambdaSum, mewSum);
      generarTablaProcesamientoEventos(eventosEncontrados);
      generarTablaProcesamientoProductos(productoSeleccionado);

    }

    $("#formProcesar").validate({
      rules: {
        tanda: {
          required: true,
        },
        numOrdenes: {
          required: true,
          max: 1000,
          min: 1,
        },
        numPromedioDuracion: {
          required: true,
          max: 8,
          min: 2,
        },
        tiempoObjetivo: {
          required: true,
          max: 8,
          min: 1,
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

        /**
         * CONSULTAR LA INFORMACION DE LOS EVENTOS
         */
        $.post(
          "ajax/SimulacionAjax.php",
          { exec: "getEventos" },
          function (data) {
            EventosServicio = [];
            data.forEach((key, index) => {
              if (index == 0) {
                desde = 0;
                hasta = parseFloat(key["probabilidad"]);
              } else {
                desde += parseFloat(data[index - 1]["probabilidad"]);
                hasta += parseFloat(key["probabilidad"]);
              }

              let temp = {
                idEvento: key["idEvento"],
                evento: key["evento"],
                probabilidad: key["probabilidad"],
                idFase: key["idFase"],
                fase: key["fase"],
                tanda: key["tanda"],
                descripcion: key["descripcion"],
                distribucion: key["distribucion"],
                tipoDistribucion: key["tipo"],
                accionCorrectiva: key["accionCorrectiva"],
                t_servicio: key["t_servicio"],
                desde: desde,
                hasta: hasta,
              };
              EventosServicio.push(temp);
            });
          },
          "json"
        );

        // console.log('EventosServicio:', EventosServicio);
        if (EventosServicio.length > 0) {
          generarTablaEventos(EventosServicio);
        }
        /**
         * CONSULTAR LA INFORMACION DE LAS TANDAS
         */
        $.post(
          "ajax/SimulacionAjax.php",
          { exec: "getTandaTiempoServicio", idTanda: $("#tanda").val() },
          function (data) {
            // console.log(data);

            fasesServicio = [];
            fasesGrafico = [];
            let desde = 0;
            let hasta = 0;

            data.forEach((key, index) => {
              probabilidadSum += parseFloat(key["llegada"]);
              tiempoTotalServicio += parseFloat(key["llegada"]);

              // console.log(probabilidadSum);
              let grafico = {
                label: key["fase"],
                data: Math.round(parseFloat(key["probabilidad"]), 2),
              };

              if (index == 0) {
                desde = 0;
                hasta = parseFloat(key["probabilidad"]);
              } else {
                desde += parseFloat(data[index - 1]["probabilidad"]);
                hasta += parseFloat(key["probabilidad"]);
              }

              fasesGrafico.push(grafico);

              let temp = {
                fase: key["fase"],
                idFase: key["idFase"],
                idTanda: key["idTanda"],
                llegada: key["llegada"],
                probabilidad: key["probabilidad"],
                tanda: key["tanda"],
                desde: desde,
                hasta: hasta,
              };
              fasesServicio.push(temp);
            });
          },
          "json"
        );

        generarTablaFases(fasesServicio);

        if (fasesGrafico.length > 0) {
          crearGrafico("fase", fasesGrafico);
          $("#faseTiempo").html(
            `<strong>${Math.round(probabilidadSum / 60, 2)} horas</strong>`
          );
        }

        // console.log("fasesServicio: ", fasesServicio);
        let desde = 0;
        let hasta = 0;

        $.post(
          "ajax/SimulacionAjax.php",
          { exec: "getTiempoServicio", idTanda: $("#tanda").val() },
          function (data) {
            // console.log(data);
            productosServicio = [];
            productosGrafico = [];
            data.forEach((key, index) => {
              // console.log(key['fase']);
              let grafico = {
                label: key["producto"],
                data: parseFloat(key["probabilidad"]),
              };
              if (index == 0) {
                desde = 0;
                hasta = parseFloat(key["probabilidad"]);
              } else {
                desde += parseFloat(data[index - 1]["probabilidad"]);
                hasta += parseFloat(key["probabilidad"]);
              }

              let temp = {
                idProducto: key["idProducto"],
                idTanda: key["idTanda"],
                llegadas: key["llegadas"],
                probabilidad: key["probabilidad"],
                producto: key["producto"],
                tanda: key["tanda"],
                desde: desde,
                hasta: hasta,
              };
              productosServicio.push(temp);
              productosGrafico.push(grafico);
            });
          },
          "json"
        );

        console.log("productosServicio: ", productosServicio);
        if (productosGrafico.length > 0) {
          crearGrafico("producto", productosGrafico);
        }
      },
    });

    /**
     * GENERAR TABLAS FASES
     */
    function generarTablaFases(arreglo) {
      let html = `
                <thead style="background-color:#6F747E; color:#FFFF">
                  <tr>
                    <th colspan="6"><h3 class="text-center">INFORMACION DE LAS FASES DE PRODUCCION</h3></th>
                  </tr>

                  <tr>
                    <th>#</th>
                    <th>Fase</th>
                    <th>%</th>
                    <th>servicio(Min)</th>
                    <th>Tanda</th>
                    <th>Intervalo</th>
                  <tr> 
                </thead>`;

      let tiempoServicio = 0;
      let probabilidad = 0;
      arreglo.forEach((key, index) => {
        tiempoServicio += parseFloat(key["llegada"]);
        probabilidad += parseFloat(key["probabilidad"]);
        html += `
                    <tr>
                    <td><strong>${index + 1}</strong></td>
                    <td><strong>${key["fase"]}</strong></td>
                    <td><strong>${key["probabilidad"]} %</strong></td>
                    <td><strong>${key["llegada"]}</strong></td>
                    <td><strong>${key["tanda"]}</strong></td>
                    <td><strong>${key["desde"]} - ${key["hasta"]}</strong></td>
                  </tr>
                `;
      });

      html += `<tr style="background-color:#6F747E; color:#FFFF">
                <th colspan="3">Tiempo total del servicio</th>
                <th colspan="3">${Math.round(tiempoServicio / 60, 2)} Horas</th>
              </tr>`;

      $("#tablaFases").empty();
      $("#tablaFases").html(html);

      // console.log(html);
    }

    function generarTablaEventos(arreglo) {
      let html = `
                <thead style="background-color:#6F747E; color:#FFFF">
                  <tr>
                    <th colspan="8"><h3 class="text-center">INFORMACION DE LOS EVENTOS & CORRECCIONES</h3></th>
                  </tr>

                  <tr>
                    <th>#</th>
                    <th>Evento</th>
                    <th>%</th>
                    <th>Fase</th>
                    <th>Distribucion</th>
                    <th>Intervalo</th>
                    <th>Accion Correctiva</th>
                    <th>t. servicio</th>
                  <tr> 
                </thead>`;

      let probabilidad = 0;
      arreglo.forEach((key, index) => {
        probabilidad += parseFloat(key["probabilidad"]);
        html += `
                    <tr>
                    <td><strong>${index + 1}</strong></td>
                    <td><strong>${key["evento"]}</strong></td>
                    <td><strong>${key["probabilidad"]} %</strong></td>
                    <td><strong>${key["fase"]}</strong></td>
                    <td><strong>${key["distribucion"]}</strong></td>
                    <td><strong>${Math.round(key["desde"], 2)} - ${Math.round(
          key["hasta"],
          2
        )}</strong></td>
                    <td><strong>${key["accionCorrectiva"]}</strong></td>
                    <td><strong>${key["t_servicio"]}%</strong></td>

                  </tr>
                `;
      });

      $("#tablaEventos").empty();
      $("#tablaEventos").html(html);
      // console.log(html);
    }

    function generarTablaProcesamientoEventos(arreglo) {
      let html = `
                <thead style="background-color:#6F747E; color:#FFFF">
                  <tr>
                    <th colspan="6"><h3 class="text-center">INFORMACION FINAL DE LOS EVENTOS REGISTRADOS Y SUS CORRECCIONES</h3></th>
                  </tr>

                  <tr>
                    <th>numOrden</th>
                    <th>Fase</th>
                    <th>Evento</th>
                    <th>fecha</th>
                    <th>Inc. servicio</th>
                    <th>Accion Correctiva</th>
                  <tr> 
                </thead>`;

      arreglo.forEach((key, index) => {
        const fecha = new Date(key["fecha"]);
        html += `
                  <tr>
                    <td><strong>${key["numOrden"]}</strong></td>
                    <td><strong>${key["fase"]}</strong></td>
                    <td class="bg-danger"><strong>${key["evento"]}</strong></td>
                    <td><strong>${fecha.toLocaleString()}</strong></td>
                    <td><strong>${key["t_servicio"]}%</strong></td>
                    <td><strong>${key["accionCorrectiva"]}</strong></td>
                  </tr>
                `;
      });

      $("#tablaProcesadaEventos").empty();
      $("#tablaProcesadaEventos").html(html);
      // console.log(html);
    }

    function generarTablaProcesamientoProductos(arreglo) {
      let html = `
                <thead style="background-color:#6F747E; color:#FFFF">
                  <tr>
                    <th colspan="5"><h3 class="text-center">INFORMES DE LOS PRODUCTOS SELECCIONADOS DE LA SIMULACION</h3></th>
                  </tr>

                  <tr>
                    <th>#</th>
                    <th>producto</th>
                    <th>tanda</th>
                    <th>Fecha</th>
                    <th>Probabilidad</th>
                  <tr> 
                </thead>`;

      arreglo.forEach((key, index) => {
        const fecha = new Date(key["fecha"]);
        html += `
                  <tr>
                    <td><strong>${index+1}</strong></td>
                    <td><strong>${key["producto"]}</strong></td>
                    <td><strong>${key["tanda"]}</strong></td>
                    <td><strong>${fecha}</strong></td>
                    <td><strong>${key["probabilidad"]}%</strong></td>
                  </tr>
                `;
      });

      $("#tablaProcesadaProducto").empty();
      $("#tablaProcesadaProducto").html(html);
      // console.log(html);
    }
    function crearGrafico(clase, data) {
      $.plot(`#donut-chart-${clase}`, data, {
        series: {
          pie: {
            show: true,
            radius: 1,
            innerRadius: 0.5,
            label: {
              show: true,
              radius: 2 / 3,
              formatter: function (label, series) {
                return (
                  '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' +
                  label +
                  "<br/>" +
                  Math.round(series.percent) +
                  "%</div>"
                );
              },
              background: {
                opacity: 0.5,
                color: "#000",
              },
              threshold: 0.1,
            },
          },
        },
        legend: {
          show: false,
        },
      });
    }

    function generarConclusion(lambda, mew) {
      conclusion1 = 1-(lambda/mew);
      conclusion2 = Math.pow(lambda,2)/( mew * (mew - lambda));
      conclusion3 = lambda/(mew * (mew - lambda));
      conclusion4 = (lambda/mew);
      conclusion5 = 1 - (lambda/mew);
      conclusion5n = conclusion5*conclusion4;
      conclusion5n1 = conclusion5n*conclusion3;
      conclusion5n2 = 1 - conclusion5n1;
      $("#conclusion1").html(`<strong>${Math.round(conclusion1 * 100)}%</strong>`);
      $("#conclusion2").html(`<strong>${Math.round(conclusion2 * 100)}%</strong>`);
      $("#conclusion3").html(`<strong>${Math.round(conclusion3 )} horas </strong>`);
      $("#conclusion4").html(`<strong>${Math.round(conclusion4 * 100)}  </strong>`);
      $("#conclusion5").html(`<strong>${Math.round(conclusion5n2 * 100)}  </strong>`);
    }
  });