<?php
include("conexion.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../css/fondo_2.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-3.5.1.min.js" type="text/javascript"></script>
        <script src="../js/funciones.js" type="text/javascript"></script>
        <script src="../js/validar.js" type="text/javascript"></script>
        <title>Clientes</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <?php
                    $busqueda = strtolower($_REQUEST['rut_b']);
                    if (empty($busqueda)) {
                        header("location: ../clientes.php");
                    }
                    ?>
                    <?php
                    $conexion = conectar();
                    $query =mysqli_query($conexion,"select rut_cliente,nombre,apellido, edad from cliente where rut_cliente='$busqueda'");
                    $resultado =mysqli_num_rows ( $query);
                    if ($resultado>0) {
                        $datos = mysqli_fetch_assoc($query);
                    } else {
                        
                  header("location: ../clientes.php"); 
                  }
                    ?>
                    <br/><br/><br/><br/><br/>
                    <div id="frm1">
                        <form id="frm_cliente" action="procesos/busca_cliente.php" method="get">
                            &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                            <label class="lb">Rut:</label>
                            &nbsp;
                            <input type="text" name="rut" class="Itexto" id="rut_c" value='<?php echo $datos['rut_cliente'] ?>' readonly="">
                            <br/><br/>
                            <label class="lb">Nombre:</label> 
                            &nbsp; 
                            <input type="text" name="nombre" class="Itexto" id="nombre_c" value='<?php echo $datos['nombre'] ?>' readonly="">
                            <br/><br/>
                            <label class="lb">Apellido:</label>
                            &nbsp;
                            <input type="text" name="apellido" class="Itexto" id="apellido_c" value='<?php echo $datos['apellido'] ?>' readonly="">
                            <br/><br/>
                            &nbsp; &nbsp;&nbsp; &nbsp; 
                            <label class="lb">Edad:</label>
                            &nbsp;
                            <input type="text" name="edad" class="Itexto" id="edad_c" value='<?php echo $datos['edad'] ?>' readonly="">
                        </form>
                        <br/><br/>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                        <input type="submit" value="Buscar" form="frm_cliente" class="boton" id="buscar_rut">
                        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                        <input type="submit" value="Agregar" class="boton" id="agregar_c" form="frm_cliente">
                    </div>
                </div>
                <div class="col-sm-4"></div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <button type="button" class="boton">Volver</button>       
                </div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
    $('#agregar_c').click(function(){

    vacios = validarFormVacio('frm_cliente');
            if (vacios > 0){
    alert("Debe llenar todos los campos");
            return false;
    }
    datos = $('#frm_cliente').serialize();
            $.ajax({
            type:"get",
                    data:datos,
                    url:"procesos/registrar_cliente.php",
                    success:function(r){

                    }
            });
    });
            return false;
    });
    }
    );
