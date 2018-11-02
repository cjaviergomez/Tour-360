<?PHP

//Inicio la sesión
session_start();

include("conec.php"); 
$conn=conectarse(); 
$usuario = $_SESSION["identi"];
$idproyecto = $_GET["id"];

$sqlusuario = "select id_usuario from proyecto where id_proyecto = '$idproyecto'";
$consultusuario = pg_query($conn, $sqlusuario);
$ro = pg_fetch_array($consultusuario);
$id_usuario = $ro["0"];


if (!isset($_SESSION["nombre"])) {  //Si la variable de la sesión NO existe, eso quiere decir que NO se ha iniciado sesión antes
 
 header("Location: index3.html");
  //echo "no inicio sesion";
            
}else if(!isset($idproyecto)) {

  header("Location: inicio.php");

 }else if($id_usuario != $usuario){
  header("Location: inicio.php");
  }else{  

  //no hago nada solo continuo en la pagina
}

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

$nombrep = "select nombre_proyecto from proyecto where id_proyecto = '$idproyecto'";
$consult= pg_query($conn,$nombrep);
$row5=pg_fetch_array($consult);
$nombreproyecto=$row5["0"];

//Para saber si el proyecto tiene capas creadas.
$consultcapas = "select * from capa where id_proyecto = '$idproyecto' order by id_capa";
$sqlcapas = pg_query($conn, $consultcapas);

$numerocapas = pg_num_rows($sqlcapas); //Para saber el numero de capas encontradas en la consulta

?>
<html>
<head>
    <script type="text/javascript">
    var idproyectoJ= <?PHP echo $idproyecto ?> ;  //Necesario para realizar consultas e inserciones en la base de datos    
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <title>TOUR 360° - <?PHP echo $nombreproyecto; ?></title> 
    <link rel="stylesheet" type="text/css" href="css/estilohome.css">
    <link rel="stylesheet" href="https://cdn.pannellum.org/2.4/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.pannellum.org/2.4/pannellum.js"></script>
    <link rel="shorcut icon" href="img/logoGeomatica.png">
    <script type="text/javascript" src="js/exif.js"></script>
    <script type="text/javascript" src="js/jszip.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/estilogeneral.css"/>
    <link rel="stylesheet" type="text/css" href="css/divstyle.css"/>
    
    <script type="text/javascript" src="js/shpwrite.js"></script>
    <script type="text/javascript" src="js/nuevCapa.js"></script>
    <script type="text/javascript" src="js/hacerOpciones.js"></script>
    <script type="text/javascript" src="js/asignarId.js"></script>
    <script type="text/javascript" src="js/eliminateActive.js"></script>
    <script type="text/javascript" src="js/muestraCapa.js"></script>
    <script type="text/javascript" src="js/activar.js"></script>
    <script type="text/javascript" src="js/llenarMapa.js"></script>
    <script type="text/javascript" src="js/agregarDivs.js"></script>
    <script type="text/javascript" src="js/ocultar.js"></script>
    <script type="text/javascript" src="js/edita.js"></script>
    <script type="text/javascript" src="js/eliminaMe.js"></script>
    <script type="text/javascript" src="js/activarD.js"></script>
    <script type="text/javascript" src="js/exportShp.js"></script>   
</head>
<body>
    
