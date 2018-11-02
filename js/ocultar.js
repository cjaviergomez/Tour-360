     /*
     * Es una función que deshabilita el css de algunos elementos del mapa. 
     * Sirve para dar un efecto de guardado.
     *
     *@param {HTMLDOM} elementoDiv - Se trae el formulario de los elementos y modifica 
     */    
    function ocultar(elementoDiv){
                
            document.getElementById("cancelar").style.display="none";
            
            document.getElementById("guardar").style.display="none";        
                
             if (elementoDiv.title=="Point"){    
            document.getElementById("map-infowindow-attr-select-severidad").setAttribute("disabled","");
            document.getElementById("map-infowindow-attr-select-dimensionamiento").setAttribute("disabled","");
            document.getElementById("map-infowindow-attr-select-visibilidad").setAttribute("disabled","");
             document.getElementById("infowindow-meaurements").style.display="flex";
            
             }
        
            document.getElementById("map-infowindow-attr-description-value").setAttribute("contenteditable", false);
            document.getElementById("map-infowindow-attr-nombre-value").setAttribute("contenteditable", false);
            document.getElementById("map-infowindow-attr-description-value").style="border:0px";
            document.getElementById("map-infowindow-attr-nombre-value").style="border:0px; font-weight: bold";
            
            document.getElementById("editar").style.display="flex";            
            document.getElementById("eliminar").style.display="flex";
                    
            
                    
        
    }
          