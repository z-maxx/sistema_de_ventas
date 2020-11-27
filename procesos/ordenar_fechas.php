<?php
include("conexion.php");
?><html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../css/fondo_2.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-3.5.1.min.js" type="text/javascript"></script>
        <link href="../css/administracion.css" rel="stylesheet" type="text/css"/>
        <script src="../js/validar.js" type="text/javascript"></script>
        <title>Ventas</title>
    </head>
    <body>
        
        <?php include("../scripts/header.php");?>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <?php
                    $busqueda = strtolower($_REQUEST['fecha']);
                    if(empty($busqueda)){
                        header("location: ../ventas.php");
                    }
                    ?>
                    <form class="f" id="frm_f" action="../ventas.php" method="get">
                        <div class="margen">
                            <label>Fecha:</label>   
                            <input type="date" class="fec" id="fecha" name="fecha"
                                   value="2020-11-27"
                                   min="2020-01-01" max="2040-12-31">
                            <input type="submit" value="Ordenar" class="boton" onclick='loadfecha()'> 
                            <p></p>
                        </div>
                    </form > 

                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                   
                        <?php
                        
                        $conexion = conectar();
                        $query = "select fecha,descuento,cant_productos, valor_total from venta where fecha='$busqueda'";
                        $resultado = mysqli_query($conexion, $query);
                        ?>
                        <table class="tabla" id="tabla_venta">
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Descuento</th>
                                <th>Cantidad vendida</th>
                                <th>Total venta</th>
                            </tr>
                            </thead>
                            <?php
                            while ($datos = mysqli_fetch_assoc($resultado)) {
                                ?> 
                            <tbody>
                                <tr>
                                    <td><?php echo $datos ['fecha']; ?></td>
                                    <td><?php echo $datos ['descuento']; ?></td>
                                    <td><?php echo $datos ['cant_productos']; ?></td>
                                    <td><?php echo $datos ['valor_total']; ?></td>
                                </tr>
                            </tbody>
                                <?php
                            }
                            ?>    
                        </table> 
                   
                </div>
                <div class="col-sm-4">
                    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                    <button type="button" class="boton" onclick="existen_registros(tabla_venta)">Calcular</button>
                    <br/>
                    <br/>
                    <input type="text" name="total" class="Itexto" id="calcular" readonly>
                    <br/>
                    <br/>
                    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                    <button type="button" class="boton">Volver</button>   
                </div>
            </div>

            </div>

    </body>
 </html>   
<script type="text/javascript">
function existen_registros (tabla) {
  var suma = 0;
<?php
$q = "select valor_total from venta where fecha='$busqueda'";
$res = mysqli_query($conexion, $q);
while ($datos = mysqli_fetch_assoc($res)) {
    ?>
       var tot =<?php echo $datos ['valor_total']; ?>  
       suma +=parseFloat(tot);
 <?php
}
?>
 $('#calcular').val(suma);       
}
</script>
