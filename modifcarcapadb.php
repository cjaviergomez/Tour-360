<?php

include("conec.php"); 
$conn=conectarse(); 
$usuario = $_SESSION["identi"];

$idcapa = $_POST['idcapa'];
$nombreC = $_POST['nombre'];
$idproyecto = $_POST['idproyecto'];

$sql5="update capa set nombre_capa = '$nombreC' where id_capa = '$idcapa'"; 
$actualizar= pg_query($conn,$sql5);


   
?>