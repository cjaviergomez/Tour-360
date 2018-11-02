/**
* Función que sirve para intercambiar el estado de la clase en el css.
* Cuando se activa, se toma el primer elemento que contiene la palabra 
* y se procede a eliminarla. Sirve para generar efectos de sombras en 
* la selección.
* @param palabra{String} - Contiene la palabra a eliminar.

*/  

function eliminaActive(palabra){
    
    if (document.getElementsByClassName("cap").length!=0){
        var current = document.getElementsByClassName(""+palabra);
        if(current[0]!=null){
            current[0].className = current[0].className.replace(" "+palabra, "");
        }
    }
} //Cierra función eliminaActive
     