/* globals Chart:false, feather:false */

function vistaPesos(){
  alert("hola");
}

function seleccionAño(seleccion){
  window.año = seleccion;
  console.log(window.año);
}

function generarDatos(){
  añoseleccionado = 2021;
  if(window.año == undefined){
    alert("Seleccione un año");
  }else{
    añoseleccionado = window.año;
    $('#tablaReporte').load('tablaReporte.php?añoseleccionado='+añoseleccionado);

    cadena= {
      
      };
    
      $.ajax({
          type: "POST",
          url: "tablaReporte.php",
          data: cadena,
          success:function(respuesta){
            
              grafico(respuesta);
            
          }
      }) 
  }
};



function grafico(test000) {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })

  // Graphs
  var ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre'
      ],
      datasets: [{
        data: [
          0,
          test000,
          18483,
          24003,
          23489,
          24092,
          12034
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      }
    }
  })
}
