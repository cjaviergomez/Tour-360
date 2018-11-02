<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include("conec.php"); 
$conn=conectarse(); 
$usuario = $_SESSION["identi"];

$idcapa = $_POST['idcapa'];
$idproyecto = $_POST['idproyecto'];

$sql5="delete from capa WHERE id_capa = '$idcapa' AND id_proyecto = '$idproyecto'";
$actualizar= pg_query($conn,$sql5);


   
?>