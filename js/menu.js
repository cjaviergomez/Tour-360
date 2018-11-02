ulGrande = document.createElement('ul');
ulGrande.className = "nav";
ulGrande.id="ulGrande";

liInicio =  document.createElement('li');
aInicio = document.createElement('a');
aInicio.innerHTML="Inicio";
aInicio.href="inicio.php";
liInicio.appendChild(aInicio);

liOpciones =  document.createElement('li');

btnImagen =  document.createElement('button');
btnImagen.style = "border: #FFF 1px solid; background-color: #FFF";
figureElement = document.createElement('figure');
figureElement.className="post2 wow fadeIn";
figureElement.setAttribute("data-wow-delay","0.2s");
figureElement.style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s;";
img = document.createElement('img');
img.setAttribute("data-toggle","dropdown");
img.className = "img-circle";
img.src= urlFoto; /* urlFoto es la variable definida que llevarà el src del php   <?php echo $_SESSION["foto"];?>*/
img.height = "45";
img.width = "45";

nombreFigura = document.createElement('h5');
nombreFigura.setAttribute("data-toggle","dropdown");
nombreFigura.innerHTML = nombreF; /*  NombreF es una variable <?php echo $_SESSION["nombre"];?> obtenida al inciar sesiòn*/

ulOpciones = document.createElement('ul'); //Lista que contiene las opciones configurar y cerrar sesión
liConfig =  document.createElement('li');// Item para configurar el perfil
aConfig = document.createElement('a');
aConfig.innerHTML = "Configuración";
aConfig.href="confi_usuario.php";
liConfig.appendChild(aConfig);

liCerrarS  = document.createElement('li'); //Item para cerrar sesión
aCerrarS  = document.createElement('a');
aCerrarS.innerHTML="Cerrar sesión";
aCerrarS.href="index2.php";
liCerrarS.appendChild(aCerrarS);

ulOpciones.appendChild(liConfig);
ulOpciones.appendChild(liCerrarS);

figureElement.appendChild(img);
figureElement.appendChild(nombreFigura);
btnImagen.appendChild(figureElement);




liOpciones.appendChild(btnImagen);
liOpciones.appendChild(ulOpciones);


ulGrande.appendChild(liInicio);
ulGrande.appendChild(liOpciones);
document.getElementById("header").appendChild(ulGrande);