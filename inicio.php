<?PHP
//Inicio la sesión
session_start();


if (!isset($_SESSION["nombre"])){ //Si la variable de la sesión NO existe, eso quiere decir que NO hay una sesión activa.

 header("Location: index3.html");  //echo "no inicio sesion";
            
}else{
          
  //no hago nada solo continuo en la pagina

}
require_once("menu.php");  //Para importar el menu y utilizarlo en la página.
include("conec.php"); 
$conn=conectarse(); 

$usuario = $_SESSION["identi"];

$sql5="select nombre_proyecto,descripcion_proyecto,id_proyecto from proyecto where id_usuario = '$usuario'"; 
$actualizar= pg_query($conn,$sql5); //Esta consulta averigua cuales son los proyectos que tiene el usuario.

$mf = new menuFijo();  //Se crea una instancia de la clase menu del script menu.php

?>
<!DOCTYPE html>
<html>
<head>
     
    <title>Bienvenido - TOUR 360°</title>

    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link href="css/menu.css" rel="stylesheet">  <!-- Estilo del menu -->
    <link href="css/animate.css" rel="stylesheet"> <!-- Estilo que le da animación a algunos elementos de la página (Foto)-->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="css/botonNP.css" rel="stylesheet"> <!--Estilo del botón "Nuevo Proyecto" -->
    <link href="img/logoGeomatica.png" rel="shorcut icon"> <!--Logo de la página -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> <!-- Estilo de la página en general ¡IMPORTANTE!-->
   
    <link href="css/tabla.css" rel="stylesheet"> <!-- Estilo de la tabla de proyectos -->
    <link href="css/fuentePrincipal.css" rel="stylesheet"> <!--Implementación de una fuente de google para el texto de la página -->
    <link href="css/default.css" rel="stylesheet">
</head>
<body>
<div id="header">
	<?PHP
	 $mf->obtenerMenu();  //Se obtiene el menu desde el script menu.php
	?>
</div>

<div  style=" background:#F2F2F2 url('img/bg3.png') " >
      <br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
                    <div class="section-title mb60 text-center">
                        <!-- section title start-->
                        <div align="center">
                          <h3 class="titulo wow fadeInDown" data-wow-delay="0.1s" >TOUR 360°</h3>
                        	<h2 class="titulo wow fadeInDown" data-wow-delay="0.1s" >¡Bienvenido!</h2>
                        
                         	<figure  class="post wow fadeInUp" data-wow-delay="0.7s">
                        		<img  class="img-circle"  src= <?php echo $_SESSION["foto"];?>   height="150" width="150"> 
                         	</figure> 
                      	</div>
                         
                    </div>
                </div>
            </div>
        </div>

        <br><br><br>
       
    </div>
  <?PHP    
   $fias=pg_num_rows($actualizar);
   if($fias>0){
		 echo "    <div align='center'>
                        <h2 class='titulo wow fadeInDown' data-wow-delay='0.1s' >Tus proyectos son: </h2>
                    </div>
                    <table class='margenpeque'> 
                        <thead>
                            <TR> 
                            	<TH>&nbsp;&nbsp;Nombre del proyecto</TH>
                            	<TH>&nbsp;&nbsp;Descripción</TH>
                            	<TH colspan='2' align='center'>Acciones</TH>
                            </TR> 
                        </thead> ";

          while ($row1=pg_fetch_array($actualizar)) 
              { 
                      $nombrep=$row1["0"];
                      $descripcionp=$row1["1"];
                      $idp = $row1["2"];
                    
                      //echo "<tbody>";
                      echo "<tr>"; 

                      echo "<td>";   
                      echo "<b><a href='Home.php?id=$idp' target='_blank'>";  
                      echo $nombrep; 
                      echo "</a></b>";                  
                      echo "</td>";

                      echo "<td>";
                      echo $descripcionp;
                      echo "</td>";

                      echo "<td>";   
                      echo "<b><a href='inicioeliminarproyecto.php?id=$idp'>";  
                      echo "ELIMINAR"; 
                      echo "</a></b>";                  
                      echo "</td>";

                      echo "<td>";   
                      echo "<b><a href='inicioeditarproyecto.php?id=$idp'>";  
                      echo "MODIFICAR"; 
                      echo "</a></b>";                  
                      echo "</td>";

                      echo "</tr>";
                     // echo "</table>";
              }  

              echo "</table>
              <div align='center'>
                
                <a href='inicionuevoproyecto.php'> <button type='button' class='boton_personalizado_p'> (+) Nuevo Proyecto</button> </a>
                </div>";

            } else {


              echo "
              	<div align='center'>
                <hgroup class='titulos-wrap'>
                  <h3 class='subtitulo wow bounceIn' data-wow-delay='0.3s'>No tienes proyectos creados todavía.</h3>
                  <h3 class='subtitulo wow bounceIn' data-wow-delay='0.3s'>Puedes crear un nuevo proyecto.</h3>
                </hgroup>
                </div>
                <div align='center'>
                <a href='inicionuevoproyecto.php'> <button type='button' class='boton_personalizado_p'>(+) Nuevo Proyecto</button> </a>
                </div>";
            }

      pg_free_result($actualizar); 
      pg_close($conn);    
?> 

</body>
<script type="text/javascript" src="js/wow.min.js"></script>  <!-- Script que permite la animación del contenido de la página -->
<!-- Script que permite la animación del contenido de la página -->
<script>     
  new WOW().init();    
</script> 
</html>