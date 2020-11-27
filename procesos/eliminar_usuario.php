<?php

include("conexion.php");

$conexion = conectar();
$id_eliminar = $_GET ['id_oculto'];
$query_eliminar = "delete from usuario where rut_usuario ='$id_eliminar'";
mysqli_query($conexion, $query_eliminar);

?>
<script>
    alert ("datos eliminados exitosamente");
    window.location.href="../usuarios.php";
</script>