<?PHP

//Inicio la sesión
session_start();

if ($_SESSION["nombre"]==""){

 header("Location: index3.html");

  //echo "no inicio sesion";
            

}else{
          
  //no hago nada solo continuo en la pagina

}

$idproyecto = $_GET["id"];

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
<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
    <style>
        
        #link::before{
            content:url("img/overlay.png");
            
        }    
        
        .cap {
            border-left:6px solid #CED4D8;
            
            color: black;
            width: 100%;
            max-height: 142px;
            border: 1px solid black;
            }
        .cap active{
            border-left:6px solid #558abb;
        
        }        
        .active, .cap:hover{
            border-left:6px solid #558abb;
        }

        
        .adentro{
            
                    display:  grid;
                    grid-template-columns: 1fr 2fr 1fr;

                    padding:4px;
        }
        
        
        .despleg{
          display:inline-block;
        }
        
        .despleg img{
          cursor:pointer;
          margin-right: 1px;
          margin-bottom: 1px;
          margin-top: 1px;
          position: relative;
        }
        
        .showUl{
                
                max-height: 100px;
                overflow-y: auto;
            
            
        }
        .listaUl {
            list-style: none;
            cursor:pointer;
            display:block;
            
        }
        
      
    
        .listaLi acti{
                
            background: #cad4;
            
        }
        
        .acti, .listaLi:hover{
                
            background: #cad4;
            
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
   
    var  markId=0,polyId=0,LineId=0;
    


  /** @constructor */
          
          google.maps.event.addListener(map, 'click', function() {
    infowindow.close();
  });
          
 
    google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
      if(event.type == google.maps.drawing.OverlayType.POLYLINE) {
        alert("polyline complete");
        drawingManager.setDrawingMode(null);  
        var newPolyLine = event.overlay;   
            newPolyLine.name="poliLinea"+LineId;
          
          
      }
      else if(event.type == google.maps.drawing.OverlayType.MARKER) {
          
           form = "<form action=\"maps_form.php\" method=\"post\">"+
            
            "Nombre:<input type=\"text\" name=\"name\" value=\"\" /><br />"+
            "Tipo:<input type=\"text\" name=\"msg\" value=\"\" /><br />"+
            "Descripcion:<input type=\"text\" name=\"link\" value=\"\" /><br />"+
            "<input type=\"submit\" name=\"submit\" value=\"save\" />"+
          "</form>";
          
        var newMarker = event.overlay;
          
            newMarker.content =form;
            newMarker.id="marcador:"+markId;
            
              
          infowindow.setContent(newMarker.content);
            infowindow.open(map,newMarker);
              
            
          
        var markerLi =document.createElement("div");
            markerLi.innerHTML="marcador número:"+markId;
            markerLi.className="listaLi";
            markerLi.id="marcador:"+markId;
            markId+=1;
            markerLi.addEventListener("click", function(markerLi) {
                
                aux=parseInt(this.parentElement.id.split(":")[1]);
                
            for (i=0; i<capas[aux][0].length;i++){
             if(this.id.split(":")[1]==capas[aux][0][i].id.split(":")[1]){
                 
                 infowindow.setContent(capas[aux][0][i].content);
                 infowindow.open(map,capas[aux][0][i])
                 break;
             }
            }
            eliminaActive("acti");
            
            this.className += " acti";
            event.stopPropagation();
            
                
            
            });
          
          
      
     
            //map.setCenter{lat:capas[aux][0][]}    
        
        google.maps.event.addListener(newMarker, 'click', function() {
          infowindow.setContent(this.content);
          infowindow.open(map, this);
              
        });
          
        capas[aux]['0'].push(newMarker);
        document.getElementById("lista:"+aux).appendChild(markerLi);
        drawingManager.setDrawingMode(null);  
        if(document.getElementById("check:"+aux).checked ==false ){ // para activar la capa en la que se esta agregando puntos.
            document.getElementById("check:"+aux).checked =true;
            muestraCapa(true,"marcadorcapa:"+aux);
        } 
         
  }    
    
    else if (event.type == google.maps.drawing.OverlayType.POLYGON){
        
    }
    
    });
          
             
     

         
         
          // Create the DIV to hold the control and call the CenterControl()
        // constructor
        // passing in this DIV.
        var GreatDiv= document.createElement('div'); //Este es el 'super' Div que tiene a todo el cuadro
        GreatDiv.style="border:0px solid black;    width:240px;    height:240px;    overflow:auto;    background-color: white;";
        
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
          capasDiv.style="border: 0px solid black; width:100%;height:80%;";
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

        
        function eliminaActive(palabra){
            if (document.getElementsByClassName("cap").length!=0){
            var current = document.getElementsByClassName(""+palabra);
            if(current[0]!=null){
            current[0].className = current[0].className.replace(" "+palabra, "");
            }}
        }

        

        
        
        /*
Funcion que crea las capas
*
*
*/
function nuevCapa(capa){
    //Acá debe existir un
    var idAux;
    
    eliminaActive("active");
    var insideDiv = document.createElement('div');
       insideDiv.classList.add("cap");
        insideDiv.className+=" active";
                    
        
    idAux = asignarId(Object.keys(capas));
    aux=idAux;
    
        
    
    insideDiv.id="cap:"+idAux; //ID de la capa
        
        
        
    insideDiv.tabIndex='0';
    insideDiv.focus();
        
    insideDiv.onclick=function f(insideDiv){
        
        if(document.getElementById("check:"+this.id.split(":")[1])!=null){ 
                document.getElementById("check:"+this.id.split(":")[1]).checked=true;
                muestraCapa(true,this.id);
                
            }         
            
    };
        


    var CapaInside = document.createElement('div');
        CapaInside.id="capD:"+idAux;


    var ch= document.createElement('div');
       ch.classList.add("despleg");

    var checkedNuevo = document.createElement('input');
        checkedNuevo.type="checkbox";
        checkedNuevo.value = "Capa";
        checkedNuevo.id="check:"+idAux;
        checkedNuevo.checked=true;
        checkedNuevo.setAttribute("onclick","muestraCapa(this.checked,this.id)")
     var atributo = document.createElement('label');
        atributo.id="label:"+idAux;
     atributo.innerHTML="Capa Sin Nombre "+idAux; // Nombre de la capa

     //Aqui trabajamos con Ajax para mandar la informacion de la capa a uno script de php y este se encargue de incluir la información en la DB
     $.ajax({
     data: {idcapa : insideDiv.id, nombre: atributo.innerHTML, idproyecto: <?PHP echo $idproyecto ?>},
     type: "POST",
     url: "insertacapadb.php"
    }); 


    var lab = document.createElement('div');
        lab.classList.add("despleg");

    ch.appendChild(checkedNuevo)
    CapaInside.appendChild(ch);
    lab.appendChild(atributo);
     CapaInside.appendChild(lab);
    CapaInside.classList.add("adentro");
    
    insideDiv.appendChild(CapaInside); 
    capa.appendChild(insideDiv);
    
    capas[idAux]={0:[],1:[],2:[]};
    CapaInside=fareOptione(CapaInside);
    
    
    var elementoCapa=document.createElement("div");
        elementoCapa.title="div para los marcadores y polígonos";
        elementoCapa.id="div"+idAux;
        elementoCapa.className="showUl";
    var listaElementos = document.createElement("ul");
        listaElementos.id="lista:"+idAux;
        listaElementos.className="listaUl";
elementoCapa.appendChild(listaElementos);
insideDiv.appendChild(elementoCapa);
    
}

        
        function fareOptione(CapaIns){
            

              //Div que contiene la imagen y la lista
            var divP=document.createElement("div");
                divP.classList.add("despleg");
            
            var aEli=document.createElement("a");
            aEli.id=CapaIns.id;
            aEli.title="Eliminar capa";
            aEli.style="cursor:pointer";
            aEli.onclick= function elimina(aEli){
                // arreglar por si sólo hay una capa activa
                var nombre=prompt('teclee por favor ELIMINAR :','');
                if (nombre=="ELIMINAR"){ 
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
                nuevCapa(document.getElementById("capasD"));
                    
                    
                }
                
            }
            event.stopPropagation();
            
            }
            
            var iElimina = document.createElement("i");
                iElimina.className = "far fa-trash-alt";
            
         
            aEli.appendChild(iElimina);
            
            var cambiaNom = document.createElement("a");
                cambiaNom.id=CapaIns.id;
            
                cambiaNom.className = "Edit";
                cambiaNom.title="Cambiar Nombre a la capa"

                cambiaNom.style="cursor:pointer";

                cambiaNom.onclick = function cambia(cambiaNom){
                    
                    var cambi= this.id.split(":")[1];
                    var nombre;
                    nombre=prompt('Ingrese el nombre de la capa:','');
                    document.getElementById("label:"+cambi).innerHTML=nombre;

                    $.ajax({
                      data: {idcapa :'cap:'+this.id.split(":")[1], nombre: nombre, idproyecto: <?PHP echo $idproyecto ?>},
                      type: "POST",
                      url: "modifcarcapadb.php"
                    });
                    event.stopPropagation();
            
                }
            var iCambiaNom = document.createElement("i");
                iCambiaNom.className = "far fa-edit";
            
         
            cambiaNom.appendChild(iCambiaNom);
            divP.appendChild(cambiaNom);

            divP.appendChild(aEli);
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
        
        eliminaActive("active"); 
        document.getElementById("cap:"+aux).className+=" active";
        if (document.getElementById("lista:"+aux).style.display=="none"){
            document.getElementById("lista:"+aux).style.display="block";
        }
        
        if (capas[x]!=null && capas[x][0].length!=0){
            if (capas[x][0][0].getVisible()==false){
        
                activar(check,x);
            
            }
          }
    
    }
    else{
        activar(check,x);
        if (capas[x][0].length!=1){
    
               document.getElementById("lista:"+x).style.display="none";
             
                 
         if (x==aux){
                
        for (var d=0;  d<Object.keys(capas).length; d++ ){ //recorre todas las id de las capas creadas
            if (Object.keys(capas)[d]==x){ // para determinar a partir de dónde se buscarán capas activas
                 
                for (var j=d+1; j<Object.keys(capas).length+1;j++){ //segundo For para realizar la busqueda
                    
                    if (Object.keys(capas)[j]!=null){ //queremos saber si NO estamos en la última posición
                        if (document.getElementById("check:"+Object.keys(capas)[j]).checked==true) //y si en esa siguiente posición esta activa la capa
                        {
                            muestraCapa(true,"cap:"+Object.keys(capas)[j]);
                            
                            break;
                        }
                        if (j==d){ //recorrió todo el vector y no hay ninguno más que esté activo, así que pone por defecto la primer capa, pero la deja en     //modo desactivado hasta que un marcador sea lanzado ( en ese caso se activa la capa)
                            aux=Object.keys(capas)[0];
                            d=Object.keys(capas).length;
                            eliminaActive("active"); 
                            break;
                            
                            
                        }
                        
                    }
                    else{ //si es null el siguiente, volvemos a recorrer el vector hasta que llegue a ser j=d ( en ese caso ocurre otro evento)
                        j=-1;
                       
                    }
                }
                
            }
            
         }}}    }
    
  
    event.stopPropagation();

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