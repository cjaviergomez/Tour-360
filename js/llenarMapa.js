              
/*
* Función que trae consigo el vector de la capa  y la lista de la capa en donde se insertarán los marcadores 
* dentro del menu que se construyó en la función initMap, con ellos se recrea nuevamente el entorno que se tenía
* cuando se guardó el proyecto por última vez (la última modificación hecha).
*
*@param VectorElementos contiene los elementos extraídos de la base de datos
*@param listaElementos es un valor que se encarga de ubicar a cuál capa pertenece cada punto.
*/    
function llenarMapa(VectorElementos, listaElementos){
     
    for (var i=0; i<VectorElementos.length;i++)
        {
            if (VectorElementos[i].type=="Point" ){
                var markerLi = document.createElement("div");
                markerLi.title = "Point";
                markId= parseInt(VectorElementos[i].properties.id.split(":")[1]);
                form = agregarDivs(markId,VectorElementos[i].properties.nombre,VectorElementos[i].properties.descripcion,VectorElementos[i].properties.severidad,VectorElementos[i].properties.visibilidad,VectorElementos[i].properties.dimensionamiento,markerLi,VectorElementos[i].properties.longitud,VectorElementos[i].properties.latitud,false);
                
                
                var newMarker = new google.maps.Marker({
                    
                    position: {lat:VectorElementos[i].properties.latitud, lng: VectorElementos[i].properties.longitud},
                    map:map,
                    content: form
                });
                
                
                newMarker.addListener('click',function(){
                    infowindow.setContent(this.content);
                    infowindow.open(map, this);
                    auE=parseInt(this.id.split(":")[1]);
                    activarD(this.id);
                });
                newMarker.id = "Point:"+markId;


                  markId+= 1;      

                capas[aux]['0'].push(newMarker);
                listaElementos.appendChild(markerLi); 
                
            }
            
            else if (VectorElementos[i].type=="Polygon"){
                
                   var polyGId = document.createElement('div');
                polyGId.title = "Polygon";
                
                polyId = parseInt(VectorElementos[i].properties.id.split(":")[1]);
                form = agregarDivs(polyId,VectorElementos[i].properties.nombre,VectorElementos[i].properties.descripcion,"","","",polyGId,"",VectorElementos[i].properties.coordenadas,false);
                var newPoly = new google.maps.Polygon({
                       content:form,
                    geodesic:true,
                    }); //paths es un vector de objetos [{lat:x1, lng:y1},{lat:x2, lng:y2}]; 
              
                //newPoly.addListener('click',function(){
                  //  infowindow.setContent(this.content);
                    //infowindow.open(map, this);
                    //auE=parseInt(this.id.split(":")[1]);
                    
        //        });
                
                
                newPoly.infoWCoord=VectorElementos[i].properties.infoWCoord;
            
                
                
                newPoly.setPath(VectorElementos[i].properties.coordenadas); //Modificado  04/05 12:14pm

                newPoly.addListener('click',function(newPoly){
                    infowindow.setContent(this.content);
                    
                    infowindow.setPosition({lat:this.infoWCoord[0],lng:this.infoWCoord[1]});
             
                    infowindow.open(map, this);
                    auE=parseInt(this.id.split(":")[1]);
                    activarD(this.id);
                    
                    
                });
          
        
                newPoly.id = "Polygon:"+polyId;
                newPoly.setMap(map);
          
                polyId+=1; 
          
                capas[aux]['2'].push(newPoly);
                listaElementos.appendChild(polyGId); 
        
     }
                                                
            else if (VectorElementos[i].type=="LineString"){
                var poliLi = document.createElement('div');
                poliLi.title = "LineString";
                LineId = parseInt(VectorElementos[i].properties.id.split(":")[1]);
                form = agregarDivs(LineId,VectorElementos[i].properties.nombre,VectorElementos[i].properties.descripcion,"","","",poliLi,"",VectorElementos[i].properties.coordenadas,false);
                var newPolyLine = new google.maps.Polyline({
                 
                    content:form,
                    geodesic:true,
                    }); //paths es un vector de objetos [{lat:x1, lng:y1},{lat:x2, lng:y2}]; 
              
                newPolyLine.infoWCoord=VectorElementos[i].properties.infoWCoord;
            
                
                
                newPolyLine.setPath(VectorElementos[i].properties.coordenadas); //Modificado  04/05 12:14pm

                newPolyLine.addListener('click',function(newPolyLine){
                    infowindow.setContent(this.content);
                    
                    infowindow.setPosition({lat:this.infoWCoord[0],lng:this.infoWCoord[1]});
             
                    infowindow.open(map, this);
                    auE=parseInt(this.id.split(":")[1]);
                     activarD(this.id);
                });
                
        
                newPolyLine.id="LineString:"+LineId;
                newPolyLine.setMap(map);
                LineId+=1; 
          
                
                capas[aux]['1'].push(newPolyLine);
                
                listaElementos.appendChild(poliLi); 
                
            }
        }
}
    
    
   