<?php

include("conexion.php");

$conexion = conectar();

if ($_POST['action'] == 'infoProducto') {
    $producto = $_POST['producto'];
    $query = mysqli_query($conexion, "select cod_productos, nombre, precio, stock from Producto where nombre = '$producto'");
    $resultado = mysqli_num_rows($query);
    if ($resultado > 0) {
        $datos = mysqli_fetch_assoc($query);
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
        exit;
    }
    echo 'error';
    exit;
}
if ($_POST['action'] == 'ProductoDetalle') {
    if (empty($_POST['producto']) || empty($_POST['cantidad'])) {
        echo 'error 1';
    } else {
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $rut = $_POST['rut'];
        $tot = 0;
        $desc=0;
        $num = 0;
        $querypro = mysqli_query($conexion, "select cod_productos, precio from Producto where nombre = '$producto'");
        $da = mysqli_fetch_assoc($querypro);

        $codigo = $da['cod_productos'];
        $pre = $da['precio'];
        $tot = round($cantidad * $da['precio'], 2);
        $q = mysqli_query($conexion, "select edad from Cliente where rut_cliente='$rut'");
        $dat = mysqli_fetch_assoc($q);
        $edad = $dat['edad'];
if ($edad >= 60) {
            $desc = 0.2;
        }
        $num = $desc * $tot;
        $queryin = "insert into temporal (codigo, producto,precio, cantidad,descuento, total,cliente) values ($codigo,'$producto',$pre,$cantidad,$num,$tot,'$rut')";
        mysqli_query($conexion, $queryin);
        $detalleTabla = '';
        $subtotal = 0;
        $descuento = 0;
        $total = 0;
        $arrayData = array();
        
        $edad = $dat['edad'];
        if ($edad >= 60) {
            $descuento = 0.2;
        }
        $query = mysqli_query($conexion, "select codigo, producto, precio, cantidad, total from temporal where cliente = '$rut'");
        $resultado = mysqli_num_rows($query);
        if ($resultado > 0) {
            while ($data = mysqli_fetch_assoc($query)) {
                $preciototal = round($data['cantidad'] * $data['precio'], 2);

                $subtotal = round($subtotal + $preciototal, 2);

                $detalleTabla .= '<tr>
                            <td>' . $data['codigo'] . '</td>
                            <td id="prod">' . $data['producto'] . '</td>
                            <td>' . $data['precio'] . '</td>
                            <td>' . $data['cantidad'] . '</td>
                            <td>' . $data['total'] . '</td>
                                </tr>';
            }
            $descuento = round($descuento * $subtotal, 2);
            $total = round($subtotal - $descuento, 2);

            $detalleTotales = '<tr>
                                    <td colspan="4">Subtotal</td>
                                    <td>' . $subtotal . '</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Descuento</td>
                                    <td>' . $descuento . '</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Total</td>
                                    <td id=totalv>' . $total . '</td>
                                </tr>
                                <tr>
                                 <td colspan="4">pago</td>
                                    <td><input type="text" name="Pago" class="Itexto" id="pago" placeholder="Ingrese monto"></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Vuelto</td>
                                    <td id="vuelto">0</td>
                                </tr>
                                    ';
            $arrayData['detalle'] = $detalleTabla;
            $arrayData['totales'] = $detalleTotales;
            echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
        } else {
            echo 'error';
        }
        exit;
    }
}

