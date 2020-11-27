<?php
include("conexion.php");
$cod = $_GET ['codigo_i'];
$conexion = conectar();
$nombre = $_GET ['nombre_i'];
$precio = $_GET ['precio_i'];
$stock = $_GET ['stock_i'];
 $querypro = mysqli_query($conexion, "select stock from Producto where nombre = '$nombre'");
            $dapro = mysqli_fetch_assoc($querypro);
            $st =$dapro['stock'];
            $num1 = intval($st);
            $num2 = intval($stock);
            $suma = ($num1 + $num2);
$query_update ="update producto SET nombre='$nombre', precio= $precio, stock=$suma,rut_usuario='20458784-4' WHERE cod_productos=$cod";
mysqli_query($conexion, $query_update);

?>
<script>
    alert ("datos editados exitosamente");
    window.location.href="../inventario.php";
</script>

