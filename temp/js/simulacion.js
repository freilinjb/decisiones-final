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

class Simulacion {
  constructor(tiempoServicio, tiempoLlegada, canal) {
    this.tiempoServicio = tiempoServicio;
    this.tiempoLlegada = tiempoLlegada;
    this.canal = canal;
    this.distribucion;
  }

  hablar() {
    return this.tiempoLlegada;
  }
}

console.log(Binomial(100,4,6));
const fecha1 = new Date('2014-03-09 04:59:00');
const fecha2 = new Date();
console.log(fecha1.getHours());
console.log(fecha2.getHours());
console.log(Binomial(7,0.25,3));

const prueba = new Simulacion("Hola mundo", "Hola llego");
console.log(prueba.hablar());
