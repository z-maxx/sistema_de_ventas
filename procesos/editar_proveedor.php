<?php
include("conexion.php");

$conexion = conectar();
$rut = $_GET ['rut_2'];
$nombre = $_GET ['nombre_2'];
$correo = $_GET ['correo_2'];
$tel = $_GET ['tel_2'];

$query_update ="update proveedor SET nombre='$nombre', correo= '$correo', telefono=$tel,rut_usuario='20458784-4' WHERE rut_pro=$rut";
mysqli_query($conexion, $query_update);

?>
<script>
    alert ("datos editados exitosamente");
    window.location.href="../proveedores.php";
</script>

