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
function validarPattern(e,tipo){
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==0) return true;
    patron = tipo;  //permite texto de la A a la Z
    te = String.fromCharCode(tecla); 
    return patron.test(te);
}
//Chequeo solo para numero
function validarNumero(e){
    return validarPattern(e,/\d/);
}
//Chequeo solo para texto
function validarTexto(e) {
    return validarPattern(e,/[A-Za-z\s]/);
}
//Chequeo solo para número, punto y coma.
function validarNumeroPC(e){
    return validarPattern(e,/[\d\.\,\-]/);
}
//Chequeo solo para texto, numero, comas y puntos.
function validarTextoyNumPC(e) {
    return validarPattern(e,/[A-Za-z\s\d\.\,\/]/);
}
function validarTextoyNum(e) {
    return validarPattern(e,/[A-Za-z\s\d]/);
}
//Chequeo solo para número, punto y coma.
function validarNumeroComa(e){
    return validarPattern(e,/[\d\,]/);
}