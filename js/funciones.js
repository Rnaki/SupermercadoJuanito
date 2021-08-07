
    
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
          $('#updateDireccionDespacho').val(datos[13]);
          $('#updateNombreUsuario').val(datos[14]);
         
          
         
          
         
          
          console.log(datos[13]);

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

   function devolverProducto(idProducto){
      $('#devolverProducEmployeeModal').modal('show');
      cadena= {
         "idProducto": idProducto,
         };
      $('#devolProducto').click(function() {
         $.ajax({
            type: "POST",
            url: "devolverProducto.php",
            data: cadena,
            success:function(){
               location.reload();
               $('#devolverProducEmployeeModal').modal('hide');
            }
         }) 
      } );
   }

function mostrarUpdateTrabajador(rut_trabajador){
   for (z=0; z<=6; z++){
      $('#accesoEdit'+z).prop('checked', false);
      console.log(z);
    }

   cadena= {
      "rut_trabajador": rut_trabajador,
  };
  $.ajax({
      type: "POST",
      url: "mostrarUpdateTrabajador.php",
      data: cadena,
      success:function(info){
          datos = JSON.parse(info)
          $('#editRut').val(datos[0])
          $('#editRut2').val(datos[0]);
          $('#editNombre').val(datos[1]);
          $('#editApellidoP').val(datos[2]);
          $('#editApellidoM').val(datos[3]);
          $('#editRegion').val(datos[8]);
          $('#editComuna').val(datos[9])
          $('#editCalle').val(datos[10]);
          $('#editNCalle').val(datos[11]);
          $('#editFechaNacimiento').val(datos[4]);
          $('#editSexo option[id="'+datos[5]+'"]').attr("selected", true);
          $('#editSexo').val(datos[5]);
          $('#editContraseña').val(datos[12]);
          $('#editCorreo').val(datos[6])
          $('#editTelefono').val(datos[7]);
          $('#editCargo').val(datos[13]);
          for (z=0; z<=datos[16]; z++){
            $('#accesoEdit'+datos[14][z]).prop('checked', true);
            console.log(datos[14][z]);
          }


      }
  }) 
}


function mostrarUpdateSucursal(id_sucursal){
   console.log(id_sucursal);
   cadena= {
      "id_sucursal": id_sucursal,
  };
  $.ajax({
      type: "POST",
      url: "mostrarUpdateSucursal.php",
      data: cadena,
      success:function(info){
         datos = JSON.parse(info)
         $('#updateIdSucursal').val(datos[0])
         $('#updateIdSucursal2').val(datos[0])
         $('#updateIdBodega').val(datos[1]);
         $('#updateIdBodega2').val(datos[1]);
         $('#updateRegionSucursal').val(datos[2]);
         $('#updateRegionSucursal2').val(datos[2]);
         $('#updateComunaSucursal').val(datos[3]);
         $('#updateComunaSucursal2').val(datos[3]);
         $('#updateCalleSucursal').val(datos[4]);
         $('#updateNumeroCalleSucursal').val(datos[5]);
         $('#updateFonoSucursal').val(datos[6]);
         $('#updateNombreSucursal').val(datos[7]);
         $('#updateCantidadTrabajadores').val(datos[8]);
         console.log(datos[0]);
      }
   }) 
}

function eliminarSucursal(id_sucursal){
   $('#eliminarexampleModal').modal('show');
   cadena= {
      "id_sucursal": id_sucursal,
      };
   $('#eliminarSucursal').click(function() {
      $.ajax({
         type: "POST",
         url: "eliminarSucursal.php",
         data: cadena,
         success:function(){
            location.reload();
            $('#eliminarexampleModal').modal('hide');
         }
      }) 
   } );
}

function mostrarUpdateBodega(id_bodega){

   console.log(id_bodega);
   cadena= {
      "id_bodega": id_bodega,
  };
  $.ajax({
      type: "POST",
      url: "mostrarUpdateBodega.php",
      data: cadena,
      success:function(info){
         datos = JSON.parse(info)
         $('#updateIdBodega').val(datos[0]);
         $('#updateIdBodega2').val(datos[0])
         $('#updateAlmacenamiento').val(datos[1]);
         $('#updateRegionBodega').val(datos[2]);
         $('#updateRegionBodega2').val(datos[2]);
         $('#updateComunaBodega').val(datos[3]);
         $('#updateComunaBodega2').val(datos[3]);
         $('#updateCalleBodega').val(datos[4]);
         $('#updateNumeroCalleBodega').val(datos[5]);
         console.log(datos[0]);
      }
   }) 
}


