<?PHP
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
     
    <title>Cambiar Clave - TOUR 360°</title>
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

    <script src="js/validarclave.js" type="text/javascript"></script> <!-- Script para validar la nueva contraseña ingresada -->

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
          <h2 class="titulo wow fadeInDown" data-wow-delay="0.1s" >Tour 360° </h2>
          <h5 class="titulo wow fadeInDown" data-wow-delay="0.1s" >Grupo de Investigación</h5>
          <h4 class="small-title">Geomática</h4><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
          <div align="center">
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <form name="mi_formulario"  method="post" action="clave2_usuario.php" onSubmit="return validar_clave()">
              <p>Antigua Contraseña:&nbsp;&nbsp;&nbsp;<input type="password" name= "clave" maxlength=20 size="20" required/> </p>
              <p>Nueva Contraseña: &nbsp;&nbsp;&nbsp; <input type="password" name= "mi_clave" maxlength=20 size="20" required/> </p>
              <p>Repetir Contraseña: &nbsp;&nbsp; <input type="password" name="mi_clave2" maxlength=20 size="20" required/></p> <br>
              <input class="btn btn-primary" type="submit" value="Enviar">
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

</body>
<script type="text/javascript" src="js/wow.min.js"></script>  <!-- Script que permite la animación del contenido de la página -->
<!-- Script que permite la animación del contenido de la página -->
<script>     
  new WOW().init();    
</script> 
</html>