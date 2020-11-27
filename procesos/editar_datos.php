<?php
include("conexion.php");

$conexion = conectar();
$rut = $_GET ['rut2'];
$nombre = $_GET ['nombre2'];
$apellido = $_GET ['apellido2'];
$nom_usu = $_GET ['nomusu2'];
$pass = $_GET ['pass2'];
$usuario = $_GET ['usuario2'];
$query_update ="update usuario SET nombre='$nombre', apellido= '$apellido', nom_usuario='$nom_usu', pass='$pass',cod_tipo_u=$usuario WHERE rut_usuario='$rut'";
mysqli_query($conexion, $query_update);

?>
<script>
    alert ("datos editados exitosamente");
    window.location.href="../usuarios.php";
</script>
