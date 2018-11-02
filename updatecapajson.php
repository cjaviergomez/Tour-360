<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


include("conec.php"); 
$conn=conectarse(); 
$usuario = $_SESSION["identi"];

$idcapa = $_POST['idcapa'];
$archivoJ = $_POST['archivo'];
$idproyecto = $_POST['idproyecto'];

$sql5="UPDATE capa SET json_capa ='$archivoJ' WHERE  id_capa='$idcapa' AND id_proyecto='$idproyecto'"; 
$actualizar= pg_query($conn,$sql5);
   
?>