
    
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
          $('#UpdatetipoCategoria option[id="'+datos[1]+'"]').attr("selected", true);
          
          console.log(datos[1]);

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