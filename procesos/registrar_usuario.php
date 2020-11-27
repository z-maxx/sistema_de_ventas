<?php
  include("conexion.php");
  
$conexion = conectar();
$rut = $_GET ['rut'];
$nombre = $_GET ['nombre'];
$apellido = $_GET ['apellido'];
$nom_usu = $_GET ['nomusu'];
$pass = $_GET ['pass'];
$usuario = $_GET ['usuario'];


$query="insert into usuario(rut_usuario,nombre,apellido,nom_usuario,pass,cod_tipo_u) values('$rut','$nombre','$apellido','$nom_usu','$pass',$usuario)";
mysqli_query($conexion, $query);
?>
<script>
    alert ("datos ingresados exitosamente");
  window.location.href="../usuarios.php";
</script>

