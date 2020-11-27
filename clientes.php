<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/Style.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/funciones.js" type="text/javascript"></script>
        <script src="js/validar.js" type="text/javascript"></script>
        <title>Clientes</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <br/><br/><br/><br/><br/>
                    <div id="frm1">
                        <form id="frm_cliente" action="procesos/registrar_cliente.php" method="get">
                        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                        <label class="lb">Rut:</label>
                        &nbsp;
                        <input type="text" name="rut" class="Itexto" id="rut_c" placeholder="Ingrese rut cliente">
                        <br/><br/>
                        <label class="lb">Nombre:</label> 
                        &nbsp; 
                        <input type="text" name="nombre" class="Itexto"  placeholder="Ingrese nombre cliente">
                        <br/><br/>
                        <label class="lb">Apellido:</label>
                        &nbsp;
                        <input type="text" name="apellido" class="Itexto" id="apellido_c" placeholder="Ingrese apellido cliente">
                        <br/><br/>
                        &nbsp; &nbsp;&nbsp; &nbsp; 
                        <label class="lb">Edad:</label>
                        &nbsp;
                        <input type="text" name="edad" class="Itexto" id="edad_c" placeholder="Ingrese edad cliente">
                    </form>
                        <form id="frm_buscar" action="procesos/busca_cliente.php" method="get">
                            <input type="hidden" name="rut_b" id="rut_oc">
                        </form>
                        <br/><br/>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;
                        &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;
                        <input type="submit" value="Agregar" class="boton" id="agregar_cl" form="frm_cliente">
                    </div>
                </div>
                <div class="col-sm-4"></div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <a href="venta.php" class="boton">Venta</a>        
                </div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('#agregar_cl').click(function(){
            vacios = validarFormVacio('frm_cliente');
            if (vacios > 0) {
                alert("Debe llenar todos los campos");
                return false;
            }
            datos = $('#frm_cliente').serialize();
            $.ajax({
                type: "get",
                data: datos,
                url: "procesos/registrar_cliente.php",
                success: function (r) {
                }
            });
        });
        });
</script>