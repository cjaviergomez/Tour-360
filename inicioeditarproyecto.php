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
   $idp = $_GET['id'];




  $sql5="select nombre_proyecto,descripcion_proyecto,id_proyecto from proyecto where id_usuario = '$usuario'"; 
  $actualizar= pg_query($conn,$sql5);

  $sql6 = "select nombre_proyecto, descripcion_proyecto from proyecto where id_proyecto = '$idp'";
  $actualizar2= pg_query($conn,$sql6);

  $row2=pg_fetch_array($actualizar2);
  $nombrep2 = $row2["0"];
  $descripcionp2 = $row2["1"];

?>
<!DOCTYPE html>
<html>
<head>
     
    <title>Bienvenido - TOUR 360°</title>
    <meta charset="utf-8"> 

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link href="css/menu.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
        <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Style -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/modal.css" rel="stylesheet">


    <link rel="stylesheet" href="css/login.css">
    <link rel="shorcut icon" href="img/logoGeomatica.jpg">
    <link rel="stylesheet" href="css/normalize.css">

    <link href="css/StyleSheet.css" type="text/css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
   
    <link rel="stylesheet" href="css/responsiveslides.css">
    <link rel="stylesheet" href="css/tabla.css">
    <script src="js/responsiveslides.js"></script> 
     <script src="js/smooth-scroll.min.js"></script>

    <script>

        var scroll = new SmoothScroll('a[href*="#"]', {
    // Selectors
    ignore: '[data-scroll-ignore]', // Selector for links to ignore (must be a valid CSS selector)
    header: null, // Selector for fixed headers (must be a valid CSS selector)

    // Speed & Easing
    speed: 700, // Integer. How fast to complete the scroll in milliseconds
    offset: 0, // Integer or Function returning an integer. How far to offset the scrolling anchor location in pixels
    easing: 'easeInOutCubic', // Easing pattern to use
    customEasing: function (time) {}, // Function. Custom easing pattern

    // Callback API
    before: function () {}, // Callback to run before scroll
    after: function () {} // Callback to run after scroll
     });
        


    </script>
     <script>
        $(document).ready(function(){
            $("#slider-home").responsiveSlides({    
                speed:500,      
                nav: true,
                namespace: 'slid-btns',
                titleAnimation: 'bounceIn'
            });
        });
    </script>



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
                        <div align="center">
                        <h2 class="titulo wow fadeInDown" data-wow-delay="0.1s" >Bienvenido</h2>
                        <h4 class="titulo wow fadeInDown" data-wow-delay="0.1s" >TOUR 360°</h4>
                        

                         <figure  class="post wow fadeInUp" data-wow-delay="0.7s">
                        <img  class="img-circle"  src= <?php echo $_SESSION["foto"];?>   height="150" width="150"> 
                         </figure> 
                      </div>
                         
                    </div>
                    <!-- /.section title start-->


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

                <hgroup class='titulos-wrap'>
                  <h3 class='subtitulo wow bounceIn' data-wow-delay='0.3s'>No tienes proyectos creados todavia.</h3>
                  <h3 class='subtitulo wow bounceIn' data-wow-delay='0.3s'>Puedes crear uno nuevo proyecto.</h3>
                </hgroup>
                <div align='center'>
                <a href='inicionuevoproyecto.php'> <button type='button' class='boton_personalizado_p'>(+) Nuevo Proyecto</button> </a>
                </div>";
            }

      pg_free_result($actualizar); 
      pg_close($conn);  

   
?> 

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


    <!-- aqui pusimos el modal!!!!!!!!!!!!!!!!!!!!!!!!!!!!111111 -->

<div class="form-group">
  <div class="col-sm-6">
<!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      
         <br> <br> <br> 
         <?PHP

         echo "
          <form action='editarproyectodb.php?id=$idp' method='post'>
          <label for='nombreproyecto'>Editar Nombre del Proyecto</label>
          <input type='text' id='nombreproyecto' class='nombreproyecto' name = 'nombreproyecto' maxlength='256' value= '$nombrep2' required />
          <br>
          <label for='desproyecto'>Editar Descripción del Proyecto</label>
          <input type='text' id='desproyecto' class='desproyecto' name = 'desproyecto' maxlength='456' value= '$descripcionp2' required />
          <br>
          <div class='inputGroup inputGroup3'>
            <button id='login'>Editar</button>
          </div>
        
        </form>
        ";
        ?>
    
     
   
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

    <script type="text/javascript">  //Script para ejecutar el modal
    $(window).on('load',function(){
        $('#myModal2').modal('show');
    });
</script>

</body>
<script src="bootstrap-modal.js"></script>



<script type="text/javascript" src="js/wow.min.js"></script>
<script>    
  new WOW().init();    
</script>
</html>
