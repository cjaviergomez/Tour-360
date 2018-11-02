/*
* Se recorre el vector que contiene al elemento para su eliminación
*
*@param x{int} - determina el tipo de elemento : 0 si marcador, 1 si Línea, 2 si polilínea.
*@param title{string}- Es el nombre del marcador a eliminar
*/
function eliminaMe(x, title){
        document.getElementById("lista:"+aux).removeChild(document.getElementById(title));//remover de la lista aux el child documentbyId("Point":x(title)
              
                for (i=0; i<capas[aux][x].length;i++){
                if(title==capas[aux][x][i].id){
                    capas[aux][x][i].setMap(null);
                    capas[aux][x].splice(i,1);
            
                    
                }}
    }
                