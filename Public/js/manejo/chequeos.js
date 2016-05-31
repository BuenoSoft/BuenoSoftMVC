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

//Chequeo de la cédula
function validarCedula(ci){ 
    var arrCoefs = [2,9,8,7,6,3,4,1];
    var suma = 0;
    var difCoef = parseInt(arrCoefs.length - ci.length);
    for (var i = ci.length - 1; i > -1; i--) {
	var dig = ci.substring(i, i+1);
	var digInt = parseInt(dig);
	var coef = arrCoefs[i+difCoef];
	suma = suma + digInt * coef;
    }
    if ( (suma % 10) == 0 ) {
        return true;
    } else {
        alert ("Cedula inválida.");
	return false;
    }

}
//Chequeo solo para número y punto.
function validarNumeroPunto(e){
    tecla = event.keyCode || event.which;
    teclado = String.fromCharCode(tecla);
    numeros = '0123456789';
    especiales = [08, 09, 46]; // Array
    teclado_especial = false;
    for (var i in especiales ) {
        if ( tecla == especiales[i] ) {
            teclado_especial = true;
        }
    }
    if ( numeros.indexOf(teclado) == -1 && !teclado_especial ) {
        return false;
    }
}