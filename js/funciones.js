function validarFormVacio(formulario){
    datos=$('#'+ formulario).serialize();
    d=datos.split('&');
    vacios=0;
    for(i=0;i<d.length;i++){
        controles=d[i].split("=");
        if(controles[i]==="A" || controles[i]===""){
            vacios++;
        }
    }
    return vacios;
}
function ocultar() {
    var x = document.getElementById("ocultar_i");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
    var a = document.getElementById("frm_i");
    if (a.style.display === "none") {
        a.style.display = "block";
    } else {
        a.style.display = "none";
    }
}
