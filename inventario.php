<html>
    <head>
        <meta charset="UTF-8">
       <?php include("scripts/scripts.php");?>
        <title>Inventario</title>
    </head>
    <body>
        <?php include("scripts/header.php");?>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div id="frm_i">
                    <form class="f" id="frm_inventario" action="procesos/registrar_producto.php" method="get">
                        &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="lb">Codigo:</label>    
                        <input type="text" name="codigo_i" class="Itexto" id="cod_i" readonly placeholder="Codigo automatico"> 
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        <label class="lb">Precio:</label>     
                        <input type="text" name="precio_i" class="Itexto" id="precio_i" placeholder="Ingrese precio producto">
                        <br/>
                        &nbsp;&nbsp;&nbsp;
                        <label class="lb">Nombre:</label> 
                        <input type="text" name="nombre_i" class="Itexto" id="nombre_i" placeholder="Ingrese nombre producto">   
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="lb">Stock:</label> 
                        <input type="text" name="stock_i" class="Itexto" id="stock_i" placeholder="Ingrese stock producto">
                    </form> 
                    </div>
                    <div id="ocultar_i">
                    <form class="f" id="frm_editar" action="procesos/editar_inventario.php" method="get">
                        
                         &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="lb">Codigo:</label>    
                        <input type="text" name="codigo_i" class="Itexto" id="cod_o" readonly > 
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        <label class="lb">Precio:</label>     
                        <input type="text" name="precio_i" class="Itexto" id="precio_o">
                        <br/>
                        &nbsp;&nbsp;&nbsp;
                        <label class="lb">Nombre:</label> 
                        <input type="text" name="nombre_i" class="Itexto" id="nombre_o">   
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="lb">Stock:</label> 
                        <input type="text" name="stock_i" class="Itexto" id="stock_o">   
                        
                    </form>
                       </div> 
                    <form id="frm_eliminar" action="procesos/eliminar_inventario.php" method="get" >
                        <input type="hidden" name="id_oculto" id="id_eliminar" >
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                 
                    <?php
                    include("procesos/conexion.php");
                    $conexion = conectar();
                    $query = "SELECT cod_productos, nombre, precio, stock from producto";
                    $resultado = mysqli_query($conexion, $query);
                    ?>
                    <table class="tabla" id="tabla_i">
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                        </tr>
                        <?php
                        while ($datos = mysqli_fetch_assoc($resultado)) {
                            ?>    
                            <tr onclick="ocultar()">
                                <td><?php echo $datos ['cod_productos']; ?></td>
                                <td><?php echo $datos ['nombre']; ?></td>
                                <td><?php echo $datos ['precio']; ?></td>
                                <td><?php echo $datos ['stock']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>    
                    </table>       
                </div>
                <div class="col-sm-2">
                    <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" form="frm_inventario" class="boton" id="agregar_i">Agregar</button>                   
                    <br/><br/><br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" form="frm_editar" class="boton" onclick="ocultar()" id="editar_producto">Modificar</button>
                    <br/><br/><br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" form="frm_eliminar" class="boton" id="eliminar_producto">Eliminar</button>   
                </div>
            </div>
        </div>
    </body>

<script type="text/javascript">
    $(document).ready(function () {
        
    $("#ocultar_i").hide();
    $('#tabla_i tr').on('click', function(){
        var dato1 = $(this).find('td:first').html();
        var dato2 = $(this).find('td:nth-child(2)').html();
        var dato3 = $(this).find('td:nth-child(3)').html();
        var dato4 = $(this).find('td:nth-child(4)').html();
        $('#cod_o').val(dato1);
        $('#nombre_o').val(dato2);
        $('#precio_o').val(dato3);
        $('#stock_o').val(dato4);

        $('#id_eliminar').val(dato1);
       
});  
            
    });
    function ocultar() {
    var x = document.getElementById("ocultar_i");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
    var a = document.getElementById("frm_i");
    if (a.style.display === "none") {
        a.style.display = "block";
    } else {
        a.style.display = "none";
    }
}

</script>
</html>