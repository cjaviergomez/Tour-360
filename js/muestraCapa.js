/**
*Función utilizada para activar o desactivar las capas
*sin embargo, también es utilizada cuando se crea un nuevo marcador
*
*@param check [boolean] true o false dependiendo de la escena
*@param nom {string} -dentro suyo esta contenido el número de la capa.
*/
function muestraCapa(check, nom){
    
    var x = nom.split(":")[1];
    if (check==true){
        aux = parseInt(x);
        eliminaActive("active"); 
        document.getElementById("cap:"+aux).className+=" active";
        if (document.getElementById("lista:"+aux).style.display=="none"){
            
            document.getElementById("lista:"+aux).style.display="block";
        }
        for (i=0; i<3;i++){
        if (capas[x]!=null && capas[x][i].length!=0){
            if (capas[x][i][0].getVisible()==false){
                activar(check,x);
            }
        }
    }
  } else{
    activar(check,x);
    document.getElementById("lista:"+x).style.display="none";
    if (capas[x][0].length!=1){
      if (x==aux){
        for (var d=0;  d<Object.keys(capas).length; d++ ){ //recorre todas las id de las capas creadas
            if (Object.keys(capas)[d]==x){ // para determinar a partir de dónde se buscarán capas activas
              for (var j=d+1; j<Object.keys(capas).length+1;j++){ //segundo For para realizar la busqueda
                if (Object.keys(capas)[j]!=null){ //queremos saber si NO estamos en la última posición
                  if (document.getElementById("check:"+Object.keys(capas)[j]).checked==true){ //y si en esa siguiente posición esta activa la capa
                    muestraCapa(true,"cap:"+Object.keys(capas)[j]);
                    break;
                  }
                  if (j==d){ //recorrió todo el vector y no hay ninguno más que esté activo, así que pone por defecto la primer capa, pero la deja en modo desactivado hasta que un Point sea lanzado ( en ese caso se activa la capa)
                    aux=parseInt(Object.keys(capas)[0]);
                    d=Object.keys(capas).length;
                    eliminaActive("active"); 
                    break;
                  }
                } else{ //si es null el siguiente, volvemos a recorrer el vector hasta que llegue a ser j=d ( en ese caso ocurre otro evento)
                    j=-1;
                  }
                }
              }
            }
          }
        }
      }
    event.stopPropagation();
} //Cierra muestra capa
    