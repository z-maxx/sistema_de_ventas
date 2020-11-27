<?php
include("procesos/conexion.php");
$conexion = conectar();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/Style.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
        <script src="js/validar.js" type="text/javascript"></script>
        <title>Venta</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4-md-1">
                    <form class="f" id="frm_buscarp" method="get">
                        <label class="lb">Buscar Producto:</label> 
                        <input type="text" name="Producto" class="Itexto" id="producto" placeholder="Ingrese producto">
                        <p></p>
                        <label class="lb">Cliente:</label>    
                        <input type="text" name="Cliente" class="Itexto" id="rut_c" placeholder="Ingrese rut cliente">
                        <input type="hidden" name="nombre" id="nombre" class="Itexto">
                    </form>            
                </div> 
                <div class="col-sm-8">
                    <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="clientes.php" class="boton">Ingresar clientes</a>  
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="index.php" class="boton">Login</a>  
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-10">

                    <table class="tabla" id="tabla_venta">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr> 
                        </thead>
                        <tbody>
                        <td id="cod">-</td>
                        <td id="pro">-</td>
                        <td id="pre">-</td>
                        <td id="st">-</td>
                        <td><input type="text" style="width: 50px" class="Itexto" id="cant" value="0" min="1" disabled></td>
                        <td id="total">-</td>
                        </tbody>
                    </table>
                    <br/>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="boton" id="ingresar" >Ingresar productos</button>


                </div>
            </div>
            <div class="row">
                <div class="col-sm-10" >
                    <div id="muestra">
                        <table class="tabla" id="tabla_detalle" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="detalle_venta">

                            </tbody>
                            <tfoot id="detalle_totales">

                            </tfoot>
                        </table>  
                        <table class="tabla" id="tabla2" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="detalle_venta2">

                            </tbody>
                            <tfoot id="detalle_totales2">

                            </tfoot>
                        </table> 
                    </div>

                </div>
                <div class="col-sm-2">
                    <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="boton" id="imprimir" onclick="ocultar()">Imprimir</button> 
                    <br/>
                    <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <button type="button" class="boton" id="calcular">Calcular</button> 
                    <br/>
                    <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="boton" id="cancelar">Cancelar</button> 
                </div>
            </div>

        </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#producto').keyup(function (e) {
                e.preventDefault();
                var producto = $(this).val();
                var action = 'infoProducto';
                if (producto !== '') {
                    $.ajax({
                        url: 'procesos/ajax.php',
                        type: 'POST',
                        async: true,
                        data: {action: action, producto: producto},
                        success: function (response) {
                            if (response !== 'error') {
                                var info = JSON.parse(response);
                                $('#cod').html(info.cod_productos);
                                $('#pro').html(info.nombre);
                                $('#pre').html(info.precio);
                                $('#st').html(info.stock);
                                $('#cant').val('1');
                                $('#total').html(info.precio);

                                $('#cant').removeAttr('disabled');
                                $('#producto').val('');
                            } else {
                                $('#cod').html('-');
                                $('#pro').html('-');
                                $('#pre').html('-');
                                $('#st').html('-');
                                $('#cant').val('0');
                                $('#cant').attr('disabled', 'disabled');
                                $('#total').html('-');
                            }
                        },
                        error: function (error) {

                        }

                    });
                }
            });
            $('#cant').keyup(function (e) {
                e.preventDefault();
                var total = $(this).val() * $('#pre').html();
                $('#total').html(total);

            });

            $('#ingresar').click(function (e) {
                e.preventDefault();
                if ($('#cant').val() > 0) {
                    var producto = $('#pro').html();
                    var cantidad = $('#cant').val();
                    var rut = $('#rut_c').val();
                    var action = 'ProductoDetalle';

                    $.ajax({
                        url: 'procesos/ajax.php',
                        type: "POST",
                        async: true,
                        data: {action: action, producto: producto, cantidad: cantidad, rut: rut},
                        success: function (response) {
                            if (response !== 'error') {
                                var info = JSON.parse(response);
                                console.log(info);
                                $('#detalle_venta').html(info.detalle);
                                $('#detalle_totales').html(info.totales);

                                $('#cod').html('-');
                                $('#pro').html('-');
                                $('#pre').html('-');
                                $('#st').html('-');
                                $('#cant').val('0');
                                $('#cant').attr('disabled', 'disabled');
                                $('#total').html('-');
                            }
                        },
                        error: function (error) {

                        }
                    });
                }
            });
            $('#rut_c').keyup(function (e) {
                e.preventDefault();
                var rut = $(this).val();
                var action = 'verificarCliente';
                if (rut !== '') {
                    $.ajax({
                        url: 'procesos/ajax.php',
                        type: 'POST',
                        async: true,
                        data: {action: action, rut: rut},
                        success: function (response) {

                            if (response !== 'error') {
                                console.log(response);
                            }
                        },
                        error: function (error) {

                        }

                    });
                }
            });

            $('#cancelar').click(function (e) {
                e.preventDefault();
                var rut = $('#rut_c').val();
                var action = 'CancelarVenta';
                if (rut !== '') {
                    $.ajax({
                        url: 'procesos/ajax.php',
                        type: 'POST',
                        async: true,
                        data: {action: action, rut: rut},
                        success: function (response) {
                            if (response !== 'error') {
                                alert(response);
                                $('#detalle_venta').html('');
                                $('#detalle_totales').html('');


                            }
                        },
                        error: function (error) {

                        }
                    });
                }
            });
            $('#calcular').click(function (e) {
                e.preventDefault();
                var pago = $('#pago').val();
                var total = $('#totalv').html();
                var vuelto = parseFloat(pago) - parseFloat(total);
                $('#vuelto').html(vuelto);
            });
            $('#imprimir').click(function (e) {
                e.preventDefault();
                var rut = $('#rut_c').val();
                var producto = $('#prod').html();
                var filas = $('#tabla_2 >tbody >tr').length;
                var pago = $('#pago').val();
                var vuelto = $('#vuelto').html();
                var action = 'registrarventa';
                if (pago !== '') {
                    $.ajax({
                        url: 'procesos/ajax.php',
                        type: 'POST',
                        async: true,
                        data: {action: action, rut: rut, filas: filas, producto: producto, pago: pago, vuelto: vuelto},
                        success: function (response) {
                            if (response !== 'error') {
                                var info = JSON.parse(response);
                                console.log(info);
                                $('#detalle_venta2').html(info.det);
                                $('#detalle_totales2').html(info.tot);
                                var printContents = document.getElementById('muestra').innerHTML;
                                w = window.open();
                                w.document.write(printContents);
                                w.document.close(); // necessary for IE >= 10
                                w.focus(); // necessary for IE >= 10
                                w.print();
                                w.close();
                                ocultar();
                                return true;
                                $('#detalle_venta2').html('');
                                $('#detalle_totales2').html('');
                               
                            }
                        },
                        error: function (error) {

                        }
                    });

                } else {
                    var x = document.getElementById("tabla2");
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    } else {
                        x.style.display = "none";
                    }
                    var a = document.getElementById("tabla_detalle");
                    if (a.style.display === "none") {
                        a.style.display = "block";
                    } else {
                        a.style.display = "none";
                    }
                    alert("debe ingresar un monto");
                }
                $('#detalle_venta').html('');
                                $('#detalle_totales').html('');

            });
            $("#tabla2").hide();
        });
        function ocultar() {
            var x = document.getElementById("tabla2");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
            var a = document.getElementById("tabla_detalle");
            if (a.style.display === "none") {
                a.style.display = "block";
            } else {
                a.style.display = "none";
            }
        }
    </script>
</html>


