function comprobarTelefono(numero){
    var patron = /^[0-9]*$/
    if (patron.test(numero)){
        numeroCadena=numero.toString();
        if (numeroCadena.length === 9){
            return true;
        }
        else{
            window.alert("El numero tiene que tener 9 digitos. ")
        }
    }
    else{
        window.alert("Introduce solo numeros del 0 al 9. ")
    }
}