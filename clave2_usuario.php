<?PHP

//Inicio la sesión
session_start();

if ($_SESSION["nombre"]==""){

 header("Location: index3.html");

  //echo "no inicio sesion";
            

}else{
          
  //no hago nada solo continuo en la pagina

}


  include("conec.php"); 
  $conn=conectarse();

$usuario = $_SESSION["identi"];
$clave=$_POST["clave"];
$newclave=$_POST["mi_clave"];

//echo "id-->", $usuario;
//echo "clave--->", $clave;
//echo "new clave-->", $newclave;

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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Hair salon templates for mens hair cut service provider.">
    <meta name="keywords" content="hair salon website templates free download, html5 template, free responsive website templates, website layout,html5 website templates, template for website design, beauty HTML5 templates, cosmetics website templates free download">
    

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Style -->
    <link href="css/style.css" rel="stylesheet">



    <link rel="stylesheet" href="css/login.css">
    <link rel="shorcut icon" href="img/logoGeomatica.jpg">
    <link rel="stylesheet" href="css/normalize.css">

    <link href="css/StyleSheet.css" type="text/css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/responsiveslides.css">
    <script src="js/responsiveslides.js"></script>  


    <link rel="stylesheet" href="css/default.css">
    <link href="css/menu.css" rel="stylesheet">


    


    
    <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->  

</head>
<body>

<div id="header">
                            <ul class="nav">
                                <li><a href="inicio.php">Inicio</a></li>
                                <li>    

                                <button  style="border: #FFF 1px solid; background-color: #FFF">
                                  <figure  class="post2 wow fadeIn" data-wow-delay="0.2s">
                                    <img data-toggle="dropdown" class="img-circle" src= <?php echo $_SESSION["foto"];?> height="45" width="45" > 
                                    <h5 data-toggle="dropdown"><?php echo $_SESSION["nombre"];?></h5>
                                  </figure>

                                </button>

                              <ul>
         
                                  <li><a href="confi_usuario.php">Configuracion</a></li>
                                  <li><a href="index.php">Cerrar sesion</a></li>
          
     
                              </ul>

        
                              </li>  
                           </ul>




                              

             </div>


    <div  style=" background:#F2F2F2 url('img/bg3.png') " >


        <div class="container">


            <div class="row">

                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
                      <div class="section-title mb60 text-center">
                        <!-- section title start-->
                        <h2 class="titulo wow fadeInDown" data-wow-delay="0.1s" >Tour 360</h2>
                        <h4 class="titulo wow fadeInDown" data-wow-delay="0.1s" >Grupo de Investigación</h4>
                        <h5 class="small-title">Geomatica</h5> <br>

                        

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

     <center> <a href='clave_admin.php'><input class='btn btn-primary'  value='Intetarlo de nuevo'> </a>  </center>


             "

              ;


}


  pg_free_result($result1); 
  pg_free_result($actualizar); 
  pg_close($conn); 


  
?> 

                    </div>
                    <!-- /.section title start-->


                </div>
            </div>

        </div>

        <br><br><br>
       
    </div>

 








<script type="text/javascript" src="js/login.js" ></script>



   <!-- /.footer-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) 

    <script src="js/jquery.min.js"></script> -->
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/menumaker.js"></script>
    <!-- sticky header -->
    <script src="js/jquery.sticky.js"></script>
    <script src="js/sticky-header.js"></script>

</body>
<script src="bootstrap-modal.js"></script>


<script type="text/javascript" src="js/wow.min.js"></script>
<script>    
  new WOW().init();    
</script>
</html>