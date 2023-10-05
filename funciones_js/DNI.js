function comprobarDNI(dni){
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

comprobarDNI("20232682L")

