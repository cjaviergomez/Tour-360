<?PHP

//Inicio la sesión
session_start();

if ($_SESSION["nombre"]==""){

 header("Location: index3.html");

  //echo "no inicio sesion";
            

}else{
          
  //no hago nada solo continuo en la pagina

}


?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <title>Computación Móvil</title>
    <link rel="stylesheet" type="text/css" href="label.css"/>
    <link rel="stylesheet" type="text/css" href="css/estilohome.css">
     <link rel="stylesheet" href="https://cdn.pannellum.org/2.4/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.pannellum.org/2.4/pannellum.js"></script>
    <link rel="shorcut icon" href="img/logoGeomatica.jpg">
  
    <script type="text/javascript" src="exif.js"></script>
    <script type="text/javascript" src="jszip.js"></script>
    
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

    <style>
        
        #link::before{
            content:url("img/overlay.png");
            
        }    
        
        .cap{
            background-color: aqua;
        }
        .despleg{

          display:inline-block;
        }
        .despleg a img{
          margin-right: 5px;
        }
        .lista li ul {
        display:none;
        position:absolute;
        min-width:140px;
      }
      
      .lista li:hover > ul {
        display:block;
      }

      .lista li:focus > ul {
        display:block;
      }
      ul {
        list-style:none;
      }
    #panorama {
        width: 1050px;
        height: 320px;
    }
        .border {
    border:1px solid black;
    width:360px;
    height:315px;
    overflow:auto;
    background-color: azure;

}

    </style>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        width: 100%;
        height: 50%;
      }
      /* Optional: Makes the sample page fill the window. */
     html, body {
        height: 100%;
        width: 100%
        margin: 0;
        padding: 0;
    }
    </style>
    
</head>
<body>
    
<table border="1" width=100%  bgcolor="#F3F9F8">
<tr>
 
    <td><div id="panorama"></div>
    <td rowspan="2"> 

<input type="file" id="File" name="file" multiple />
<div id="Layer1" style="position:relative; z-index:1; layer-background-color: #99CCCC; border: 1px none #000000; height: 600px;">
<div style="width:100%; height:100%; overflow:scroll; position:relative;">
<div id="result_block" class="hidden">
  
  <div id="result"></div>
  <img id="mainImg" />
</div>
</div>
</div>
</td>

</td>
</tr>

<tr>   
<td> <div id="map" style="position:relative; height:320px; width: 1050px;"></div>
<script type="text/javascript" src ="zipy.js"></script> 
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNRx2H-9M3ml17X6lhcyH15H-FlSCT0S8&callback=initMap&libraries=drawing"></script>  


    <script>
        
        
        
        
      var map;
        
         var capas={};
        var aux;
        

          
  var infowindow;
      function initMap() {

  infowindow = new google.maps.InfoWindow();                  

          var markerShadow;
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 7.140961857443341, lng: -73.1208298355341},
          zoom: 17
        });
