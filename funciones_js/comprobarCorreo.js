function comprobarCorreo(correo){
     // Expresión regular para validar direcciones de correo electrónico
        var expresionRegular =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/ ;
     // Verificar si la dirección de correo electrónico coincide con la expresión regular
     return expresionRegular.test(correo);
 }
 
