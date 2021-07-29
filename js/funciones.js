
    
    function validarRut(){
        var Fn = {
            // Valida el rut con su cadena completa "XXXXXXXX-X"
            validaRut : function (rutCompleto) {
               if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
                  return false;
               var tmp 	= rutCompleto.split('-');
               var digv	= tmp[1]; 
               var rut 	= tmp[0];
               if ( digv == 'K' ) digv = 'k' ;
               return (Fn.dv(rut) == digv );
            },
            dv : function(T){
               var M=0,S=1;
               for(;T;T=Math.floor(T/10))
                  S=(S+T%10*(9-M++%6))%11;
               return S?S-1:'k';
            }
         }
         rut = $('#rutAgregar').val();
         
      //alert( Fn.validaRut(valor_rut_login) ? 'RUT Valido' : 'RUT inválido');    
      if (Fn.validaRut(rut) == false){
            $('#rutAgregar').addClass('rojoError');
            alert("Rut No Valido");
            return false;
            }
      else {
         $('#rutAgregar').removeClass('rojoError');
         $('#rutAgregar').addClass('verdeSuccess');
         return true;
           }
    };


/*
$(document).ready(function(){
    
    $('#rutUsuario').on('input', function(){
        var Fn = {
            // Valida el rut con su cadena completa "XXXXXXXX-X"
            validaRut : function (rutCompleto) {
               if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
                  return false;
               var tmp 	= rutCompleto.split('-');
               var digv	= tmp[1]; 
               var rut 	= tmp[0];
               if ( digv == 'K' ) digv = 'k' ;
               return (Fn.dv(rut) == digv );
            },
            dv : function(T){
               var M=0,S=1;
               for(;T;T=Math.floor(T/10))
                  S=(S+T%10*(9-M++%6))%11;
               return S?S-1:'k';
            }
         }
         rut = $('#rutUsuario').val();
         pass = $('#passUsuario').val();
      //alert( Fn.validaRut(valor_rut_login) ? 'RUT Valido' : 'RUT inválido');    
      if (Fn.validaRut(rut) == false){
            $('#rutUsuario').addClass('error');
            return false;
            }
      else {
         $('#rutUsuario').removeClass('error');
         $('#rutUsuario').addClass('valid');
           }
    });
    $('#passUsuario').on('input', function(){
        pass = $('#passUsuario').val();
        if(pass == null || pass.length < 4  || /^\s+$/.test(pass)){
            $('#passUsuario').addClass('error');
            $('#passUsuario').removeClass('valid');
            
            }
        else if(pass.length >= 4){
            $('#passUsuario').removeClass('error');
            $('#passUsuario').addClass('valid');
           
        }

    })
});
*/

function mostrarUpdateProveedor(rutProveedor){
   cadena= {
      "rutProveedor": rutProveedor,
  };
  $.ajax({
      type: "POST",
      url: "mostrarUpdateProveedor.php",
      data: cadena,
      success:function(info){
          datos = JSON.parse(info)
          $('.updateRutProveedor').val(datos[0])
          $('#updateNombreProveedor').val(datos[1]);
          $('#updateTipoProveedor').val(datos[2]);
          $('#updateMarcaProveedor').val(datos[3]);
          $('#updateFonoProveedor').val(datos[4]);
      }
  }) 

}

function EliminarProveedor(rutProveedor){
   $('#eliminarexampleModal').modal('show');
   cadena= {
      "rutProveedor": rutProveedor,
      };
   $('#eliminarProveedor').click(function() {
      $.ajax({
         type: "POST",
         url: "EliminarProveedor.php",
         data: cadena,
         success:function(){
            location.reload();
            $('#eliminarexampleModal').modal('hide');
         }
      }) 
   } );

}

function mostrarUpdateProducto(idProducto){
   
   console.log(idProducto);
   cadena= {
      "idProducto": idProducto,
  };
  $.ajax({
      type: "POST",
      url: "mostrarUpdateProducto.php",
      data: cadena,
      success:function(info){
          datos = JSON.parse(info)
          $('.updateIdProducto').val(datos[0])
          $('#updateTipoCategoria').val(datos[1]);
          $('#updateNombreProducto').val(datos[2]);
          $('#updateMarca').val(datos[3]);
          $('#updatePrecio').val(datos[4]);
          $('#updateDescuento').val(datos[5]);
          $('#updateDescripcion').val(datos[6]);
          $('#UpdatetipoCategoria option[id="'+datos[1]+'"]').attr("selected", true);
          $('#updateNombreProveedor option[id="'+datos[9]+'"]').attr("selected", true);
          
          console.log(datos[8]);//importante print
      }
  }) 
}



