<?php
  include("conexion.php");
  
$conexion = conectar();
$nombre = $_GET ['nombre_i'];
$precio = $_GET ['precio_i'];
$stock = $_GET ['stock_i'];

           
            
$query="insert into producto(nombre,precio,stock,rut_usuario) values('$nombre','$precio','$stock','20458784-4')";
mysqli_query($conexion, $query);
?>
<script>
    alert ("datos ingresados exitosamente");
  window.location.href="../inventario.php";
</script>
