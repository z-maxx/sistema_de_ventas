<?php

include("conexion.php");

$conexion = conectar();
$id_eliminar = $_GET ['id_oculto'];
$query_eliminar = "delete from producto where cod_productos ='$id_eliminar'";
mysqli_query($conexion, $query_eliminar);

?>
<script>
    alert ("datos eliminados exitosamente");
    window.location.href="../inventario.php";
</script>