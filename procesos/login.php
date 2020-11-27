<?php
  include("conexion.php");
  
$conexion = conectar();
$nombre = $_GET ['nombre'];
$pass = $_GET ['pass'];
$query = "select cod_tipo_u from Usuario where upper (nom_usuario) ='$nombre' and pass ='$pass'";
$resultado = mysqli_query($conexion, $query);
while ($datos = mysqli_fetch_assoc($resultado)) {
                            ?> 

<?php
$codigo = $datos ['cod_tipo_u'];
}
if($codigo==2){
    ?>

    <script>
    alert ("datos correctos ingresando a venta");
  window.location.href="../venta.php";
</script>
<?php
}if($codigo==1){
    ?>
    <script>
    alert ("datos correctos ingresando a administración");
  window.location.href="../administrador.php";
</script>
<?php
}else{
    ?>

   <script>
    alert ("datos incorrectos, usuario no registrado");
  window.location.href="../index.php";
</script> 
<?php
}