<div id="global">

  <div id="galeria"> 
  	<div id="boton" align="left">
    	<input type="file" id="File" class="file-input" name="file" multiple accept="application/zip" placeholder="Ingresa aquí archivos .zip únicamente"  />
    </div>
    <div id="Layer1">
      <div id="scroll">
        <div id="result_block" class="hidden">
          <div id="result"></div>
          <img id="mainImg" />
        </div>

        </div>
      </div>
    </div>
  <div id="visor">
    <div id="flecha"></div>
    <div id="panorama"></div>
  </div>

  <div id="contenedormapa">
    <div id="map"></div>
      <script type="text/javascript" src ="js/zipy.js"></script> 
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNRx2H-9M3ml17X6lhcyH15H-FlSCT0S8&callback=initMap&libraries=drawing"></script>  
      <script>
        var map; // Variable que contiene el mapa y la barra de herramientas
        var capas={}; //Objeto que posibilita tener una clave (aux) con un valor (diccionario de 3 posibilidades {0:[],1:[],2:[]})
        var aux,auE; //Auxiliares que permiten moverse entre capas(aux) y entre elementos (auE)
        var infowindow;//Muestra los formularios para cada elemento
        var jsonC = {}; //Contiene los archivos a guardar en la base de datos.
        var  markId=1,polyId=1,LineId=1; //Necesarios para la asignación de ids en cada elemento

          
        function initMap() {
          infowindow = new google.maps.InfoWindow();                  
          var markerShadow;

          map = new google.maps.Map(document.getElementById('map'), {
                  center: {lat: 7.140961857443341, lng: -73.1208298355341},
                  zoom: 17,
                  streetViewControl: false,  //Deshabilita la opción de streetView del mapa.
                  zoomControl: true,          //Permite manipular el control del zoom.
                  keyboardShortcuts:false,    // Para no permitir el control del mapa mediante el teclado, esto a su vez permite ingresar todos los caracteres en los formularios.     
                  mapTypeId: 'satellite',     
                  
                  zoomControlOptions:{
                    position: google.maps.ControlPosition.RIGHT_TOP     //Mueve el control zoom a la parte superior derecha.
                  },
                  mapTypeControl: true,    //Permite manipular el control de los tipos de mapas.
                  mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,     //Le define el estilo del control de tipos de mapas. 
                    position: google.maps.ControlPosition.RIGHT_BOTTOM        //Posición del control de tipos de mapas.
                }
              });

          //Original Overlay for markers extracted from zip
                
          var drawingManager = new google.maps.drawing.DrawingManager({
                  drawingControl: true,
                  drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: ['marker', 'polyline', 'polygon']
                    },
                  markerOptions: {draggable:false}, 
                  polygonOptions: {  draggable: false},
                  polylineOptions:{ draggable:false }
                
                  });
            
          /** @constructor */
                  
          google.maps.event.addListener(map, 'click', function() {
            if(document.getElementById("map-infowindow-attr-nombre-value")!=null){
              if (document.getElementById("map-infowindow-attr-nombre-value").getAttribute("contenteditable")!="false"){
                  alert("Guarda los datos o cancela");
                }  
                  else{
                      infowindow.close();}}
            });
                  
         
          google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
              if(event.type == google.maps.drawing.OverlayType.POLYLINE) {

                var poliLi =document.createElement("div");
              poliLi.title="LineString";
          
          var newPolyLine = event.overlay;    
          
           var dicPos = newPolyLine.latLngs.b["0"].b;
            var dict= [];
          var j={};
          var centro=[0,0];
          for (i=0;i<dicPos.length;i++){
              j.lat=dicPos[i].lat();
              centro[0]+=j.lat;
              j.lng=dicPos[i].lng();
              
              centro[1]+=j.lng;
              dict.push(j);
              if (i==dicPos.length-1){
                  centro[0]=centro[0]/dicPos.length;
                  
                  centro[1]=centro[1]/dicPos.length;
              }    
          }
          
          
        var form = agregarDivs(LineId,"","","","","",poliLi,"",dict,true);
        newPolyLine.content =form;
        newPolyLine.id="LineString:"+LineId;
        infowindow.setContent(newPolyLine.content);
        infowindow.setPosition({lat:centro[0],lng:centro[1]});
        infowindow.open(map,newPolyLine);  
        LineId+=1;      
        newPolyLine.coord = newPolyLine.getPath().getArray();  //MODIFICADO 04/05 12:14.PM
        newPolyLine.infoWCoord = centro;
        //map.setCenter{lat:capas[aux][0][]}    
       
//          newPolyLine.addListener('click', showArrays);
      
                google.maps.event.addListener(newPolyLine, 'click', function() {
          infowindow.setContent(this.content);
                    
          infowindow.setPosition({lat:this.infoWCoord[0],lng:this.infoWCoord[1]});
             
          infowindow.open(map, this);
          
          auE=parseInt(this.id.split(":")[1]);
          activarD(this.id);
        });  
        capas[aux]['1'].push(newPolyLine);
          
        document.getElementById("lista:"+aux).appendChild(poliLi);
        drawingManager.setDrawingMode(null);  
        if(document.getElementById("check:"+aux).checked ==false ){ // para activar la capa en la que se esta agregando puntos.
            document.getElementById("check:"+aux).checked =true;
            muestraCapa(true,"polylínea:"+aux);
        }
          
          
          
      } else if(event.type == google.maps.drawing.OverlayType.MARKER) {
                  
                  
                  
                 var markerLi =document.createElement("div");
              markerLi.title="Point";
          var newMarker = event.overlay;
         
          var form = agregarDivs(markId,"","","","","",markerLi,newMarker.position.lng(),newMarker.position.lat(),true);
        newMarker.content =form;
        newMarker.id="Point:"+markId;
            
        infowindow.setContent(newMarker.content);
        infowindow.open(map,newMarker);
        
        markId+=1;      
       
     
            //map.setCenter{lat:capas[aux][0][]}    
        
        google.maps.event.addListener(newMarker, 'click', function() {
          infowindow.setContent(this.content);
          infowindow.open(map, this);
          auE=parseInt(this.id.split(":")[1]);
          activarD(this.id);
            //Falta traer al padre para saber en QUÉ CAPA ESTOY
              
        });
        
        //Revisar qué tanto de acá puedo llevar para la función, o crear una nueva función que pueda ser usada en los 3 lugares.
                  
                  
        capas[aux]['0'].push(newMarker);
        document.getElementById("lista:"+aux).appendChild(markerLi);
        drawingManager.setDrawingMode(null);  
        if(document.getElementById("check:"+aux).checked ==false ){ // para activar la capa en la que se esta agregando puntos.

            document.getElementById("check:"+aux).checked =true;
            muestraCapa(true,"Pointcapa:"+aux);
        } 
         
      }  else if (event.type == google.maps.drawing.OverlayType.POLYGON){
           var polyGId= document.createElement('div');
          polyGId.title="Polygon";
          
          var newPoly = event.overlay;
        
           var dicPos = newPoly.latLngs.b["0"].b;
          var dict= [];
          var j={};
          
          var centro=[0,0];
          for (i=0;i<dicPos.length;i++){
              j.lat=dicPos[i].lat();  
              centro[0]+=j.lat;
              j.lng=dicPos[i].lng();
              centro[1]+=j.lng;
              dict.push(j);
              if (i==dicPos.length-1){
                  centro[0]=centro[0]/dicPos.length;
                  
                  centro[1]=centro[1]/dicPos.length;
              }    
              
          }
        
        newPoly.id="Polygon:"+polyId;
        var form = agregarDivs(polyId,"","","","","",polyGId,"",dict,true);
        newPoly.content =form;
        newPoly.coord=dict;
        infowindow.setContent(newPoly.content);
          
        infowindow.setPosition({lat:centro[0],lng:centro[1]});
        infowindow.open(map,newPoly);
        
        polyId+=1; 
        
        newPoly.coord = newPoly.getPath().getArray();  //MODIFICADO 04/05 12:14.PM
        newPoly.infoWCoord = centro;  
        google.maps.event.addListener(newPoly, 'click', function() {
          infowindow.setContent(this.content);
          
          infowindow.setPosition({lat:this.infoWCoord[0],lng:this.infoWCoord[1]});        
          infowindow.open(map, this);
          auE=parseInt(this.id.split(":")[1]);
          activarD(this.id);
        });  
        capas[aux]['2'].push(newPoly);
        document.getElementById("lista:"+aux).appendChild(polyGId);
        drawingManager.setDrawingMode(null);  
        if(document.getElementById("check:"+aux).checked ==false ){ // para activar la capa en la que se esta agregando puntos.
            document.getElementById("check:"+aux).checked =true;
            muestraCapa(true,"Polygon:"+aux);
        }
          
     }
    
    });
                       
          // Create the DIV to hold the control and call the CenterControl()
          // constructor
          // passing in this DIV.
          var GreatDiv= document.createElement('div'); //Este es el 'super' Div que tiene a todo el cuadro
          GreatDiv.style="border:0px solid black;    width:25%;    height:85%;  background-color: white; min-width:240px;";
                
          var leftControlDiv = document.createElement('div');
          leftControlDiv.id="containCar"; 
          leftControlDiv.style=" width:100%; height:100%; border:0px solid black; margin-top: 20px; margin-bottom: 10px;";

          var titulo = document.createElement('h2');
          titulo.innerHTML="  Proyecto: " + ' <?PHP echo $nombreproyecto; ?>';
          leftControlDiv.appendChild(titulo);
                
          var lista = document.createElement('ul');
          lista.className = "horizontal";
          var nuevaCapa = document.createElement('li');
          var descargar = document.createElement('li');
                

          var downloadP= document.createElement('div');
          downloadP.setAttribute("onclick","exportShp()");
          downloadP.className="downloadPoint";
          downloadP.id = "descarga";
          downloadP.innerHTML="Descargar Proyecto";

          var link = document.createElement('div');
          link.innerHTML='Nueva capa';
          link.className="selectCapa";
          link.id="link";
          link.setAttribute("onclick","nuevCapa(document.getElementById('capasD'),'','','')");  
          
          
          
                
          var capasDiv = document.createElement('div');
          capasDiv.style="border: 0px solid black; width:100%;  height:70%; overflow-y:auto;";
          capasDiv.innerHTML= "Capas: ";  
          capasDiv.id ="capasD";
                  
          //Codigo en PHP y Javascript para extraer de la base de datos la información de las capas y mostrarlas en el proyecto.
          <?PHP
             if($numerocapas > 0){
              while($row1=pg_fetch_array($sqlcapas)){
                $idcapa = $row1["0"];
                $nombrecapa = $row1["1"];
                //$descripcioncapa = $row1["2"];
                ?>
                    var jsonT =<?PHP echo $row1["4"];   ?>;

                
                        
                nuevCapa(capasDiv,"<?PHP echo $idcapa ?>", "<?PHP echo $nombrecapa ?>",jsonT);  //La función nuevCapa se encarga de crear las capas con sus atributos correspondientes.

                <?PHP  

                }
              ?>
              aux=parseInt(Object.keys(capas)[0]);
          <?PHP

              }else {
                ?>
                //Primer capa que se crea
                nuevCapa(capasDiv,"","","");   //En caso de que el proyecto no tenga ninguna capa creada, se crea una por defecto.   
              
                <?PHP 
                }

                ?>

                  
          //Lista para el primer div con opciones de Crear Capa, descargar mapa, guardar.    
          lista.appendChild(nuevaCapa);  //Agrega los li a la lista
          lista.appendChild(descargar);

          nuevaCapa.appendChild(link);    //Agrega el div de nueva capa al li de la lista
          descargar.appendChild(downloadP);  //Agrega el div de descargar proyecto al li de la lista


          leftControlDiv.appendChild(lista); //Agrega la lista al div leftControlDiv
          leftControlDiv.appendChild(capasDiv);

          GreatDiv.appendChild(leftControlDiv);
        
                  
          //Aca va contenido el conjunto de todos los divs de capas al dar click en "nueva capa"
          map.controls[google.maps.ControlPosition.LEFT_CENTER].push(GreatDiv);
                  
          drawingManager.setMap(map);             
                
        } // Cierra función initMap   
        
</script>
 
  </div>

</div>

</body>
</html>