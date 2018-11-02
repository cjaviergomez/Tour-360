
/**
* Función para crear los Ids a las Capas.
*
* @param asignarId{vector} - Contiene el vector de Id's de capas agregadas
* return {int}- Devuelve el siguiente valor posible: 1 si es la primer vez, o suma uno al último agregado.
*/
function asignarId(vector){

  var x = vector.length;
  if (x!=0){
    return parseInt(vector[x-1])+1;
  }else{
    return 1;
  }
} //Cierra asignarId
