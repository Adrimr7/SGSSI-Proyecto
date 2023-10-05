function comprobarCorreo(correo)
{
    // Expresión regular para validar direcciones de correo electrónico
       var expresionRegular =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/ ;
    // Verificar si la dirección de correo electrónico coincide con la expresión regular
    return expresionRegular.test(correo);
}

function comprobarEdad(ano)
{
    anoActual = new Date().getFullYear();

    if (ano < anoActual -1) 
    {
        return true; 
    }
    else
    {
        return false
    }
}

function comprobarnombreapellidos()
{
    var textoInput = document.getElementById('TextBoxNombre').value;

    // Patrón que permite solo letras (mayúsculas o minúsculas) y espacios
    var patron = /^[a-zA-Z\s]+$/;

    // Verificar si el valor coincide con el patrón
    if (patron.test(textoInput)) {
      // Si es válido, limpiar el mensaje de error
      //document.getElementById('mensajeError').textContent = '';
      return true;
    } else {
      // Si no es válido, mostrar un mensaje de error
      //document.getElementById('mensajeError').textContent = 'Ingrese solo texto (letras y espacios).';
        window.alert("Ingresa solo texto (letras). ")
    }
}

function comprobarTelefono(numero)
{
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

function comprobarDNI(dni)
{
    // Expresión regular para el formato "11111111-Z"
    var formatoDNI = /^\d{8}-[A-Za-z]$/;

    if (!formatoDNI.test(dni)) {
        return false; // No coincide con el formato esperado
    }

    // Extraer el número y la letra del DNI
    var partes = dni.split('-');
    var numero = partes[0];
    var letra = partes[1].toUpperCase(); // Convertir la letra a mayúsculas

    // Algoritmo para calcular la letra de verificación
    var letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
    var letraCalculada = letras[numero % 23];

    // Verificar si la letra calculada coincide con la letra proporcionada
    if (letra !== letraCalculada) {
        return false; // La letra no es válida para el número dado
    }

    return true; // El DNI es válido
}

function comprobar()
{
    console.log("Funciona");
    if (comprobarCorreo(Correo))
    {
        if (comprobarEdad(ano))
        {
            if (comprobarnombreapellidos())
            {
                if (comprobarnombreapellidos())
                { 
                    if (comprobarTelefono(numero))
                    {
                        if (comprobarDNI(dni))
                        {
                            console.log("Errorn't");
                            // Llamar a botonregistro.php
                        }
                        else
                        {
                            console.log("Error : DNI no valido");
                        }
                    }
                    else
                    {
                        console.log("Error : Telefono no valido");
                    }
                }
                else
                {
                    console.log("Error : Apellido no valido");
                }
            }
            else
            {
                console.log("Error : Nombre no valido");
            }
        }
        else
        {
            console.log("Error : Edad no valido");
        }
    }
    else
    {
        console.log("Error : Correo no valido");
    }

    //TODO: Comprobar contraseña
}
