                
/**
* Función para agregar una 'nueva capa' al mapa. 
* Sirve tanto para nueva capa, como para cargar una ya existente
*@param capa{string} - Es el nombre de la capa traído de la base de datos, en caso de ser vacío, indica que se esta creando por primera vez
*@param idcapaN{string} -El id se asigna dinámicamente, sin embargo si estamos cargando de la base de datos, ya estará previamente asignado.
*@nombrecapaN{string} - Último nombre asignado por el usuario. En caso de ser primera vez de creación, estará vacío el campo y tomará un valor por defecto
*@jsonCap {JSON}  - JSON con datos sobre los elementos agregados a la capa.
*/
function nuevCapa(capa, idcapaN,nombrecapaN,jsonCap){
    
    
    var idAux;
    eliminaActive("active");
    var insideDiv = document.createElement('div');
    insideDiv.classList.add("cap");
    if (idcapaN !="" ){
        //En caso de que se cree por primera vez
        idAux=parseInt(idcapaN.split(":")[1]);
        aux=idAux;
        jsonC[aux]=jsonCap;
    }
    else{
        insideDiv.className+=" active";
        idAux = asignarId(Object.keys(capas));
        aux=idAux;      
        jsonC[aux]=[];  
    }

    if ( aux==null){
        insideDiv.className+=" active";
        idAux = asignarId(Object.keys(capas));
        aux=idAux;      
        jsonC[aux]=[];      
    }    

    insideDiv.id="cap:"+idAux; //ID de la capa     
    insideDiv.tabIndex='0';
    insideDiv.focus();        
    insideDiv.onclick=function f(insideDiv){
        if (document.getElementById("check:"+this.id.split(":")[1])!=null){
            document.getElementById("check:"+this.id.split(":")[1]).checked=true;
            muestraCapa(true,this.id);
        }    
    };
  
    var CapaInside = document.createElement('div');
    CapaInside.id="capD:"+idAux;
    var ch= document.createElement('div'); // Div que contiene el check de la nueva capa -activa y desactiva
    ch.classList.add("despleg");

    var checkedNuevo = document.createElement('input');
    checkedNuevo.type="checkbox";
    checkedNuevo.value = "Capa "+capas.length;
    checkedNuevo.id="check:"+idAux;
    checkedNuevo.checked=true;
    checkedNuevo.setAttribute("onclick","muestraCapa(this.checked,this.id)");
  
    var atributo = document.createElement('label');
    atributo.id="label:"+idAux;

    if (nombrecapaN!=""){
        atributo.innerHTML = nombrecapaN; //Si la capa que se crea viene de una que ya está en la base de datos el nombre va a ser el que está en la base de datos

    }else{
        atributo.innerHTML="Capa Sin Nombre " + idAux; // Nombre de la capa por defecto
        //Aqui trabajamos con Ajax para mandar la informacion de la capa a uno script de php y este se encargue de incluir la información en la DB
        var Jprueba = JSON.stringify([]);
        $.ajax({
            data: {idcapa : insideDiv.id, nombre: atributo.innerHTML,json: Jprueba , idproyecto: idproyectoJ},
            type: "POST",
            url: "insertacapadb.php"
        });
    }
    
    var lab = document.createElement('div');
    lab.classList.add("despleg");
    
    ch.appendChild(checkedNuevo)
    CapaInside.appendChild(ch);
    lab.appendChild(atributo);
    CapaInside.appendChild(lab);
    CapaInside.classList.add("adentro");
    
    insideDiv.appendChild(CapaInside); 
    capa.appendChild(insideDiv);
    
    capas[idAux]={0:[],1:[],2:[]}; //Se crea la capa como un diccionario de 3 claves donde la clave 0 significa Point, 1 LineString y 2 polígono.
  
    CapaInside=hacerOpciones(CapaInside); //Crea la función editar y eliminar capa
    
    
    var elementoCapa=document.createElement("div");
    elementoCapa.title="div para los Pointes y polígonos";
    elementoCapa.id="div"+idAux;
    elementoCapa.className="showUl";

    var listaElementos = document.createElement("ul");
    listaElementos.id="lista:"+idAux;
    listaElementos.className="listaUl";
    if(jsonCap!=""){
        llenarMapa(jsonC[aux],listaElementos);
    }
        

    elementoCapa.appendChild(listaElementos);
    insideDiv.appendChild(elementoCapa);


}// Cierra nuevCapa

                
