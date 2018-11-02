 /*
 * Se utiliza para construir los formularios de los elementos del mapa, 
 * tanto al momento de crearlos, como en el instante en que posterior a 
 * trarelos desde la base de datos
 *
 *@param markId {int} - Entero que facilita la sistematización de los elementos a crear
 *@param nombre {string}- Es el nombre que recibirá el marcador.En caso de ser vacío se deja un valor por defecto.
 *@param descripcion {String} - Descripción traída de la base de datos o enviada con valor " " al crearlo
 *@param severidadL {String} - Es el valor que tomará el select creado, en caso de ser traído desde la BD.
 *@param visibilidadL {String} - Ocurre igual que con severidadL
 *@param dimensionamientoL {String} - También es un valor que se usará en un elemento html tipo select.
 *@param elementoDiv - Se envía el div del elemento que estará contenido en el div de la capa
 *@param longT { float } - Se utiliza en los marcadores con el fin de mostrar la posición actual
 *@param latT { float }- Se utiliza en los marcadores con el fin de mostrar la posición actual
 *@param editar {boolean} - Sirve para determinar si de entrada estará disponible o no la función editar.
 */
function agregarDivs(markId,nombre,descripcion,severidadL,visibilidadL,dimensionamientoL,elementoDiv,longT,latT,editar){
    
    
    if(nombre!=""){
          
        elementoDiv.innerHTML=nombre;
        }
    else{
        elementoDiv.innerHTML=elementoDiv.title+":"+markId;}
    var pos;
    if (elementoDiv.title=="Point"){
    elementoDiv.className = "PointLi";
            
    pos = 0;
    
            var severidad = document.createElement("SELECT");
        severidad.setAttribute("id", "map-infowindow-attr-select-severidad");
        document.body.appendChild(severidad);
         
        var alta = document.createElement("option");
        alta.setAttribute("value", "Alta");
        var altaTex = document.createTextNode("Alta");
        alta.appendChild(altaTex);

        var media = document.createElement("option");
        media.setAttribute("value", "Media");
        var mediaTex = document.createTextNode("Media");
        media.appendChild(mediaTex);
        var baja = document.createElement("option");
        baja.setAttribute("value", "Baja");
        var bajaTex = document.createTextNode("Baja");
        baja.appendChild(bajaTex);

        severidad.appendChild(alta)
        severidad.appendChild(media);
        severidad.appendChild(baja);
          
    
    
        var dimensionamiento = document.createElement("SELECT");
        dimensionamiento.setAttribute("id", "map-infowindow-attr-select-dimensionamiento");
        document.body.appendChild(dimensionamiento);

        var cumple = document.createElement("option");
        cumple.setAttribute("value", "Cumple");
        var cumpleTex = document.createTextNode("Cumple");
        cumple.appendChild(cumpleTex);

        var noCumple = document.createElement("option");
        noCumple.setAttribute("value", "No cumple");
        var noCumpleTex = document.createTextNode("No cumple");
        noCumple.appendChild(noCumpleTex);


        dimensionamiento.appendChild(cumple)
        dimensionamiento.appendChild(noCumple);
    
    
        var visibilidad = document.createElement("SELECT");
        visibilidad.setAttribute("id", "map-infowindow-attr-select-visibilidad");
        document.body.appendChild(visibilidad);

        var buena = document.createElement("option");
        
        buena.setAttribute("value", "Buena");
        var buenaTex = document.createTextNode("Buena");
        buena.appendChild(buenaTex);

        var regular = document.createElement("option");
        regular.setAttribute("value", "Regular");
        var regularTex = document.createTextNode("Regular");
        regular.appendChild(regularTex);

        var mala = document.createElement("option");
        mala.setAttribute("value", "Mala");
        var malaTex = document.createTextNode("Mala");
        mala.appendChild(malaTex);
        if (severidadL!="" && visibilidadL!="" && dimensionamientoL !=""){
            
            if (severidadL=="Alta"){severidad.selectedIndex=0}
            else if (severidadL=="Media"){severidad.selectedIndex=1;}
            else if (severidadL=="Baja"){severidad.selectedIndex=2;}
    
            if (visibilidadL=="Buena"){visibilidad.selectedIndex=0;}
            else if (visibilidadL=="Regular"){visibilidad.selectedIndex=1;}
            else if (visibilidadL=="Mala"){visibilidad.selectedIndex=2;}
            
            if (dimensionamientoL=="Cumple"){dimensionamiento.selectedIndex=0;}
            else {dimensionamiento.selectedIndex=1;}
              
              
        }
    
    
    
        visibilidad.appendChild(buena)
        visibilidad.appendChild(regular);
        visibilidad.appendChild(mala);
          
    
        
    }
    
    else if(elementoDiv.title=="LineString"){
    elementoDiv.className = "polylLi";
        }
    else if(elementoDiv.title=="Polygon"){
    elementoDiv.className = "polyGLi";
 
    }
    
    
    elementoDiv.id=elementoDiv.title+":"+markId;
    auE=markId;
    elementoDiv.addEventListener("click", function(elementoDiv) {
        var pos;
        if (elementoDiv.currentTarget.title=="Point"){
            pos = 0;
        }
        else if(elementoDiv.currentTarget.title=="LineString"){
    
    pos = 1;}
    else if(elementoDiv.currentTarget.title=="Polygon"){
    
    pos = 2;
    }
    
    aux=parseInt(this.parentElement.id.split(":")[1]);
    auE=parseInt(this.id.split(":")[1]);
        
             
            for (i=0; i<capas[aux][pos].length;i++){
                if(this.id.split(":")[1]==capas[aux][pos][i].id.split(":")[1]){
                    infowindow.setContent(capas[aux][pos][i].content);
                    if(elementoDiv.currentTarget.title!="Point"){
                    infowindow.setPosition({lat:capas[aux][pos][i].infoWCoord[0],lng:capas[aux][pos][i].infoWCoord[1] });}
                    infowindow.open(map,capas[aux][pos][i]);
                    break;
                }
            }

            eliminaActive("acti");
            this.className += " acti";
        });
          
        var iCont = document.createElement('div');
        iCont.id="map-infowindow-container";
        

        var dContN = document.createElement('div');
        dContN.id="map-infowindow-attr-nombre-value";

        dContN.className="Nombre";
        dContN.contentEditable = true;
        dContN.setAttribute("value",""+elementoDiv.id);
        
    
          
          
        var dContD = document.createElement('div');          
        dContD.id="map-infowindow-attr-description-value";
        dContD.className="Descripcion";
        dContD.contentEditable = true;
        dContD.setAttribute("value","Escribe descripción aquí");
         
        if(nombre!=""){
               
               dContN.innerHTML=nombre;
               dContD.innerHTML=descripcion;
               
           }
    
    
    
          
        var ulContTool = document.createElement('ul'); //Editar y Eliminar 
        ulContTool.id="infowindow-toolbar";
        ulContTool.className="listaTool";
       
        var btnGuardar = document.createElement('div'); //Editar y Eliminar 
        btnGuardar.id="infowindow-toolbar-save";
        btnGuardar.role="button";
        btnGuardar.className="button";
        btnGuardar.innerHTML="GUARDAR";
        btnGuardar.title=elementoDiv.id;
        
        btnGuardar.addEventListener("click",function guardame(btnGuardar){
            
             
            var x= document.getElementById(btnGuardar.currentTarget.title);
            if (document.getElementById("map-infowindow-attr-nombre-value").innerHTML!=""){
                 document.getElementById(btnGuardar.currentTarget.title).innerHTML=document.getElementById("map-infowindow-attr-nombre-value").innerHTML;
            }
            if (btnGuardar.currentTarget.title.split(":")[0]=="Point"){ elemento=0;}
            
            else if (btnGuardar.currentTarget.title.split(":")[0]=="LineString"){ elemento=1;}
            
            else if (btnGuardar.currentTarget.title.split(":")[0]=="Polygon"){ elemento=2;}
            for (var i=0; i<capas[aux][elemento].length; i++){
                  
                if (x.id==capas[aux][elemento][i].id){
                    
                      
                    
                    if (capas[aux][elemento][i].content.childNodes[0].innerHTML==""){
                        capas[aux][elemento][i].content.childNodes[0].innerHTML=capas[aux][elemento][i].content.childNodes[0].getAttribute("value");
                    }
                    var childNodes= capas[aux][elemento][i].content.childNodes;
                    
                    if (jsonC[aux].length!=0 && jsonC[aux].length!=null ){
                        for (j in jsonC[aux]){ 
                            if (x.id== jsonC[aux][j].properties.id){
                                
                                jsonC[aux][j].properties.nombre=childNodes[0].innerHTML;
                                if (x.title=="Point"){
                                jsonC[aux][j].properties.severidad=childNodes[2].value;
                                jsonC[aux][j].properties.dimensionamiento=childNodes[5].value;
                                jsonC[aux][j].properties.visibilidad=childNodes[8].value;                                    
                                jsonC[aux][j].properties.descripcion=childNodes[9].innerHTML;
                                      
              
                                    }
                                else{
                                                                
                                jsonC[aux][j].properties.descripcion=childNodes[1].innerHTML;
                                    
                                    
                                }
                            

                                
                             }
                             else if (parseInt(j)+1== jsonC[aux].length) {
                                 
                                 
                                 if (x.title=="Point"){
                                     
                                 jsonC[aux].push({"type":childNodes[0].getAttribute("value").split(":")[0],"properties":{"id":childNodes[0].getAttribute("value"),"nombre":childNodes[0].innerHTML,"severidad":childNodes[2].value,"dimensionamiento":childNodes[5].value,"visibilidad":childNodes[8].value ,"descripcion":childNodes[9].innerHTML,"latitud":capas[aux][elemento][i].getPosition().lat(),"longitud":capas[aux][elemento][i].getPosition().lng()}});
                                 }
                                 else {
                                     
                                     jsonC[aux].push({"type":childNodes[0].getAttribute("value").split(":")[0],"properties":{"id":childNodes[0].getAttribute("value"),"nombre":childNodes[0].innerHTML,"descripcion":childNodes[1].innerHTML,"coordenadas":capas[aux][elemento][i].coord,"infoWCoord":capas[aux][elemento][i].infoWCoord}});
                                 }
                                 
                                     
                 
                                 }
                            
                             }
                        }   
                    
                    else {
                        if (x.title=="Point"){
                            jsonC[aux].push({"type":childNodes[0].getAttribute("value").split(":")[0],"properties":{"id":childNodes[0].getAttribute("value"),"nombre":childNodes[0].innerHTML,"severidad":childNodes[2].value,"dimensionamiento":childNodes[5].value,"visibilidad":childNodes[8].value ,"descripcion":childNodes[9].innerHTML,"latitud":capas[aux][0][i].getPosition().lat(),"longitud":capas[aux][0][i].getPosition().lng()}});      
                        }
                        else {
                                     
                                     jsonC[aux].push({"type":childNodes[0].getAttribute("value").split(":")[0],"properties":{"id":childNodes[0].getAttribute("value"),"nombre":childNodes[0].innerHTML,"descripcion":childNodes[1].innerHTML,"coordenadas":capas[aux][elemento][i].coord,"infoWCoord":capas[aux][elemento][i].infoWCoord}});
                            
                            
                        }
                  } //Por si es cero
                    
                  break;
              
                }  
                     //envio al php los datos tomados;
               
                }
             $.ajax({
                      data: {idcapa : 'cap:'+aux, archivo: JSON.stringify(jsonC[aux]), idproyecto: idproyectoJ},
                      type: "POST",
                      url: "updatecapajson.php"
                            }); 

              
                       ocultar(x);
                    
                
          });
        var btnCancelar = document.createElement('div'); //Editar y Eliminar 
        btnCancelar.id="infowindow-toolbar-cancel";
        btnCancelar.className="buttonC";
        btnCancelar.role="button";
        
        btnCancelar.title=elementoDiv.id;
        btnCancelar.innerHTML="CANCELAR";          
        btnCancelar.addEventListener("click",function cancel(btnCancelar){
            var x;
            if(this.title.split(":")[0]=="Point"){x=0;}
            else if (this.title.split(":")[0]=="LineString"){x=1;}
            else if (this.title.split(":")[0]=="Polygon"){x=2;}
            
            if (document.getElementById("lista:"+aux).childElementCount==jsonC[aux].length){
                
                    for (i = 0; i<jsonC[aux].length;i++){
                        if (this.title==jsonC[aux][i].properties.id) //comparar
                            {
                                if (x==0){
                                    
                                     if (jsonC[aux][i].properties.severidad=="Alta"){document.getElementById("map-infowindow-attr-select-severidad").selectedIndex=0}
                                    else if (jsonC[aux][i].properties.severidad=="Media"){document.getElementById("map-infowindow-attr-select-severidad").selectedIndex=1;}
                                    else if (jsonC[aux][i].properties.severidad=="Baja"){document.getElementById("map-infowindow-attr-select-severidad").selectedIndex=2;}
                                    if (jsonC[aux][i].properties.visibilidad=="Buena"){document.getElementById("map-infowindow-attr-select-visibilidad").selectedIndex=0;}
                                    else if (jsonC[aux][i].properties.visibilidad=="Regular"){document.getElementById("map-infowindow-attr-select-visibilidad").selectedIndex=1;}
                                    else if (jsonC[aux][i].properties.visibilidad=="Mala"){document.getElementById("map-infowindow-attr-select-visibilidad").selectedIndex=2;}
                                    
                                    if (jsonC[aux][i].properties.dimensionamiento=="Cumple"){ document.getElementById("map-infowindow-attr-select-dimensionamiento").selectedIndex=0;}
                                    else {document.getElementById("map-infowindow-attr-select-dimensionamiento").selectedIndex=1;}
                                }
                                
                                    document.getElementById("map-infowindow-attr-description-value").innerHTML=jsonC[aux][i].properties.descripcion;
                                    document.getElementById("map-infowindow-attr-nombre-value").innerHTML=jsonC[aux][i].properties.nombre;
                                    ocultar(this);
                                //cargar los elementos nombre, descripción y demás.
                                
                        }
                        
                    }
                
                
            }
            else{
                eliminaMe(x,this.title);
            }});
          
          
        var liGuard = document.createElement('li');
        liGuard.id="guardar";
        liGuard.className="LIBTN";
        var liCancel = document.createElement('li');
        liCancel.id="cancelar";
        liCancel.className="LIBTN";
        var liEdit = document.createElement('li');
        liEdit.id="editar";        
        var liElim = document.createElement('li');
        liElim.id="eliminar";
          
        iCont.appendChild(dContN);
            if (elementoDiv.title=="Point"){
                    var ulContPos = document.createElement('ul'); // ul que tendrá la posición, se usa al final
        ulContPos.id="infowindow-meaurements";
        ulContPos.className="ulPosicion";
          
        var liLat = document.createElement('li');
        liLat.id="latitudId";
        
        liLatD = document.createElement('div');
        liLatD.id = "latitudDiv";
        liLatD.innerHTML=latT.toFixed(5)+",";
                
        var liLng = document.createElement('li');
        liLat.id="longitudId";
        
        liLongD = document.createElement('div');
        liLongD.id = "longitudDiv";
        liLongD.innerHTML=longT.toFixed(5);
        liLng.appendChild(liLongD);
        liLat.appendChild(liLatD);
        ulContPos.appendChild(liLat);
                
        ulContPos.appendChild(liLng);
                
        //[capas[1][0][0].getPosition().lat(),capas[1][0][0].getPosition().lng()]//SEGUIR ARREGLANDO!!!!! PILAS, NO SIRVE
          
        var severidadTag = document.createElement('label');
        severidadTag.innerHTML="Severidad: ";
        var dimensionamientoTag = document.createElement('label');
        dimensionamientoTag.innerHTML="Dimensionamiento: ";
        var visibilidadTag = document.createElement('label');
        visibilidadTag.innerHTML="Visibilidad: ";
                  
    
                iCont.appendChild(severidadTag);          
                iCont.appendChild(severidad);
                iCont.appendChild(document.createElement('br'));
                iCont.appendChild(dimensionamientoTag);
                iCont.appendChild(dimensionamiento);
                iCont.appendChild(document.createElement('br'));              

                iCont.appendChild(visibilidadTag);
                iCont.appendChild(visibilidad);

                
            }
                    
                    
        iCont.appendChild(dContD);
        
                
        var btnEditar = document.createElement('div');
            btnEditar.className="editarBut";
            
            btnEditar.title=elementoDiv.title;//si es point activa la edición de los tipo select
            btnEditar.addEventListener("click", function(btnEditar){
                
                edita(this);
                
                
                
            });    
        var btnEliminar = document.createElement('div');
            btnEliminar.className="eliminarBut";
            btnEliminar.title=elementoDiv.id;
            btnEliminar.addEventListener("click",function elimina(btnEliminar){
                 var x;
                if(this.title.split(":")[0]=="Point"){x=0;}
                else if (this.title.split(":")[0]=="LineString"){x=1;}
                else if (this.title.split(":")[0]=="Polygon"){x=2;}
                eliminaMe(x,this.title);
                for (i=0; i<jsonC[aux].length;i++){
                
                if (this.title==jsonC[aux][i].properties.id)  {
                    
                jsonC[aux].splice(i,1); //pos es la posición del vector a eliminar
                
                $.ajax({
                      data: {idcapa : 'cap:'+aux, archivo: JSON.stringify(jsonC[aux]), idproyecto: idproyectoJ},
                      type: "POST",
                      url: "updatecapajson.php"
                            }); 
                    
                break;
                  //  }  
                }}
                    
            });
        var iElim = document.createElement('i');
        iElim.className = "fas fa-trash fa-2x";
        btnEliminar.appendChild(iElim);
                
        var iEdit = document.createElement('i');
        iEdit.className="fas fa-pen-square fa-2x";
        btnEditar.appendChild(iEdit);
        
        
        liEdit.appendChild(btnEditar); //<i class="fas fa-pen-square fa-5x"></i>
                        
        liElim.appendChild(btnEliminar); //<i class="fas fa-trash fa-5x"></i>
        liGuard.appendChild(btnGuardar);
        liCancel.appendChild(btnCancelar);
        ulContTool.appendChild(liGuard);
        ulContTool.appendChild(liCancel);
        ulContTool.appendChild(liEdit);
        ulContTool.appendChild(liElim);
        
    if (elementoDiv.title=="Point"){
        iCont.appendChild(ulContPos);  }      
        iCont.appendChild(ulContTool);
        
        if (editar==true){
            
            liEdit.style.display="none";
            liElim.style.display="none";
            
            if (elementoDiv.title=="Point"){
                ulContPos.style.display="none";}
            
        }        
        else{
            
            liGuard.style.display="none";
            liCancel.style.display="none";
            
            if (elementoDiv.title=="Point"){ 
            severidad.setAttribute("disabled","");
            dimensionamiento.setAttribute("disabled","");
            visibilidad.setAttribute("disabled","");}
            
    
            dContN.style="border:0px; font-weight: bold";
            dContN.contentEditable=false;
            dContD.style="border:0px";
            dContD.contentEditable=false;
            
        }
        return iCont;
    }    
    