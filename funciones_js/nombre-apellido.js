function comprobarnombreapellidos(){
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