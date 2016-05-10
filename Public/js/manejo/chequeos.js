//Chequeo solo para numero
function  validarNumero(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) return true; 
    patron = /\d/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te); 
}
//Chequeo solo para texto
function validarTexto(e) {
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==0) return true;
    patron =/[A-Za-z\s]/;  //permite texto de la A a la Z
    te = String.fromCharCode(tecla); 
    return patron.test(te);
}

