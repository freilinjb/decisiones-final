  }
}
//--------------------------------------------
function BinomialAcu(n, p, k) {
  miForm = document.forms[1];
  n = parseInt(n);
  k = parseInt(k);
  miForm.pruebas.value = n;
  miForm.exitos.value = k;
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
    miForm.respuesta.value = vResp;
  } else {
    vResp = " � E R R O R ! ";
    miForm.respuesta.value = vResp;
  }
}