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
          url: "datosGrafico.php?añoseleccionado="+añoseleccionado,
          data: cadena,
          success:function(respuesta){
            datos = JSON.parse(respuesta)
              grafico(datos[0], datos[1]);
            
          }
      }) 
  }
};



function grafico(meses, cantidad) {
  console.log(meses, cantidad)
  veces = meses.length;
  console.log (veces);
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })

  // Graphs
  var ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        meses[0],
        meses[1],
        meses[2],
        meses[3],
        meses[4],
        meses[5],
        meses[6],
        meses[7],
        meses[8],
        meses[9],
        meses[10],
        meses[11]
              
      ],
      datasets: [{
        data: [
        cantidad[0],
        cantidad[1],
        cantidad[2],
        cantidad[3],
        cantidad[4],
        cantidad[5],
        cantidad[6],
        cantidad[7],
        cantidad[8],
        cantidad[9],
        cantidad[10],
        cantidad[11],
        
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
