$(document).ready(function(){
       $('#buscar').click(function(){
               
       if($('#producto').val()===""){
           alert("Debe ingresar el nombre del producto");
           return false;
}

    } );
    $('#agregar_i').click(function(){
               
       if($('#nombre_i').val()===""){
           alert("Debe ingresar el nombre del producto");
           return false;
}else if($('#precio_i').val()===""){
    alert("Debe ingresar el precio del producto");
    return false;
}else if($('#stock_i').val()===""){
    alert("Debe ingresar el stock del producto");
    return false;
}else{
    datos = $('#frm_inventario').serialize();
            $.ajax({
                type: "get",
                data: datos,
                url: "procesos/registrar_producto.php",
                success: function (r) {
                }
});
}
    });
    $('#editar_producto').click(function(){
               
       if($('#nombre_o').val()===""){
           alert("Debe ingresar el nombre del producto");
           return false;
}else if($('#precio_o').val()===""){
    alert("Debe ingresar el precio del producto");
    return false;
}else if($('#stock_o').val()===""){
    alert("Debe ingresar el stock del producto");
    return false;
}else{
    datos = $('#frm_editar').serialize();
            $.ajax({
                type: "get",
                data: datos,
                url: "procesos/editar_producto.php",
                success: function (r) {
                }
});
}
    });
    $('#eliminar_producto').click(function(){
               
if($('#cod_o').val()===""){
    alert("Debe seleccionar un producto");
    return false;
}else{
    datos = $('#frm_editar').serialize();
            $.ajax({
                type: "get",
                data: datos,
                url: "procesos/eliminar_producto.php",
                success: function (r) {
                }
});
}
    });
    
    $('#eliminar_usuario').click(function(){
               
if($('#rut_o').val()===""){
    alert("Debe seleccionar un usuario");
    return false;
}else{
    datos = $('#frm_eliminar').serialize();
            $.ajax({
                type: "get",
                data: datos,
                url: "procesos/eliminar_usuario.php",
                success: function (r) {
                }
});
}
    });
    
    $('#buscar_rut').click(function(){
               
       if($('#rut_c').val()===""){
           alert("Debe ingresar el rut del cliente");
}
    } );
   $('#calcular').click(function(){
               
       if($('#pago').val()===""){
           alert("Debe ingresar el pago");
           return false;
}
    } );
    
    
});
    