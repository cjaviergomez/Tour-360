/**
*Zipy es un script que se encarga de realizar la descompresión y envío de imágenes  - con sus marcadores- al 
*Mapa de Google. Utiliza  las APIs JSZip.js, Exif.js y Google maps, además de algunas consultas en JQuery.
*
*/
/*jslint browser: true*/
/*global $ */
var $result = $("#result");
var JSZip = JSZip(); 

// Vector que tendrá metadatos de fotos de la forma : Nombre, altitud, longitud, latitud
var ximage = [];
var markerShadow;
var markers=[];
var auxiliar=0;
 //Esta función se encarga de 'escuchar' en qué momento ocurre el evento de carga del archivo
$("#File").on("change", function (evt) {

  document.getElementById("Layer1").style="background-image:none;";
  var files = evt.target.files;
  if(files.length!=0){
    if(markers.length!=0){
    for (var i=0; i<markers.length;i++){

      markers[i].setMap(null);


    } //Elimina los marcadores existentes - usado por si se quiere cargar otro conjunto de datos
    markers=[];
    ximage=[];
     markerShadow.setVisible(false); //Se usa un marcador 'auxiliar' para realizar un efecto de selección en los marcadores.

    }// remove content
    
    $result.html("");
    // Asegurar la muestra de resultados
    $("#result_block").removeClass("hidden").addClass("show");
 
    //Cierre para capturar el archivo. 
    
	   
	for (var i = 0; i < files.length; i++) {

       handleFile(files[i]); //Cada uno de los archivos zip se envían a HandleFile.
      }}
/*
* ->Handlefile toma cada archivo zip  'f'
* y crea de entrada una lista donde posteriormente se agregarán las imágenes
* ->Se utiliza una carga asincrónica a través de JSZip.js 
* -->Se realiza un escaneo del archivo zip para determinar solamente imágenes
*----> Se extraen los metadatos de cada imágen previamente convertidas a formato blob
*-----> Se realiza una inclusión en Home.php de cada imagen junto a los marcadores para cada imagen.
*@param f {Zip file} - Contiene un archivo zip que será manejado por la función.
*****/    
function handleFile(f) {

        var $title = $("<h4>", {
            text : f.name
        });

        var $fileContent = $("<ul style='list-style:none; padding: 8px 0 0 10px;' id='resL'> ");
        $result.append($title);
        $result.append($fileContent);   
        
    // Se realiza la carga asincrónica y luego se dejan solamente los archivos que nos sirven
        JSZip.loadAsync(f).then(function (zip) {
            
            
            var re = /(.jpg|.png|.gif|.ps|.jpeg)$/;
            var promises = Object.keys(zip.files).filter(function (fileName) {
                
              // No considerará archivos que no sean imágenes
              return re.test(fileName.toLowerCase()); //regular expression test
                
                
          }).map(function (fileName) {
            var file = zip.files[fileName];
            
            //Para cada archivo dentro de file se crea su blob que facilita la toma de 
            // metadatos.    
            return file.async("blob").then(function (blob) {
            
            //Función que toma un archivo blob y realiza una función que crea los marcadores
            // con los metadatos que extrae, luego los almacena en un vector.    
            EXIF.getData(blob, function () {
                    
                    var altitude = EXIF.getTag(this, "GPSAltitude");
                    var altitudeRef = EXIF.getTag(this, "GPSAltitudeRef");
                    var longitude = EXIF.getTag(this, "GPSLongitude")+'';
                    var latitude = EXIF.getTag(this, "GPSLatitude")+'';
                    var latitudeRef = EXIF.getTag(this, "GPSLatitudeRef")+'';
                    var longitudeRef = EXIF.getTag(this,"GPSLongitudeRef")+'';
                    var longpart= longitude.split(',');
                     
                    var latipart = latitude.split(',');
                    
                    if (latipart[0]=="undefined"){alert(" La Imágen: "+fileName+ " NO TIENE EXIF");
                                    document.getElementById("resL").removeChild(document.getElementById("li"+fileName));                           }
                    else{
                    
                    var lat  = ConvertDMSToDD(latipart[0], latipart[1], latipart[2],latitudeRef );
                   
                    var long = ConvertDMSToDD(longpart[0],longpart[1],longpart[2],longitudeRef );
                   
                    var x= [fileName, altitude, lat, long];
                     
                 
                    var marker = new google.maps.Marker({

                        position: {lat: lat, lng: long},
                        map: map,
                        title: fileName,
                        
                       icon:'img/purple.png',
                        zIndex: parseFloat(altitude)
                        });
            
                    marker.addListener('click', function(){
                            
                        dameF(marker.title);
                        shadow(marker.position);
                        
                        
            
                    });
                   
               
                    markers.push(marker);
                    if (auxiliar==0){
                        map.setCenter(marker.position);
                        auxiliar=1;
                    }


                    ximage.push(x);
                   
                    //alert("photo Numero "+fileName+ "coordenada alt: "+altitude+ "and longitud: "+ longitude+" con ref: "+longitudeRef+ "y latitud"+latitude +"con ref: "+latitudeRef);
                    }
                
                   
                });
                
                return [
                fileName,  // keep the link between the file name and the content
                URL.createObjectURL(blob) // create an url. img.src = URL.createObjectURL(...) will work
              ];
               
            
            });
          }); //Se empiezan a tomar los archivos por separados en una función que transformará sus valores iniciales
          // `promises` es un  array de Promesas, `Promise.all` las transforma
          // en una promesa de arrays
          return Promise.all(promises);
        }).then(function (result) {
            
            //Aquí tenemos un array de tipo [fileName,url]
          // Si queremos el mismo resultado que imageSrc:
        return result.reduce(function (acc, val) {
             
            
            
            acc[val[0]] = val[1];//se van conservando las imágenes en un diccionario. 
            //var ImgU= new Uint8Array(val[1]);
            id=val[0];
            
            $fileContent.append(' <li style="border: 1px solid black;" class="imageAnchor" id=li'+val[0]+'>');
   
            
             
            var image = document.createElement("img");
            image.setAttribute("height", "40%");
            image.setAttribute("width", "98%");
            image.setAttribute("id",val[0]);
            
            image.src = val[1];
            var a=document.createElement("a");
            a.setAttribute("href","#");
            a.setAttribute("id","a"+val[0]);
            a.setAttribute("class","imageAnchor");
            a.appendChild(image);
            document.getElementById('li'+val[0]).appendChild(a);
                                    
            $resIm = $("#"+image.id);
            image.setAttribute("onclick", "dameF(this.id)");
            //image.setAttribute("onclick",;
            //    ximage.push(val[0], );
            
            return acc;
          }, {});
        }).catch(function (e) {
          console.error(e);
        });
        
        
       
    }
              
});