function eliminarBodega(id_bodega){
   $('#eliminarexampleModal').modal('show');
   cadena= {
      "id_bodega": id_bodega,
      };
   $('#eliminarBodega').click(function() {
      $.ajax({
         type: "POST",
         url: "eliminarBodega.php",
         data: cadena,
         success:function(){
            location.reload();
            $('#eliminarexampleModal').modal('hide');
         }
      }) 
   } );
}

function verificarStockSu(){
   var n1 = Number(document.getElementById('envioStockSucursal').value);
   var n2 = Number(document.getElementById('stock').value);
   n1 = n1 - n2;
   if (n1 < 0){
      $('#actualStock1').addClass('rojoError');
      alert("Stocks insuficientes");
      return false;
      }
   else {
      $('#actualStock1').removeClass('rojoError');
      $('#actualStock1').addClass('verdeSuccess');
      return true;
   }
}

function verificarStockBo(){
   var n1 = Number(document.getElementById('actualStock').value);
   var n2 = Number(document.getElementById('stock').value);
    n1 = n1 - n2;
   if (n1 < 0){
      $('#actualStock1').addClass('rojoError');
      alert("Stocks insuficientes");
      return false;
      }
   else {
      $('#actualStock1').removeClass('rojoError');
      $('#actualStock1').addClass('verdeSuccess');
      return true;
   }
}

function mostrarEnvioSucursal(idProducto,idSucursal){
   cadena= {
      "idProducto": idProducto,
      "idSucursal": idSucursal,
  };
  $.ajax({
      type: "POST",
      url: "mostrarEnvioSucursal.php",
      data: cadena,
      success:function(info){
          datos = JSON.parse(info)
          $('.envioIdProducto').val(datos[0])
          $('#envioNombreProducto').val(datos[1]);
          $('#envioStockSucursal').val(datos[2]);
          console.log(datos[0]);//importante print
          console.log(datos[1]);
          console.log(datos[2]);
      }
  }) 
}

function devolverProveedor(rutProveedor){

   $('#devolverProveeEmployeeModal').modal('show');

   cadena= {
      "rutProveedor": rutProveedor,
      };
   $('#devolProveedor').click(function() {
      $.ajax({
         type: "POST",
         url: "devolverProveedor.php",
         data: cadena,
         success:function(){
            location.reload();
            $('#devolverProveeEmployeeModal').modal('hide');
         }
      }) 
   } );

}

function mostrarUpdateTransporte(patente){

   cadena= {
      "patente": patente,
  };
  $.ajax({
      type: "POST",
      url: "mostrarUpdateTransporte.php",
      data: cadena,
      success:function(info){
          datos = JSON.parse(info)
          $('.updatePatente').val(datos[0])
          $('#updateTipoTransporte').val(datos[1]);
          $('#updateIdSucursal').val(datos[2]);
          console.log(datos[0]);//importante print
          console.log(datos[1]);
          console.log(datos[2]);
      }
  }) 
}

function eliminarTransporte(patente){

   $('#eliminarexampleModal').modal('show');
   cadena= {
      "patente": patente,
      };
   $('#eliminarTransporte').click(function() {
      $.ajax({
         type: "POST",
         url: "eliminarTransporte.php",
         data: cadena,
         success:function(){
            location.reload();
            $('#eliminarexampleModal').modal('hide');
         }
      }) 
   } );
}

function mostrarEliminarTrabajador(rut_persona){
   console.log(rut_persona);
   cadena= {
      "rut_persona": rut_persona,
  };
  $.ajax({
      type: "POST",
      url: "mostrarEliminarTrabajador.php",
      data: cadena,
      success:function(info){
          datos = JSON.parse(info)
          $('#eliminarRutTrabajador').val(datos[0])
          $('#EliminarNombreTrabajador').text(datos[0]+" "+datos[1]+" "+datos[2]+" "+datos[3])

      }
  }) 
}

function eliminarTrabajador(){
   rut_persona = $('#eliminarRutTrabajador').val();
   console.log(rut_persona);
   cadena= {
      "rut_persona": rut_persona,
  };
  $.ajax({
      type: "POST",
      url: "eliminarTrabajador.php",
      data: cadena,
      success:function(){
        location.reload();
          
      }
  }) 
}

