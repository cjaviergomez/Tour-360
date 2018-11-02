/*
*Se encarga de activar y desactivar las capas según se presente el botón check.
*@param elementoId {string} es el Id que posee el elemento al cuál se aplica el cambio en su Css
*/
function activarD(elementoId){
           
           
           var elemento=document.getElementById(elementoId);
   
           eliminaActive("acti");
           elemento.className += " acti";
           aux=parseInt(elemento.parentElement.id.split(":")[1]);   
           eliminaActive("active");
           elemento.parentElement.parentElement.parentElement.className+=" active";
    
       } 
                    
              