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
$idp = $_GET['id2'];

$sqldelete = "delete from proyecto where id_proyecto ='$idp'";
$eliminar = pg_query($conn, $sqldelete);

if($eliminar){
  header("Location: inicio.php");
}

?>
