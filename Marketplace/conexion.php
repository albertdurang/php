<?php  
function Conectarse()  
{    
   if (!($link=mysqli_connect("127.0.0.1","root","","marketplace")))
   {  
      echo "Error conectando a la base de datos.";  
      exit();  
   }
   
$connect = mysqli_connect("127.0.0.1", "root", "");
$db = mysqli_select_db( $connect, "marketplace" );
   return $db;  
}  
?>  