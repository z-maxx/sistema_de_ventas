<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/Style.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
        <script src="js/validar.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <title>Boleta</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <form class="f">

                        <table class="boleta">
                            <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                            <td>1</td>
                            <td>azucar</td>
                            <td>1000</td>
                            <td>1</td>
                            <td>1000</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">Subtotal</td>
                                    <td>1000</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Descuento</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Total</td>
                                    <td>1000</td>
                                </tr>
                                <tr>
                                    <td colspan="4">pago</td>
                                    <td><input type="text" name="Pago" class="Itexto" id="pago"></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Vuelto</td>
                                    <td>0</td>
                                </tr>   
                            </tfoot>
                        </table>
                    </form>           
                </div>
                <div class="col-sm-4">
                    <br/><br/><br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="boton">Imprimir</button> 
                    <br/>
                    <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="boton" id="calcular">Calcular</button> 
                    <br/>
                    <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="boton">Cancelar</button> 
                    <br/>
                    <br/>
                    <label class="text-dark">Cliente:</label>
                    <input type="text" name="Cliente" class="Itexto" readonly>
                    <br/>
                    <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="boton">Pagar</button> 
                    <br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="boton">Volver</button>         
                </div>
            </div>
        </div>
    </body>
</html>
<?php


