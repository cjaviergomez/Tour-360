/*
* Con esta función se pretende activar y desactivar el css  correspondiente a 
* cada formulario para dar un efecto de "edición".
*/
    function edita(elementoDiv){
        
                    
                    
                document.getElementById("map-infowindow-attr-nombre-value").style="border:1px solid black";
                document.getElementById("map-infowindow-attr-description-value").style="border:1px solid black";
                if (elementoDiv.title=="Point"){
                document.getElementById("map-infowindow-attr-select-severidad").removeAttribute("disabled");
                document.getElementById("map-infowindow-attr-select-dimensionamiento").removeAttribute("disabled");
                document.getElementById("map-infowindow-attr-select-visibilidad").removeAttribute("disabled");
                    document.getElementById("infowindow-meaurements").style.display="none";
                }
                document.getElementById("map-infowindow-attr-description-value").setAttribute("contentEditable","true");
                document.getElementById("map-infowindow-attr-nombre-value").setAttribute("contentEditable","true");

                

                document.getElementById("editar").style.display="none";            
                document.getElementById("eliminar").style.display="none";
                document.getElementById("cancelar").style.display="flex";

                document.getElementById("guardar").style.display="flex";  

    }        
    