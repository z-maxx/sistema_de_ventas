<html>
    <head>
        <meta charset="UTF-8">
       <?php include("scripts/scripts.php");?>
        <title>Usuarios</title>
    </head>
    <body>
        <?php include("scripts/header.php");?>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div id="frm1">
                    <form class="f" id="frm_usuario" action="procesos/registrar_usuario.php" method="get">
                        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="lb">Rut:</label>    
                        <input type="text" name="rut" class="Itexto" id="rut_u" placeholder="Ingrese rut usuario"> 
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        &nbsp;
                        <label class="lb">Apellido:</label>     
                        <input type="text" name="apellido" class="Itexto" id="apellido_u" placeholder="Ingrese apellido usuario">
                        &nbsp; &nbsp;
                        <label class="lb1">Contraseña:</label> 
                        <input type="text" name="pass" class="Itexto" id="contra_u" placeholder="Ingrese contraseña usuario">   
                        <p></p>
                        <label class="lb">Nombre:</label> 
                        <input type="text" name="nombre" class="Itexto" id="nom_u" placeholder="Ingrese nombre">
                        <label class="lb">Nombre de usuario:</label>  
                        <input type="text" name="nomusu" class="Itexto" id="nomusu" placeholder="Ingrese nombre de usuario">
                        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        <label class="lb1">Usuario:</label> 
                        <select name="usuario" class="Itexto" id="select">
                            <option value="0">--Seleccione un usuario--</option>
                            <option Value="1">Administrador</option>
                            <option value="2">Vendedor</option>
                        </select>
                        <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                    </form> 
                   </div>
                    <div id="ocultar">
                      
                    <form class="f" id="frm_editar" action="procesos/editar_datos.php" method="get">
                        
                        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="lb">Rut:</label>    
                        <input type="text" name="rut2" class="Itexto" id="rut_o" readonly> 
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        &nbsp;
                        <label class="lb">Apellido:</label>     
                        <input type="text" name="apellido2" class="Itexto" id="apellido_o">
                        &nbsp; &nbsp;
                        <label class="lb1">Contraseña:</label> 
                        <input type="text" name="pass2" class="Itexto" id="contra_o">   
                        <p></p>
                        <label class="lb">Nombre:</label> 
                        <input type="text" name="nombre2" class="Itexto" id="nom_o">
                        <label class="lb">Nombre de usuario:</label>  
                        <input type="text" name="nomusu2" class="Itexto" id="nomuso">
                        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        <label class="lb1">Usuario:</label> 
                        <select name="usuario2" class="Itexto" id="selecto">
                            <option value="0">--Seleccione un usuario--</option>
                            <option Value="1">Administrador</option>
                            <option value="2">Vendedor</option>
                        </select>    
                        <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          
                    </form>
                         </div>  
                    <form id="frm_eliminar" action="procesos/eliminar_usuario.php" method="get">
                        <input type="hidden" name="id_oculto" id="id_eliminar">
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <br/>
                    <?php
                    include("procesos/conexion.php");

                    $conexion = conectar();

                    $query = "select u.rut_usuario, u.nombre,u.apellido, u.nom_usuario, u.pass, t.nombre as usuario from Usuario u , Tipo_usuario t where u.cod_tipo_u = t.cod_tipo_u";
                    $resultado = mysqli_query($conexion, $query);
                    ?>
                    <table class="tabla" id="tabla_u">
                        <tr>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Nombre de usuario</th>
                        <th>Contraseña</th>
                        <th>Tipo de usuario</th>   
                        </tr>
                        <?php
                        while ($datos = mysqli_fetch_assoc($resultado)) {
                            ?>                       
                            <tr onclick="ocultar()">
                                <td><?php echo $datos ['rut_usuario']; ?></td>
                                <td><?php echo $datos ['nombre']; ?></td>
                                <td><?php echo $datos ['apellido']; ?></td>
                                <td><?php echo $datos ['nom_usuario']; ?></td>
                                <td><?php echo $datos ['pass']; ?></td>
                                <td><?php echo $datos ['usuario']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table> 
                </div>
                <div class="col-sm-2">
                    <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" form="frm_usuario" class="boton" id="agregar_u">Agregar</button>
                    <br/><br/><br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" form="frm_editar" onclick="ocultar()" class="boton" id="editar_usuario">Modificar</button>
                    <br/>
                    <br/>
                    <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" form="frm_eliminar" class="boton" id="eliminar_usuario">Eliminar</button>
                        
                </div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        $('#agregar_u').click(function () {
            vacios = validarFormVacio('frm_usuario');
            if (vacios > 0) {
                alert("Debe llenar todos los campos");
                return false;
            }
            datos = $('#frm_usuario').serialize();
            $.ajax({
                type: "get",
                data: datos,
                url: "procesos/registrar_usuario.php",
                success: function (r) {
                }
            });
        });
        $('#select').mouseout(function () {
            $(this).css("width", "244px");
        });
        $('#selecto').mouseout(function () {
            $(this).css("width", "244px");
        });
        $("#ocultar").hide();
        
        $('#tabla_u tr').on('click', function(){
        var dato1 = $(this).find('td:first').html();
        var dato2 = $(this).find('td:nth-child(2)').html();
        var dato3 = $(this).find('td:nth-child(3)').html();
        var dato4 = $(this).find('td:nth-child(4)').html();
        var dato5 = $(this).find('td:nth-child(5)').html();
        var dato6 = $(this).find('td:nth-child(6)').html();
        $('#rut_o').val(dato1);
        $('#nom_o').val(dato2);
        $('#apellido_o').val(dato3);
        $('#nomuso').val(dato4);
        $('#contra_o').val(dato5);
        if(dato6==="administrador"){
         $('#selecto').val("1");   
        }
        if(dato6==="vendedor"){
         $('#selecto').val("2");   
        }
        $('#id_eliminar').val(dato1);
        
});
$('#editar_usuario').click(function () {
            vacios = validarFormVacio('frm_editar');
            if (vacios > 0) {
                alert("Debe llenar todos los campos");
                return false;
            }
            datos = $('#frm_editar').serialize();
            $.ajax({
                type: "get",
                data: datos,
                url: "procesos/editar_datos.php",
                success: function (r) {
                    
                }
            });
        });
$('#eliminar_usuario').click(function () {
            vacios = validarFormVacio('frm_eliminar');
            if (vacios > 0) {
                alert("Debe llenar el campo rut para eliminar");
                return false;
            }
            datos = $('#frm_eliminar').serialize();
            $.ajax({
                type: "get",
                data: datos,
                url: "procesos/eliminar_usuario.php",
                success: function (r) {
                    
                }
            });
        });
        
    });
    function ocultar() {
    var x = document.getElementById("ocultar");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
    var a = document.getElementById("frm1");
    if (a.style.display === "none") {
        a.style.display = "block";
    } else {
        a.style.display = "none";
    }
}
</script>