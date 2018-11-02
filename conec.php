<?PHP
function conectarse() 
{ 
   if (!($conn=pg_connect("host=localhost user=postgres port=5432 dbname=tour password=123456"))) 
   { 
      echo "Error conectando a la base de datos. Revisar contraseña"; 
      exit(); 
   } 
   
  if (!pg_dbname()) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
  return $conn; 
 
} 
  
?>
