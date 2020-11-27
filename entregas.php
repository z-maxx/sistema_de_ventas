<html>
    <head>
        <meta charset="UTF-8">
<?php include("scripts/scripts.php");?>
        <title>Entregas</title>
    </head>
    <body>
        <?php include("scripts/header.php");?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4-md-1">
                    <form class="f"> 
                        <label class="lb">Proveedor:</label> &nbsp;
                        <input type="text" name="proveedor" class="Itexto" id="proveedor" placeholder="Ingrese nombre proveedor">
                        <p></p>
                        <label class="lb">Producto:</label> &nbsp;
                        <input type="text" name="producto" class="Itexto" id="producto" placeholder="Ingrese nombre producto">
                        <p></p>
                    </form >            
                </div> 
                <div class="col-sm-8">
                    <p></p><p></p>
                    <input type="button" value="Ingresar" class="boton" id="entrega">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <table class="tabla">
                        <thead>
                        <th>Proveedor</th>
                        <th>Producto</th>
                    </thead>
                    <tbody id="detalle_entrega">
                        
                    </tbody>
                    </table>       
                </div>
                <div class="col-sm-2">
                    <button type="button" class="boton" id="guardar">Guardar</button>
                </div>
            </div>
        </div>
    </body>

 <script type="text/javascript">
$(document).ready(function(){
   $('#entrega').click(function(e){
      e.preventDefault();
      var proveedor = $('#proveedor').val();
      var producto = $('#producto').val();
      var action = 'ingresarentrega';
      if(producto!==''){
       $.ajax({
          url: 'procesos/ajax.php',
          type: 'POST',
          async: true,
          data:{action:action,proveedor:proveedor,producto:producto},
      success: function(response){
                  if(response!=='error'){
                      var info = JSON.parse(response);
                      console.log(info);
                      $('#detalle_entrega').html(info.det);
$('#producto').val('');
                 
                  }
              },
              error: function(error){
                  
              }
            });   
      }else{
          alert("error verifique los datos");
      }
  });
    $('#guardar').click(function(e){
      e.preventDefault();
      var proveedor = $('#proveedor').val();
      var action = 'guardarentrega';
      if(proveedor!==''){
       $.ajax({
          url: 'procesos/ajax.php',
          type: 'POST',
          async: true,
          data:{action:action,proveedor:proveedor},
      success: function(response){
                  if(response!=='error'){
                      console.log(response);
$('#detalle_entrega').html('');
                 $('#producto').val('');
                 $('#proveedor').val('');
                  }
              },
              error: function(error){
                  alert("error verifique los datos");
              }
            });   
      }else{
          alert ("error no escribio el proveedor");
      }
  });
});
    </script>
</html>
<?php