function decrementar(id_producto){
   if($('#'+id_producto).val()>=2){
   $('#'+id_producto).val(function(i, oldval) {
      return --oldval;
  });
  }

}

function incrementar(id_producto){
   $('#'+id_producto).val(function(i, oldval) {
      return ++oldval;
  });
}

function añadircarrito(id_producto){
   cantidad = $('#'+id_producto).val();
   id_productoAñadir = id_producto;
   cadena = {
      "id_producto": id_productoAñadir,
      "cantidad": cantidad,
   };
   console.log(cadena);
   $.ajax({
      type: "POST",
      url: "añadirCarrito.php",
      data: cadena,
      success:function(respuesta){
         if(respuesta == 1){
            alert("Producto Agregado Al Carrito");
         }else if (respuesta == 2){
            alert("Error El Producto ya se encuentra agregado.")
         }
      }
  }) 
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
          $('#updateNombreProveedor option[id="'+datos[8]+'"]').attr("selected", true);
          console.log(datos[8]);//importante print
      }
  }) 
}

function decrementarcarrito(id_producto){
   if($('#'+id_producto).val()>=2){
   $('#'+id_producto).val(function(i, oldval) {
      return --oldval;
  });
  
      idProducto = id_producto;
      cantidad = $('#'+id_producto).val();
      cadena= {
         "idProducto": idProducto,
         "cantidad": cantidad,
      };
      console.log(cadena);
      $.ajax({
         type: "POST",
         url: "updateCarrito.php",
         data: cadena,
         success:function(info){
            datos = JSON.parse(info)
            $('#subtotal'+id_producto).val(datos[0])
            $('#total0').val(datos[1])
            $('#subtotalCompra').text(datos[1]);
            totalCompra = parseInt(datos[1]) + parseInt($('#envio').val());
            $('.totalCompra').val(totalCompra);
         }
      })
   }
}

function incrementarcarrito(id_producto){
   $('#'+id_producto).val(function(i, oldval) {
      return ++oldval;
  });
  idProducto = id_producto;
      cantidad = $('#'+id_producto).val();
      cadena= {
         "idProducto": idProducto,
         "cantidad": cantidad,
      };
      console.log(cadena);
      $.ajax({
         type: "POST",
         url: "updateCarrito.php",
         data: cadena,
         success:function(info){
            datos = JSON.parse(info)
            $('#subtotal'+id_producto).val(datos[0]);
            $('#total0').val(datos[1])
            $('#subtotalCompra').text(datos[1])
            totalCompra = parseInt(datos[1]) + parseInt($('#envio').val());
            $('.totalCompra').val(totalCompra);
         }
      })
   }

function borrarCarrito(id_producto){
   idProducto = id_producto;
   cadena= {
      "idProducto": idProducto,
   };
   console.log(cadena);
   $.ajax({
      type: "POST",
      url: "borrarCarrito.php",
      data: cadena,
      success:function(info){
         datos = JSON.parse(info)
         location.reload();
      }
   })

}


function mostrarUpdateContrato(idContrato){
   cadena= {
      "idContrato": idContrato,
  };
  $.ajax({
      type: "POST",
      url: "mostrarUpdateContrato.php",
      data: cadena,
      success:function(info){
          datos = JSON.parse(info)
          $('.updateIdContrato').val(datos[0])
          $('#updateNombreCompleto').val(datos[1]);
          $('#updateCargo').val(datos[2]);
          $('#updateSueldo').val(datos[3]);
          $('#updateFechaInicio').val(datos[4]);
          $('#updateFechaTermino').val(datos[5]);
          $('#updateEstado').val(datos[6]);
          $('#updateEstado option[id="'+datos[6]+'"]').attr("selected", true);
          console.log(datos[0]);//importante print
      }
  }) 
}

function eliminarContrato(idContrato){
   $('#eliminarexampleModal').modal('show');
   cadena= {
      "idContrato": idContrato,
      };
   $('#eliminarContrato').click(function() {
      $.ajax({
         type: "POST",
         url: "eliminarContrato.php",
         data: cadena,
         success:function(){
            location.reload();
            $('#eliminarexampleModal').modal('hide');
         }
      }) 
   } );
}

function TransbankPost(){
   direccion = $('#url').val();
   token_ws = $('#token_ws').val();
   cadena= {
      "token_ws": token_ws,
      };
   
      $.ajax({
         type: "POST",
         url: direccion,
         data: cadena,
         success:function(){
         }
      }) 
}
