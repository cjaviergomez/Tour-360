<?PHP

//Inicio la sesión
session_start();

if ($_SESSION["nombre"]==""){

header("Location: index3.html");

  //echo "no inicio sesion";
            

}else{
          
  //no hago nada solo continuo en la pagina

}


?>

<!DOCTYPE html>
<html>
<head>
     
    <title>Foto - TOUR 360°</title>
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
      <br><br><br>


        <div class="container">


            <div class="row">

                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
                      <div class="section-title mb60 text-center">
                        <!-- section title start-->
                        <h2 class="titulo wow fadeInDown" data-wow-delay="0.1s" >Tour 360</h2>
                        <h4 class="titulo wow fadeInDown" data-wow-delay="0.1s" >Grupo de Investigación</h4>
                        <h5 class="small-title">Geomatica</h5> <br><br><br><br><br><br>

             <div align="center"> 
              <br><br><br><br><br><br> <br><br><br><br><br><br> <br><br>            
                           
             <form method="post" action="up_foto2usuario.php" enctype="multipart/form-data">

                 <br>

                <center> <input type="file"  name="archivo" required/><br></center>



                        
                 <input  class="btn" type="submit" value="subir" name="subir">                    
            
            </form> 
        </div>


                    </div>
                    <!-- /.section title start-->


                </div>
            </div>

        </div>

        
       
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