function eliminarProducto(idProducto){

   $('#eliminarexampleModal').modal('show');

   cadena= {

      "idProducto": idProducto,

      };

   $('#eliminarProducto').click(function() {

      $.ajax({

         type: "POST",

         url: "eliminarProducto.php",

         data: cadena,

         success:function(){

            location.reload();

            $('#eliminarexampleModal').modal('hide');

         }

      }) 

   } );



}

function mostrarUpdateDespacho(idDespacho){
   
   console.log(idDespacho);
   cadena= {
      "idDespacho": idDespacho,
  };
  $.ajax({
      type: "POST",
      url: "mostrarUpdateDespacho.php",
      data: cadena,
      success:function(info){
          datos = JSON.parse(info)
          $('#updateIdDespacho').val(datos[0])
          $('#idUpdateDespacho').val(datos[0])
          $('#updateIdSucursal').val(datos[1]);
          $('#updatePatente').val(datos[2]);
          $('#updateInformacion').val(datos[3]);
          $('#updateFechaLimite').val(datos[4]);
          $('#updateFechaEntrega').val(datos[5]);
          $('#IdProcesoDespacho').val(datos[6]);
          $('#UpdateEstadoDespacho option[value="'+datos[6]+'"]').attr("selected", true);
          
          console.log(datos[6]);

      }
  }) 
}

function mostrarUpdateCliente(rut_persona){

   console.log(rut_persona);
   cadena= {
      "rut_persona": rut_persona,
  };
  $.ajax({
      type: "POST",
      url: "mostrarUpdateCliente.php",
      data: cadena,
      success:function(info){
          datos = JSON.parse(info)
          $('.updateRutCliente').val(datos[0])
          $('#updateNombreCliente').val(datos[1])
          $('#updateApellidoPCliente').val(datos[2]);
          $('#updateApellidoMCliente').val(datos[3]);
          $('#updateFechaNacimientoCliente').val(datos[4]);
          $('#updateSexoCliente option[id="'+datos[5]+'"]').attr("selected", true);
          $('#updateCorreoCliente').val(datos[6]);
          $('#updateTelefonoCliente').val(datos[7]);
          $('#updateRegionCliente').val(datos[8]);
          $('#updateComunaCliente').val(datos[9]);
          $('#updateCalleCliente').val(datos[10]);
          $('#updateNcalleCliente').val(datos[11]);
          $('#updateContraseñaCliente').val(datos[12]);
         
          
         
          
         
          
          console.log(datos[0]);

      }
  }) 

}

function mostrarEliminarCliente(rut_persona){
   console.log(rut_persona);
   cadena= {
      "rut_persona": rut_persona,
  };
  $.ajax({
      type: "POST",
      url: "mostrarEliminarCliente.php",
      data: cadena,
      success:function(info){
          datos = JSON.parse(info)
          $('#eliminarRutCliente').val(datos[0])
          $('#EliminarNombreCliente').text(datos[0]+" "+datos[1]+" "+datos[2]+" "+datos[3])

      }
  }) 
}

function eliminarCliente(){
   rut_persona = $('#eliminarRutCliente').val();
   console.log(rut_persona);
   cadena= {
      "rut_persona": rut_persona,
  };
  $.ajax({
      type: "POST",
      url: "eliminarCliente.php",
      data: cadena,
      success:function(){
         location.reload();
          
      }
  }) 
}

function mostrarUpdateInfoBodega(idProducto){
   cadena= {
      "idProducto": idProducto,
  };
  $.ajax({
      type: "POST",
      url: "mostrarUpdateInfoBodega.php",
      data: cadena,
      success:function(info){
          datos = JSON.parse(info)
          $('.updateIdProducto').val(datos[0])
          $('#updateNombreProducto').val(datos[1]);
          $('#UpdateIdCategoria').val(datos[2]);
          $('#updateMarca').val(datos[3]);
          $('#updateNombreCategoria').val(datos[4]);
          $('#updateStock').val(datos[5]);

          $('#NombreProducto').val(datos[6]);
          $('#actualStock').val(datos[7]);
          console.log(datos[4]);//importante print
          console.log(datos[1]);
      }
  }) 
}

