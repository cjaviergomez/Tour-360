<?PHP

//Inicio la sesión
session_start();

if (!isset($_SESSION["nombre"])){ //Si la variable de la sesión NO existe, eso quiere decir que NO hay una sesión activa.
  header("Location: index3.html");  //echo "no inicio sesion";           
}else{
          
  //no hago nada solo continuo en la pagina

}

include("conec.php"); 
$conn=conectarse(); 
$nombrepr = pg_escape_string($conn, $_POST["nombreproyecto"]);
$descripcionpr = pg_escape_string($conn, $_POST["desproyecto"]);

$usuario = $_SESSION["identi"];
$sql = "insert into proyecto ( nombre_proyecto, id_usuario, descripcion_proyecto) values ('$nombrepr', '$usuario', '$descripcionpr') ";

$resultado= pg_query($conn,$sql);

if($resultado){
  header("Location: inicio.php");
}

?>
