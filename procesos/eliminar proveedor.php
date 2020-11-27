<?php

include("conexion.php");

$conexion = conectar();
$id_eliminar = $_GET ['id_oculto'];
$query_eliminar = "delete from proveedor where rut_pro ='$id_eliminar'";
mysqli_query($conexion, $query_eliminar);

?>
<script>
    alert ("datos eliminados exitosamente");
    window.location.href="../proveedores.php";
</script>