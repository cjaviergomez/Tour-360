/*
* Esta función es ejecutada en el momento en que se decide descargar lo llevado hasta el momento del proyecto
* Recorre a jsonC y crea un archivo Zip que contendrá los shapefiles de todos los elementos
*/
var exportShp= function(){
        /*GEOJson.features[0] ={type:"Feature",geometry:{type:"Point",coordinates:[102.0, 0.5]},properties:{"name": "Coors Field",
        "amenity": "Baseball Stadium",
        "popupContent": "This is where the Rockies play!"
    }}*/

// (optional) set names for feature types and zipped folder
     
        var GEOJson = {"type":"FeatureCollection",
                      "features": []
                      };
        var options = {
    folder: 'Proyecto',
    types: {
        point: 'ProjectPoints',
        polygon: 'ProjectPolygons',
        polyline: 'projectLines' //Debido a un bug en Shape-write, hay que definir las líneas como polyline. -> https://github.com/mapbox/shp-write/issues/28
    }
}
            
        for (var key in jsonC) {
            
               
                
                
            if (jsonC.hasOwnProperty(key)) {
                
                   
                for (var i=0; i<jsonC[key].length;i++){
                
                    
                    if (jsonC[key][i].type!="Point"){
                            var coord =[] ; 
                            
                            for (var j in jsonC[key][i].properties.coordenadas){
                                
                                coord.push([jsonC[key][i].properties.coordenadas[j].lng,jsonC[key][i].properties.coordenadas[j].lat]); //Vector de coordenadas
                                
                            }
                        
                        
                        
                        GEOJson.features.push({type:"Feature",geometry:{type:jsonC[key][i].type,coordinates:coord},properties:{
                            
                           "nombre": jsonC[key]  [i].properties.nombre,
                            "description": jsonC[key][i].properties.descripcion,
                            "IdPol":jsonC[key][i].properties.id,
                            "Capa":document.getElementById("label:"+key).innerHTML
                            }});
                    }
                    else {
                        
                        //Se carga primero longitud, luego latitutd para trabajar mejor con ESRI
                        GEOJson.features.push({type:"Feature",geometry:{type:jsonC[key][i].type,coordinates:[jsonC[key][i].properties.longitud,jsonC[key][i].properties.latitud]},properties:{
                            "IdPol":jsonC[key][i].properties.id,
                            "nombre": jsonC[key][i].properties.nombre,
                            "description": jsonC[key][i].properties.descripcion,
                            "Severidad": jsonC[key][i].properties.severidad,
                            "Dimensionamiento":jsonC[key][i].properties.dimensionamiento ,
                            "Visibilidad":jsonC[key][i].properties.visibilidad,
                            "Capa":document.getElementById("label:"+key).innerHTML
                        }});
                    }
                
        //jsonC[aux][1] //type :LineString ; properties: { id,nombre,descipcion,coordenadas} 
        }
                
                
                
                
                
    }
            
                
}
    shpwrite.download(GEOJson,options);
               
        
        
    }   
    