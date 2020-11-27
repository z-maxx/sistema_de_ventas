<html>
    <head>
        <meta charset="UTF-8">
        <?php include("scripts/scripts.php");?>
        <title>Proveedores</title>
    </head>
    <body>
        <?php include("scripts/header.php");?>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div id="frm1">
                    <form class="f" id="frm_proveedor" action="procesos/registrar_proveedores.php" method="get">
                        &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="lb">Rut:</label>    
                        <input type="text" name="rut_p" class="Itexto" id="rut_p" placeholder="Ingrese rut proveedor"> 
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <label class="lb">nombre:</label>     
                        <input type="text" name="nombre_p" class="Itexto" id="nombre_p" placeholder="Ingrese nombre proveedor">
                        <br/>
                        &nbsp;&nbsp;&nbsp;
                        <label class="lb">Correo:</label> 
                        <input type="text" name="correo_p" class="Itexto" id="correo" placeholder="Ingrese correo proveedor">   
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="lb">Telefono:</label> 
                        <input type="text" name="tel_p" class="Itexto" id="tel" placeholder="Ingrese numero de telefono">
                    </form>  
                    </div>
                    <div id="ocultar">
                        <form class="f" id="frm_editar" action="procesos/editar_proveedor.php" method="get">
                           &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="lb">Rut:</label>    
                        <input type="text" name="rut_2" class="Itexto" id="rut_p_o" readonly> 
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <label class="lb">nombre:</label>     
                        <input type="text" name="nombre_2" class="Itexto" id="nombre_p_o">
                        <br/>
                        &nbsp;&nbsp;&nbsp;
                        <label class="lb">Correo:</label> 
                        <input type="text" name="correo_2" class="Itexto" id="correo_o">   
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="lb">Telefono:</label> 
                        <input type="text" name="tel_2" class="Itexto" id="tel_o"> 
                        </form>
                    </div>
                    <form id="frm_eliminar" action="procesos/eliminar proveedor.php" method="get" >
                        <input type="hidden" name="id_oculto" id="id_eliminar" >
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <br/>
                    <?php
                    include("procesos/conexion.php");
                    $conexion = conectar();
                    $query = "SELECT rut_pro, nombre, correo, telefono FROM proveedor";
                    $resultado = mysqli_query($conexion, $query);
                    ?>
                    <table class="tabla" id="tabla_p">
                        <tr>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Telefono</th>     
                        </tr>
                        <?php
                        while ($datos = mysqli_fetch_assoc($resultado)) {
                            ?>                 
                            <tr onclick="ocultar()">
                                <td><?php echo $datos ['rut_pro']; ?></td>
                                <td><?php echo $datos ['nombre']; ?></td>
                                <td><?php echo $datos ['correo']; ?></td>
                                <td><?php echo $datos ['telefono']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>    
                    </table>
                </div>
                <div class="col-sm-2">
                    <br/><br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" form="frm_proveedor" class="boton" id="agregar_p">Agregar</button>
                    <br/>
                    <br/>
                    <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" form="frm_editar" class="boton" onclick="ocultar()" id="editar_proveedor">Modificar</button>
                    <br/>
                    <br/>
                    <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" form="frm_eliminar" class="boton" id="eliminar_producto">Eliminar</button>  
                </div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        $('#agregar_p').click(function () {

            vacios = validarFormVacio('frm_proveedor');
            if (vacios > 0) {
                alert("Debe llenar todos los campos");
                return false;
            }
            datos = $('#frm_proveedor').serialize();
            $.ajax({
                type: "get",
                data: datos,
                url: "procesos/registrar_proveedores.php",
                success: function (r) {
                }
            });
        });
        $('#editar_proveedor').click(function () {

            vacios = validarFormVacio('frm_editar');
            if (vacios > 0) {
                alert("Debe llenar todos los campos");
                return false;
            }
            datos = $('#frm_editar').serialize();
            $.ajax({
                type: "get",
                data: datos,
                url: "procesos/editar_proveedor.php",
                success: function (r) {
                }
            });
        });
     $("#ocultar").hide();
    $('#tabla_p tr').on('click', function(){
        var dato1 = $(this).find('td:first').html();
        var dato2 = $(this).find('td:nth-child(2)').html();
        var dato3 = $(this).find('td:nth-child(3)').html();
        var dato4 = $(this).find('td:nth-child(4)').html();
        $('#rut_p_o').val(dato1);
        $('#nombre_p_o').val(dato2);
        $('#correo_o').val(dato3);
        $('#tel_o').val(dato4);

        $('#id_eliminar').val(dato1);
       
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