/*
* Cada imagen debe tener un evento para 
* permitir seleccionar un marcador al ser clickeada
* y viceversa,  dameF realiza esto, y de paso envia la imagen seleccionada al visor de pannellum.
* @param image{String} - Recibe tanto el id de las imágenes como el title de los marcadores.
*/
function dameF(image){
    for (var i=0; i<markers.length;i++){

        if (image==markers[i].title){

            if(!markerShadow){map.setCenter(markers[i].getPosition());}
            
            shadow(markers[i].getPosition());
            if (markerShadow.getVisible()==false){
              markerShadow.setVisible=true;
              }
            map.setCenter(markers[i].getPosition()); //Centra al ser clickeado    
            
        }
    }
 eliminaActive("activi");
 img=document.getElementById(image);
 document.getElementById("a"+img.id).focus();
     
 document.getElementById(img.id).className+=" activi";
     
pannellum.viewer('panorama', {
    "type": "equirectangular",
    "panorama": img.src,
    "autoLoad": true
});
}

/*
*Shadow es uan función que se encarga de a) crear un marcador que servirá para crear un efecto visual
*o b)modificar la posición de este marcador para que aparezca junto al marcador seleccionado.
*@param markerP{LatLng} - Variable que contiene un vector de posiciones usado por google para establecer dónde se ubicará el marcador.
*/
function shadow(markerP){
               
               
               if(!markerShadow){
                            markerShadow = new google.maps.Marker({
                       position:markerP,
                       map: map,
                       icon:'img/shad2.png',
                       title:"hola"
                   });
                            
                        }
               else{
                        markerShadow.setPosition(markerP);
                        
               }
           }         
            
/*
* Debido a que los datos extraídos se encuentran en otro sistema de coordenadas
* es necesario transformarlos del sistema de GMS a Decimales. 
*
*@param degrees{string} -Grados que serán convertidos en float y sumados
*@param minutes{string} -Minutos, estos se dividen en 60
*@seconds{string}- Se dividen en 3600
*@direction{string} - Contiene una letra entre las 4 posibles : S,W,E,N.
*/
function ConvertDMSToDD(degrees, minutes, seconds, direction) {
    var dd = parseFloat(degrees) + parseFloat(minutes/60) + parseFloat(seconds/(60*60));
    //alert(dd);
     
    if (direction == "S" || direction == "W") {
        dd = dd * -1;
    } //No se hace nada para N  y E
    return dd;
}

