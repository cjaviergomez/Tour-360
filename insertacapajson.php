<?php
include("conec.php"); 
$conn=conectarse(); 
$usuario = $_SESSION["identi"];

$idcapa = $_POST['idcapa'];
$archivoJ = $_POST['archivo'];
$idproyecto = $_POST['idproyecto'];

$sql5="UPDATE capa SET archivo='$archivoJ' WHERE  id_capa='$idcapa' AND id_proyecto='$idproyecto'"; 
$actualizar= pg_query($conn,$sql5);
   
?>