if ($_POST['action'] == 'verificarCliente') {

    $rut = $_POST['rut'];
    echo $rut;
    $query = mysqli_query($conexion, "select nombre from Cliente where rut_cliente='$rut'");

    $resultado = mysqli_num_rows($query);
    if ($resultado > 0) {
        $datos = mysqli_fetch_assoc($query);
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
        echo $datos['nombre'];
        exit;
    }
    echo 'cliente no registrado';
    exit;
}
if ($_POST['action'] == 'CancelarVenta') {
    $rut = $_POST['rut'];
    if (empty($_POST['rut'])) {
        echo 'error';
    } else {
        $query_eliminar = "delete from temporal where cliente='$rut'";
        mysqli_query($conexion, $query_eliminar);

        echo 'venta cancelada';
        exit;
    }
}
if ($_POST['action'] == 'registrarventa') {
    $rut = $_POST['rut'];
    $producto = $_POST['producto'];
    $filas = $_POST['filas'];
    $pago = $_POST['pago'];
    $vuelto = $_POST['vuelto'];
    $arrayData = array();
    $preciototal = 0;
    $subtotal = 0;
    $cantidad = 0;
    $det = 0;
    $descuento = 0;
    $num = 0;
    $num2 = 0;
    $detalleTabla = '';
    $query = mysqli_query($conexion, "select codigo, producto, precio, cantidad,descuento, total from temporal where cliente = '$rut'");
    $resultado = mysqli_num_rows($query);
    if ($resultado > 0) {
        while ($data = mysqli_fetch_assoc($query)) {

$num = round($num+$data['descuento']);
            $preciototal = round($data['cantidad'] * $data['precio'], 2);
            $subtotal = round($subtotal + $preciototal, 2);
            $cantidad = round($data['cantidad'] + $cantidad, 2);
            $detalleTabla .= '<tr>
                            <td>' . $data['codigo'] . '</td>
                            <td id="prod">' . $data['producto'] . '</td>
                            <td>' . $data['precio'] . '</td>
                            <td>' . $data['cantidad'] . '</td>
                            <td>' . $data['total'] . '</td>
                                </tr>';
        }
        $descuento = round($descuento * $subtotal, 2);
        $total = round($subtotal - $descuento, 2);
        $queryin = "insert into Venta (cant_productos, valor_total,descuento, rut_cliente) values ('$cantidad','$total','$num', '$rut')";
        mysqli_query($conexion, $queryin);
        $queryp = mysqli_query($conexion, "select producto,cantidad from temporal where cliente = '$rut'");

        $q = mysqli_query($conexion, "select max(cod_venta) as codigo from venta");
        $dat = mysqli_fetch_assoc($q);
        $max = $dat['codigo'];
        while ($datospro = mysqli_fetch_assoc($queryp)) {
            $prod = $datospro['producto'];
            $det = $det + 1;
            $cant = $datospro['cantidad'];
            $querypro = mysqli_query($conexion, "select cod_productos, stock from Producto where nombre = '$prod'");
            $dapro = mysqli_fetch_assoc($querypro);
            $pro = $dapro['cod_productos'];
            $stock = $dapro['stock'];
            $num2 = round($stock - $cant, 2);
            $query_update = "UPDATE producto SET stock=$num2 WHERE cod_productos = $pro ";
            mysqli_query($conexion, $query_update);
            $querydet = "insert into Detalle_venta (cod_venta, cod_detalle,cod_productos,rut_usuario) values ('$max','$det','$pro','19547125-8')";
            mysqli_query($conexion, $querydet);
        }
        $detalleTotales = '<tr>
                                    <td colspan="4">Subtotal</td>
                                    <td>' . $subtotal . '</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Descuento</td>
                                    <td>' . $num . '</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Total</td>
                                    <td id=totalv>' . $total . '</td>
                                </tr>
                                <tr>
                                 <td colspan="4">pago</td>
                                    <td>' . $pago . '</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Vuelto</td>
                                    <td id="vuelto">' . $vuelto . '</td>
                                </tr>
                                    ';
        $query_eliminar = "delete from temporal where cliente='$rut'";
        mysqli_query($conexion, $query_eliminar);
        $arrayData['det'] = $detalleTabla;
        $arrayData['tot'] = $detalleTotales;
        echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
    }
}

if ($_POST['action'] == 'ingresarentrega') {
    if (empty($_POST['producto'])) {
        echo 'error 1';
    } else {
        $producto = $_POST['producto'];
        $proveedor = $_POST['proveedor'];
        $arrayData = array();
        $detalleTabla = '';
        $querypro = mysqli_query($conexion, "select nombre from producto where nombre = '$producto'");
        $da = mysqli_fetch_assoc($querypro);
        $prod = $da['nombre'];
        $queryprov = mysqli_query($conexion, "select nombre from proveedor where nombre = '$proveedor'");
        $dat = mysqli_fetch_assoc($queryprov);
        $prov = $dat['nombre'];
        $queryin = "insert into entrega_temporal (proveedor, producto) values ('$prov', '$prod')";
        mysqli_query($conexion, $queryin);

        $querysel = mysqli_query($conexion, "select proveedor, producto from entrega_temporal where proveedor = '$prov'");
        $resultado = mysqli_num_rows($querysel);
        if ($resultado > 0) {
            while ($data = mysqli_fetch_assoc($querysel)) {
                $detalleTabla .= '<tr>
                            <td>' . $data['proveedor'] . '</td>
                            <td>' . $data['producto'] . '</td>
                                </tr>';
            }
            
            $arrayData['det'] = $detalleTabla;
            echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
        } else {
            echo 'error';
        }
        exit;
    }
}
if ($_POST['action'] == 'guardarentrega') {
    if (empty($_POST['proveedor'])) {
        echo 'error 1';
    } else {
        
        $proveedor = $_POST['proveedor'];
        $codigo = 0;
        $max = 0;
        $q = mysqli_query($conexion, "select max(cod_entrega) as codigo from Entrega");
        $dat = mysqli_fetch_assoc($q);
        $max = $dat['codigo'];
        $codigo = $max + 1;

        $queryp = mysqli_query($conexion, "select proveedor, producto from entrega_temporal where proveedor = '$proveedor'");
        while ($datospro = mysqli_fetch_assoc($queryp)) {
            $prod = $datospro['producto'];
            $prov = $datospro['proveedor'];

            $querypro = mysqli_query($conexion, "select cod_productos from Producto where nombre = '$prod'");
            $resultado = mysqli_num_rows($querypro);
            if ($resultado > 0) {
                $dapro = mysqli_fetch_assoc($querypro);
                $pro = $dapro['cod_productos'];

                $queryprov = mysqli_query($conexion, "select rut_pro from proveedor where nombre = '$prov'");
                $daprov = mysqli_fetch_assoc($queryprov);
                $prove = $daprov['rut_pro'];

                $querydet = "insert into entrega (cod_entrega, cod_productos, rut_pro) values ('$codigo','$pro','$prove')";
                mysqli_query($conexion, $querydet);
                $query_eliminar = "DELETE FROM entrega_temporal";
                mysqli_query($conexion, $query_eliminar);
            } else {
                echo'Sin producto';
            }
        }
    }
}

