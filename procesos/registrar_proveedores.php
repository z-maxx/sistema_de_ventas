<?php
  include("conexion.php");
  
$conexion = conectar();
$rut = $_GET ['rut_p'];
$nombre = $_GET ['nombre_p'];
$correo = $_GET ['correo_p'];
$tel = $_GET ['tel_p'];


$query="insert into proveedor(rut_pro,nombre,correo,telefono,rut_usuario) values('$rut', '$nombre', '$correo',$tel,'20458784-4')";
mysqli_query($conexion, $query);
?>
<script>
    alert ("datos ingresados exitosamente");
  window.location.href="../proveedores.php";
</script>
