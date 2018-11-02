         
/*
*Función creada para activar o desactivar los elementos del mapa
*
*@param valor{boolean} determina si se mostrará o si se ocultará el elemento
*@param capaN{int} Es el número de la capa.
*/
function activar(valor,capaN){
  for(i=0; i<3;i++){
    for (marker in capas[capaN][i]){
      capas[capaN][i][marker].setVisible(valor);
    }
  }
} // Cierra la función activar
    
    