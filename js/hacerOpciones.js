                
/**
* Función que agrega elementos para modificar y eliminar cada Capa creada.
* Recibe un elemento HTML DOM, y lo modifica.
* @param CapaIns{HTML DOM} - Elemento de la capa que contendrá la información
* return CapaIns{HTML DOM} - Devuelve las modificaciones realizadas a NuevCapa.
*/
function hacerOpciones(CapaIns){
            
  //Div que contiene la imagen y la lista
  var divP=document.createElement("div");
  divP.classList.add("despleg");
            
  var aEli=document.createElement("a");
  aEli.id=CapaIns.id;
  aEli.title="Eliminar capa";
  aEli.style="cursor:pointer";
  aEli.onclick= function elimina(aEli){ //Función para eliminar capas de la lista de capa del proyecto.
    // arreglar por si sólo hay una capa activa
    var nombre=prompt('teclee por favor ELIMINAR :','');
    if (nombre=="ELIMINAR"){ 
      var au=this.id.split(":")[1];
      document.getElementById("check:"+au).checked=false;
      muestraCapa(document.getElementById("check:"+au).checked,"elim:"+au);

      //Aqui enviamos la información a un script de php para eliminar la capa de la base de datos
      $.ajax({
        data: {idcapa :'cap:'+ au, idproyecto: idproyectoJ},
        type: "POST",
        url: "eliminarcapadb.php"
              });
                
      for(i=0; i<3;i++){
        for (marker in capas[au][i]){
          capas[au][i][marker].setMap(null);
        }
      }
               
      delete capas[au];
      delete jsonC[au];
      document.getElementById("capasD").removeChild(document.getElementById("cap:"+au));
                    
      if (Object.keys(capas).length==0){ //En caso de que sólo haya una capa y esta se elimine, se crea una por defecto. 
        aux=0;
        nuevCapa(document.getElementById("capasD"),'','','');
      }
    }
            
    event.stopPropagation();

  } //Cierra función elimina
            
  var iElimina = document.createElement("i");
  iElimina.className = "far fa-trash-alt";
  aEli.appendChild(iElimina);
            
  var cambiaNom = document.createElement("a");
  cambiaNom.id=CapaIns.id;
  cambiaNom.className = "Edit";
  cambiaNom.title="Cambiar Nombre a la capa"
  cambiaNom.style="cursor:pointer";
  cambiaNom.onclick = function cambia(cambiaNom){  //Función para cambiarle el nombre a una capa.
    var cambi= this.id.split(":")[1];
    var nombre;
    nombre=prompt('Ingrese el nombre de la capa:','');
    if(nombre != null){
    document.getElementById("label:"+cambi).innerHTML=nombre;
    $.ajax({
      data: {idcapa :'cap:'+this.id.split(":")[1], nombre: nombre, idproyecto: idproyectoJ},
      type: "POST",
      url: "modifcarcapadb.php"
    });
      }
    event.stopPropagation();
  } // Cierra función cambia
            
  var iCambiaNom = document.createElement("i");
  iCambiaNom.className = "far fa-edit";
            
         
  cambiaNom.appendChild(iCambiaNom);
  divP.appendChild(cambiaNom);
  divP.appendChild(aEli);
  CapaIns.appendChild(divP);
  return CapaIns;
}  // Cierra función hacerOpciones
                
   