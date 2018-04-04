
/*jslint browser: true*/
/*global $ */
var $result = $("#result");
var JSZip = JSZip(); 
var markers=[];

// Vector que tendrá metadatos de fotos de la forma : Nombre, altitud, longitud, latitud
var ximage = [];
var markerShadow;

$("#File").on("change", function (evt) {
    
    // remove content
    $result.html("");
    // be sure to show the results
    $("#result_block").removeClass("hidden").addClass("show");
 
    // Closure to capture the file information.
    function handleFile(f) {

        var $title = $("<h4>", {
            text : f.name
        });

        var $fileContent = $("<ul style='list-style:none; padding: 8px 0 0 10px;' id='resL'> ");
        $result.append($title);
        $result.append($fileContent);   

        JSZip.loadAsync(f).then(function (zip) {
            
            
            var re = /(.jpg|.png|.gif|.ps|.jpeg)$/;
            var promises = Object.keys(zip.files).filter(function (fileName) {
                
              // don't consider non image files
              return re.test(fileName.toLowerCase());
          }).map(function (fileName) {
            var file = zip.files[fileName];
            return file.async("blob").then(function (blob) {
               
               EXIF.getData(blob, function () {
                    var altitude = EXIF.getTag(this, "GPSAltitude");
                    var altitudeRef = EXIF.getTag(this, "GPSAltitudeRef");
                    var longitude = EXIF.getTag(this, "GPSLongitude")+'';
                    var latitude = EXIF.getTag(this, "GPSLatitude")+'';
                    var latitudeRef = EXIF.getTag(this, "GPSLatitudeRef")+'';
                    var longitudeRef = EXIF.getTag(this,"GPSLongitudeRef")+'';
                   var longpart= longitude.split(',');
                     
                   var latipart = latitude.split(',');
                    
                    var lat  = ConvertDMSToDD(latipart[0], latipart[1], latipart[2],latitudeRef );
                    var long = ConvertDMSToDD(longpart[0],longpart[1],longpart[2],longitudeRef );
                   
                    var x= [fileName, altitude, lat, long];
                     
                   //Efecto Sombra
                   var iconShadow = {
    url: 'img/marker_shadow.png',
   
  };

                   
                   
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
                   
               
                    /*marker.addListener('mouseover', function(){
                            dameF(marker.title),
                            marker.setOptions({'opacity': 1}) 


                    })*/

                    markers.push(marker);


                    

                    ximage.push(x);
                    //alert(lat+","+long);
                   
                    //alert("photo Numero "+fileName+ "coordenada alt: "+altitude+ "and longitud: "+ longitude+" con ref: "+longitudeRef+ "y latitud"+latitude +"con ref: "+latitudeRef);
                    
                });
                
              return [
                fileName,  // keep the link between the file name and the content
                URL.createObjectURL(blob) // create an url. img.src = URL.createObjectURL(...) will work
              ];
            });
          });
          // `promises` is an array of promises, `Promise.all` transforms it
          // into a promise of arrays
          return Promise.all(promises);
        }).then(function (result) {
          // we have here an array of [fileName, url]
          // if you want the same result as imageSrc:
        return result.reduce(function (acc, val) {
            acc[val[0]] = val[1];
            //var ImgU= new Uint8Array(val[1]);
            id=val[0];
            
            $fileContent.append(' <li style="border: 1px solid black;"  id=li'+val[0]+'>');
   
            
            var image = document.createElement("img");
            image.setAttribute("height", "250");
            image.setAttribute("width", "250");
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
                    
            
      
           
            
                   
            
 
      //      ximage.push(val[0], );
     
            
            
         
            return acc;
            
          }, {});
        }).catch(function (e) {
          console.error(e);
        });
        
        
       
    }

    var files = evt.target.files;
	
	
	for (var i = 0; i < files.length; i++) {
        handleFile(files[i]);
    }
    
    //alert(ximage);
            
});













function dameF(image){
    for (var i=0; i<markers.length;i++){

        if (image==markers[i].title){

            if(!markerShadow){map.setCenter(markers[i].getPosition());}
            shadow(markers[i].getPosition());
        }
    }
    
 img=document.getElementById(image);
 document.getElementById("a"+img.id).focus();
pannellum.viewer('panorama', {
    "type": "equirectangular",
    "panorama": img.src,
    "autoLoad": true
});
    
    
}
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
            

function ConvertDMSToDD(degrees, minutes, seconds, direction) {
    var dd = parseFloat(degrees) + parseFloat(minutes/60) + parseFloat(seconds/(60*60));
    //alert(dd);
     
    if (direction == "S" || direction == "W") {
        dd = dd * -1;
    } // Don't do anything for N or E
    return dd;
}