//Original Overlay for markers extracted from zip
        
          var drawingManager = new google.maps.drawing.DrawingManager({
          
          drawingControl: true,
          drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['marker', 'polyline', 'polygon']
          },
          markerOptions: {draggable:true 
           }, polygonOptions: { editable: true, draggable: true}, polylineOptions:{ draggable:true }, rectangleOptions: { editable: true, draggable: true}
        
          });
   



  /** @constructor */
 
    google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
      if(event.type == google.maps.drawing.OverlayType.POLYLINE) {
        alert("polyline complete");
      }
      else if(event.type == google.maps.drawing.OverlayType.MARKER) {
        var newMarker = event.overlay;
        newMarker.content = "marker #" +aux+ capas[aux]['0'].length;
        google.maps.event.addListener(newMarker, 'click', function() {
          infowindow.setContent(this.content);
          infowindow.open(map, this);
        });
        capas[aux]['0'].push(newMarker);
        document.getElementById("check:"+aux).checked=true;  
        /*var markerD=document.createElement("div");
            markerD.id="mark";
        var markerE=  document.createElement("div");
            markerE.id=
            markerE.onclick=function show(){
                
                map.setCenter({lat:capas[], lng: x[1]});
        document.getElementById("cap:"+aux).appendChild()
        
        }*/
          
          
      }
    });
          
          
     
                 
           form = "<form action=\"maps_form.php\" method=\"post\">"+
            
            "Name:<input type=\"text\" name=\"name\" value=\"\" /><br />"+
            "Msg:<input type=\"text\" name=\"msg\" value=\"\" /><br />"+
            "Link:<input type=\"text\" name=\"link\" value=\"\" /><br />"+
            "<input type=\"submit\" name=\"submit\" value=\"save\" />"+
          "</form>";
           
         /*
     google.maps.event.addListener(drawingManager, 'markercomplete', function (marker) {
                          
        var infowindow = new google.maps.InfoWindow({
          content: form
        });
         infowindow.open();
         drawingManager.setDrawingMode(null);  //Stop drawing
         var x= 0;
          //Agrega vector de marcadores.  
         
     });
        
         */
         
         
         
          // Create the DIV to hold the control and call the CenterControl()
        // constructor
        // passing in this DIV.
        var GreatDiv= document.createElement('div'); //Este es el 'super' Div que tiene a todo el cuadro
        GreatDiv.style="border:0px solid black;    width:240px;    height:200px;    overflow:auto;    background-color: white;";
        
          var leftControlDiv = document.createElement('div');
        
        leftControlDiv.id="containCar"; 
        leftControlDiv.innerHTML="  Proyecto";
        leftControlDiv.style="   width:100%;  border:0px solid black;  ";
        
        var lista = document.createElement('ul');
        var nuevaCapa = document.createElement('li');
        
          
          
        var insideLeftDiv = document.createElement('div');
        insideLeftDiv.id="capas";
        insideLeftDiv.style="padding:8px; width: 100%-padding;";
          
          
        var link = document.createElement('a');
        link.innerHTML='Nueva capa';
        link.href="#";
        link.id="link";
        link.setAttribute("onclick","nuevCapa(document.getElementById('capasD'))");  
        
        var capasDiv = document.createElement('div');
          capasDiv.style="border: 0px solid black; width:100%;height:68%;";
          capasDiv.innerHTML= "Capas: ";  
          capasDiv.id ="capasD";
          
          
    
          //Primer capa que se crea
            nuevCapa(capasDiv);      
    
          
          
          
          
          
          
          
          
          
          
    //Lista para el primer div con opciones de Crear Capa, descargar mapa, guardar.    
        nuevaCapa.appendChild(link);
        lista.appendChild(nuevaCapa);
        leftControlDiv.appendChild(lista);
          
      
        
        leftControlDiv.appendChild(insideLeftDiv);
        GreatDiv.appendChild(leftControlDiv);
          
         //Aca va contenido el conjunto de todos los divs de capas al dar click en "nueva capa"
        GreatDiv.appendChild(capasDiv);  
          map.controls[google.maps.ControlPosition.LEFT_CENTER].push(GreatDiv);
          
          
          
          
        drawingManager.setMap(map); 
    
          
          
  
}

        

        
        
        /*
Funcion que crea las capas
*
*
*/
function nuevCapa(capa){
    //Acá debe existir un
    var idAux;
    
    //var capa = document.getElementById("capasD")
    var insideDiv = document.createElement('div');
       insideDiv.class="cap";
        

   
 
    idAux = asignarId(Object.keys(capas));
    aux=idAux;
    
        
    
          insideDiv.id="cap:"+idAux;
        
        
        
        insideDiv.tabIndex='0';
        insideDiv.focus();
        
        insideDiv.onclick=function f(insideDiv){if(document.getElementById("check:"+this.id.split(":")[1]).checked==true){ aux=parseInt(this.id.split(":")[1]);}}
        insideDiv.style="padding:8px; width: 100%-padding; border: 1px solid black;";


    var CapaInside = document.createElement('div');
        CapaInside.id="capD:"+idAux;


    var ch= document.createElement('div');
       ch.classList.add("despleg");

    var checkedNuevo = document.createElement('input');
        checkedNuevo.type="checkbox";
        checkedNuevo.value = "Capa Sin Nombre "+capas.length;
        checkedNuevo.id="check:"+idAux;
        checkedNuevo.checked=true;
        checkedNuevo.setAttribute("onclick","muestraCapa(this.checked,this.id)")
     var atributo = document.createElement('label');
        atributo.id="label:"+idAux;
     atributo.innerHTML="Capa Sin Nomfbre "+idAux;


    var lab = document.createElement('div');
        lab.classList.add("despleg");

    ch.appendChild(checkedNuevo)
    CapaInside.appendChild(ch);
    lab.appendChild(atributo);
     CapaInside.appendChild(lab);
    
        CapaInside.style="padding:8px; width: 100%-padding;";
        insideDiv.appendChild(CapaInside); 
        capa.appendChild(insideDiv);
    
    capas[idAux]={0:[],1:[],2:[]};
    CapaInside=fareOptione(CapaInside);
}

        
        function fareOptione(CapaIns){
            

              //Div que contiene la imagen y la lista
            var divP=document.createElement("div");
                divP.classList.add("despleg");
            
            var listaGrande = document.createElement('ul');
               listaGrande.classList.add("lista");               
            var listaPequeña= document.createElement('li');
                listaPequeña.classList.add("lista");


      
            var imagenA=document.createElement("a");
            imagenA.href="#";
            var imagen = document.createElement("img");
            imagen.src="img/puntos-verticales.png" ;


            imagenA.appendChild(imagen);
            listaPequeña.appendChild(imagenA);

            



            
         

            //ul de opciones que contiene la lsita a volver desplegable
            var ul=document.createElement("ul");

            //Li que contiene el tag a para eliminar capa seleccionada
            var li = document.createElement("li");
            var aEli = document.createElement("a");
            aEli.id=CapaIns.id;
            aEli.innerHTML="Eliminar capa";
            aEli.href="#";
            aEli.onclick= function elimina(aEli){
                // arreglar por si sólo hay una capa activa
                var au=this.id.split(":")[1];
                document.getElementById("check:"+au).checked=false;
                muestraCapa(document.getElementById("check:"+au).checked,"elim:"+au)
                
                 for(i=0; i<3;i++){
                    for (marker in capas[au][i]){
        
                        capas[au][i][marker].setMap(null);}
                 }
                delete capas[au];
                document.getElementById("capasD").removeChild(document.getElementById("cap:"+au));
                if (Object.keys(capas).length==0){
                    aux=0;
                nuevCapa();
                    
                    
                }
                
            }
            
            //Aca se crea el li que modifica la capa
           var li2 = document.createElement("li");
            var cambiaNom = document.createElement("a");
             cambiaNom.href="#";
             cambiaNom.innerHTML = "cambiar Nombre de Capa";
             cambiaNom.id=CapaIns.id;
             cambiaNom.onclick = function cambia(cambiaNom){
                    var cambi= this.id.split(":")[1];
                    var nombre;
                    nombre=prompt('Ingrese el nombre de la capa:','');
                    document.getElementById("label:"+cambi).innerHTML=nombre;
             }
            
            
            li.appendChild(aEli);
            li2.appendChild(cambiaNom);
            ul.appendChild(li);
            ul.appendChild(li2);
            
            
            listaPequeña.appendChild(ul);
          
            
            listaGrande.appendChild(listaPequeña)
            divP.appendChild(listaGrande);

            CapaIns.appendChild(divP);
            return CapaIns;
        }
        
        
        //Para crear los Ids
        function asignarId(vector){
            var x=0;
            for ( var i=0 ; i<vector.length; i++){
                if (x<parseInt(vector[i])){
                
                  x=parseInt(vector[i]);
                     
                }
                
            }
            return x+=1;
            
            
        }
        
        
        
  function puntosCapa(titulo){
      aux=titulo.split(":")[1];
      
      
  }
        
        
function muestraCapa(check, nom){
    

    var x= nom.split(":")[1];
    if (check==true){
        aux = parseInt(x);
    }
    else{
         if (x==aux){
        for (var d=0;  d<Object.keys(capas).length; d++ ){
            if (Object.keys(capas)[d]==x){
                for (var j=d; j<Object.keys(capas).length;j++){
                    
                    if (Object.keys(capas)[j+1]!=null){
                        if (document.getElementById("check:"+Object.keys(capas)[j+1]).checked==true)
                        {
                            aux=parseInt(Object.keys(capas)[j+1]);
                        
                            break;}
                        
                    }
                    else{
                        
                        aux=Object.keys(capas)[0];
                        activar(true,aux);
                        d=Object.keys(capas).length;
                        break;
                                                

                    }
                }
            }
            
         }}}
    if (capas[x]!=null){
       activar(check,x);
    }
        
    }
    
function activar(valor,capaN){
    for(i=0; i<3;i++){
        for (marker in capas[capaN][i]){
            capas[capaN][i][marker].setVisible(valor);
            
        }
    }
}
         
    </script>

     
  </td>
</tr>


</table>

</body>
</html>