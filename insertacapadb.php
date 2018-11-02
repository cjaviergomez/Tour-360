<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include("conec.php"); 
$conn=conectarse(); 
$usuario = $_SESSION["identi"];

$idcapa = $_POST['idcapa'];
$nombreC = $_POST['nombre'];
$idproyecto = $_POST['idproyecto'];
$JSON = $_POST['json'];

$sql5="insert into capa (id_capa,nombre_capa,descripcion_capa,id_proyecto, json_capa) values ('$idcapa', '$nombreC', 'Nothing', '$idproyecto', '$JSON')";
$actualizar= pg_query($conn,$sql5);
   
?>