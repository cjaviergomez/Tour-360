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
include("conec.php"); 
$conn=conectarse();

$usuario = $_SESSION["identi"];
$clave=$_POST["clave"];
$newclave=$_POST["mi_clave"];



$sql1=" select * from usuario where id_usuario='$usuario' and password_usuario='$clave' ";
$result1 = pg_query($conn,$sql1);

$check=pg_num_rows($result1);


if($check > 0){
  $sql5=" update usuario set password_usuario='$newclave' where id_usuario='$usuario'"; 
  $actualizar= pg_query($conn,$sql5);     
}

?>

<!DOCTYPE html>
<html>
<head>
     
    <title>Cambiar Clave</title>
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="css/menu.css" rel="stylesheet">  <!-- Estilo del menu -->
    <link href="css/animate.css" rel="stylesheet"> <!-- Estilo que le da animación a algunos elementos de la página (Foto)-->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="img/logoGeomatica.png" rel="shorcut icon"> <!--Logo de la página -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> <!-- Estilo de la página en general ¡IMPORTANTE!-->
    <link href="css/fuentePrincipal.css" rel="stylesheet"> <!--Implementación de una fuente de google para el texto de la página --> 
    <link rel="stylesheet" href="css/default.css">
</head>
<body>

<div id="header">
  <?PHP
     $mf->obtenerMenu();  //Se obtiene el menu desde el script menu.php
   ?>
</div>
<div  style=" background:#F2F2F2 url('img/bg3.png')">
  <br><br><br>
  <div class="container">
    <div class="row">
      <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
        <div class="section-title mb60 text-center">
          <h2 class="titulo wow fadeInDown" data-wow-delay="0.1s" >Tour 360° </h2>
          <h5 class="titulo wow fadeInDown" data-wow-delay="0.1s" >Grupo de Investigación</h5>
          <h4 class="small-title">Geomática</h4> <br>

        <?PHP    

        if($actualizar==True){ 
         echo "  
         <hgroup class='titulos-wrap'>
          <h3 class='titulo wow fadeIn' data-wow-delay='0.3s'>La clave fue modificada exitosamente</h3>
        </hgroup>";

}else{


              echo "  

                   <hgroup class='titulos-wrap'>
                    <h3 class='titulo wow fadeIn' data-wow-delay='0.3s'>La clave no se pudo modificar, parece que escribiste mal tu antigua clave.</h3>
                  </hgroup>

                  <center> <a href='clave_usuario.php'><input class='btn btn-primary'  value='Intetarlo de nuevo'> </a>  </center>";

}


  pg_free_result($result1); 
  pg_free_result($actualizar); 
  pg_close($conn); 


  
?> 

                    </div>
                   
                </div>
            </div>

        </div>

        <br><br><br>
       
    </div>

</body>
<script type="text/javascript" src="js/wow.min.js"></script>
<script>    
  new WOW().init();    
</script>
</html>