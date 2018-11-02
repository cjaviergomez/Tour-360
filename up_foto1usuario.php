<?PHP
//Inicio la sesión
session_start();

if (!isset($_SESSION["nombre"])){  //Si la variable de la sesión NO existe, eso quiere decir que NO se ha iniciado sesión antes

header("Location: index3.html"); //echo "no inició sesion";
            

}else{
          
  //no hago nada solo continuo en la pagina

}
require_once("menu.php");  //Para importar el menu y utilizarlo en la página.
$mf = new menuFijo(); //Se crea una instancia de la clase menu del script menu.php
?>

<!DOCTYPE html>
<html>
<head>
     
    <title>Foto - TOUR 360°</title>
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="css/style.css" rel="stylesheet"> <!--Estilo para formularios -->

    <link href="css/menu.css" rel="stylesheet">  <!-- Estilo del menu -->
    <link href="css/animate.css" rel="stylesheet"> <!-- Estilo que le da animación a algunos elementos de la página (Foto)-->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="img/logoGeomatica.png" rel="shorcut icon"> <!--Logo de la página -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> <!-- Estilo de la página en general ¡IMPORTANTE!-->
    <link href="css/fuentePrincipal.css" rel="stylesheet"> <!--Implementación de una fuente de google para el texto de la página --> 

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
          <h2 class="titulo wow fadeInDown" data-wow-delay="0.1s" >Tour 360° </h2>
          <h5 class="titulo wow fadeInDown" data-wow-delay="0.1s" >Grupo de Investigación</h5>
          <h4 class="small-title">Geomática</h4><br><br><br><br><br><br>

          <div align="center"> 
            <br><br><br><br><br><br> <br><br><br><br><br>           
            <form method="post" action="up_foto2usuario.php" enctype="multipart/form-data">
              <br>
              <center> <input type="file"  name="archivo" accept="image/*" required/><br></center>
              <input  class="btn" type="submit" value="subir" name="subir">                    
            
            </form> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
<script type="text/javascript" src="js/wow.min.js"></script>  <!-- Script que permite la animación del contenido de la página -->
<!-- Script que permite la animación del contenido de la página -->
<!-- Implementación de la libreria anterior-->
<script>     
  new WOW().init();    
</script> 
</html>