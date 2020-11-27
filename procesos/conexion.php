<?php
function conectar() {
    $server = "localhost";
    $usuario = "root";
    $password = "";
    $db = "bd_minimarket";
    $con = mysqli_connect($server, $usuario, $password) or die("ERROR AL CONECTAR" . mysql_error());
    mysqli_select_db($con,$db);
    
    return $con;
}

