<?php



include("conec.php"); 
$conn=conectarse(); 
$usuario = $_SESSION["identi"];

$idcapa = $_POST['idcapa'];
$nombreC = $_POST['nombre'];
$idproyecto = $_POST['idproyecto'];

$sql5="insert into capa (id_capa,nombre_capa,descripcion_capa,id_proyecto) values ('$idcapa', '$nombreC', 'Nothing', '$idproyecto')"; 
$actualizar= pg_query($conn,$sql5);


   
?>