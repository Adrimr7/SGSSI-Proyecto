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

