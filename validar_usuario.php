<?PHP
         session_start();


         error_reporting(E_ALL);
         ini_set('display_errors', '1');

		//vemos si el usuario y contraseña es válido
		 include("conec.php"); 
		 $conn=conectarse(); 

         $usuario = pg_escape_string($conn, $_POST["email"]);
         $clave = pg_escape_string($conn, $_POST["password"]);


		$sql1="select * from usuario where id_usuario='$usuario' and password_usuario ='$clave' ";
		$result1 = pg_query($conn,$sql1);
	    $ciclo=pg_num_rows($result1);


	                   if ($ciclo==0) 
						{

						//	echo "no encontre nada :)";
						header("Location: index2.html");
                        exit();

						}
						else 
						{
                           // echo " encontre algo :)";

						   $row1 = pg_fetch_array($result1);
						   $nombre = $row1["nombre_usuario"];
						   $foto = $row1["id_imagen"];
						   

						   $_SESSION["identi"] =$usuario; 
						   $_SESSION["nombre"]= $nombre;
						   $_SESSION["foto"] = $foto;
						  
							
						   header("Location: inicio.php");
						   exit(); 	
						}
						


?>

		