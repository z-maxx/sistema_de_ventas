<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<head>
    <meta charset="UTF-8">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="css/Style.css" rel="stylesheet" type="text/css"/>
    <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/funciones.js" type="text/javascript"></script>
    <title>Login</title>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <img src="images/logo.png" alt="" class="logo"/>  
            </div>
            <div class="col-sm-2"> 
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10">
                <br><br><br><br><br><br>
                <form  id="frmlogin" class="login" action="procesos/login.php" method="get">
                    <div class="login"> 
                        <label class="text-dark">Nombre de usuario:</label> 
                        <input type="text" id="nombre" name="nombre" class="Itexto" placeholder="Ingrese nombre de usuario">
                            <br/>
                            <label class="text-dark">Contraseña:</label> 
                                <input type="password" id="pass" name="pass" class="Itexto" placeholder="Ingrese contraseña">
                                <p></p>
                                <input type="submit" value="Ingresar" class="boton" id="btn_entrar">  
                    </div>     
                </form>     
            </div><div class="col-sm-1">
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function () {
        $('#btn_entrar').click(function () {
            vacios = validarFormVacio('frmlogin');
            if (vacios > 0) {
                alert("Debe llenar todos los campos");
                return false;
            }
            datos = $('#frmlogin').serialize();
            $.ajax({
                type: "get",
                data: datos,
                url: "procesos/login.php",
                success: function (r) {
                    if(r==1){
                        window.location="../administrador.php";
                    }if(r==2){
                        window.location="../venta.php";
                    }else{
                        alert("Datos incorrectos");
                    }
                }
            });
        });
    });
</script>
