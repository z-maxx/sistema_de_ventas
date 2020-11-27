<?php
  include("conexion.php");
  
$conexion = conectar();
$rut = $_GET ['rut'];
$nombre = $_GET ['nombre'];
$apellido = $_GET ['apellido'];
$edad = $_GET ['edad'];


$query="insert into cliente(rut_cliente,nombre,apellido,edad) values('$rut','$nombre','$apellido',$edad)";
mysqli_query($conexion, $query);
?>
<script>
    alert ("datos ingresados exitosamente");
  window.location.href="../clientes.php";
</script>