function eliminarInfoBodega(idProducto){
   $('#eliminarexampleModal').modal('show');
   cadena= {
      "idProducto": idProducto,
      };
   $('#eliminarInfoBodega').click(function() {
      $.ajax({
         type: "POST",
         url: "eliminarInfoBodega.php",
         data: cadena,
         success:function(){
            location.reload();
            $('#eliminarexampleModal').modal('hide');
         }
      }) 
   } );

}

function verificarStock(){
   var n1 = Number(document.getElementById('actualStock').value);
   var n2 = Number(document.getElementById('stock').value);

   var n3 = n1 - n2;
//alert( Fn.validaRut(valor_rut_login) ? 'RUT Valido' : 'RUT inválido');    
if (n3 < 0){
      $('#actualStock').addClass('rojoError');
      alert("Stock insuficientes");
      return false;
      }
else {
   $('#actualStock').removeClass('rojoError');
   $('#actualStock').addClass('verdeSuccess');
   return true;
     }
};

function eliminarDespacho(idDespacho){
   $('#eliminarexampleModal').modal('show');
   cadena= {
      "idDespacho": idDespacho,
      };
   $('#eliminarDespacho').click(function() {
      $.ajax({
         type: "POST",
         url: "eliminarDespacho.php",
         data: cadena,
         success:function(){
            location.reload();
            $('#eliminarexampleModal').modal('hide');
         }
      }) 
   } );
}


function verificarMaxStockCam(){
   var n1 = Number(document.getElementById('totalStock').value);
   var n2 = Number(document.getElementById('updateStock').value);
   var n3 = Number(document.getElementById('actualStock1').value);
   var n4 = Number(document.getElementById('totalAlmecenamiento').value);
   var n5;
   if(n3 > n2){
      n5 = n3 - n2;
      n1 = n1 - n5;
   }else if(n3 < n2){
      n5 = n2 - n3;
      n1 = n1 + n5;
   }
   if (n4 < n1){
      $('#actualStock1').addClass('rojoError');
      alert("Sobrecarga de almacenamiento");
      return false;
      }
   else {
      $('#actualStock1').removeClass('rojoError');
      $('#actualStock1').addClass('verdeSuccess');
      return true;
     }
   };

   //Maximo Stock en ingresar
/*
function verificarMaxStockIn(){
   id_producto = $('#id_producto').children(":selected").attr("id");

   cadena= {
      "id_producto": id_producto,
      };
      console.log(cadena);
   
      $.ajax({
         type: "POST",
         url: "verificarId.php",
         data: cadena,
         success:function(respuesta){
            if (respuesta == 0){
               window.variable = 1;
               console.log("no encontro");
            }else if (respuesta == 1){
               console.log("encontro");
               var n1 = Number(document.getElementById('totalStock').value);
               var n2 = Number(document.getElementById('ingresarStock').value);
               var n4 = Number(document.getElementById('totalAlmecenamiento').value);
               n1 = n1 + n2;
               if (n4 < n1){
                  $('#actualStock1').addClass('rojoError');
                  alert("Sobrecarga de almacenamiento");
                  return false;
                  }
               else {
                  $('#actualStock1').removeClass('rojoError');
                  $('#actualStock1').addClass('verdeSuccess');
                  return true;
               }
            else if (Id == false){
               console.log ('retorno false');
               return false;
              
            }
            }
         }
      }) 
      
   }
   
*/
function verificarId(){
   
}

//Maximo Stock en ingresar

function verificarMaxStockIn(){

   var n1 = Number(document.getElementById('totalStock').value);

   var n2 = Number(document.getElementById('ingresarStock').value);

   var n4 = Number(document.getElementById('totalAlmecenamiento').value);

   

   n1 = n1 + n2;

   

   if (n4 < n1){

      $('#actualStock1').addClass('rojoError');

      alert("Sobrecarga de almacenamiento");

      return false;

      }

   else {

      $('#actualStock1').removeClass('rojoError');

      $('#actualStock1').addClass('verdeSuccess');

      return true;

     }

   };