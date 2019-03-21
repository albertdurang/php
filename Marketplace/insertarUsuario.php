<?php  
 session_start();  
 $connect = mysqli_connect("127.0.0.1", "root", "", "marketplace");
 if(isset($_POST["actionActusu"]))  
 {  
     $query = "  
      SELECT  
       Usuario, Nombres, Apellidos, Rut, FechaSuscripcion, Email, clave, Telefono
       FROM tbl_usuario where Usuario ='".$_SESSION['username']."'";
      
      $result = mysqli_query($connect, $query);
      mysqli_close($connect);
      if(mysqli_num_rows($result) > 0)  
      {
        while ($columna = mysqli_fetch_array( $result)){
               
           echo $columna[0] . "_" . $columna[1] ."_" . $columna[2] . "_" . $columna[3] . "_" . $columna[4] ."_" . $columna[5]."_" . $columna[6]."_" . $columna[7]."_"  ;
        }
           
      }  
      else  
      {  
           echo 'No';  
      }
 }
 if(isset($_POST["usernamereg"]))  
 {
   
      $query = "INSERT INTO tbl_usuario (Usuario,Nombres, Apellidos,Rut,FechaSuscripcion, Estado, Email, clave, Telefono)
            VALUES ('".$_POST["usernamereg"]."' , '".$_POST["nombrereg"]."', '".$_POST["apellidoreg"]."', '".$_POST["rutreg"]."',
            now(), '1', '".$_POST["emailreg"]."', '".$_POST["passwordreg"]."', ".$_POST["telefonoreg"].")";
      
      if(mysqli_query($connect, $query)){
        echo 'Yes';  
      }
      else{
        echo 'No';  
      }
      
      mysqli_close($connect);
    
 }
  
 if(isset($_POST["updateusuario"]))  
 {
     
      $query = "update tbl_usuario set   Nombres='".$_POST['nombrereg']."',
                Apellidos='".$_POST['apellidoreg']."',
                Rut='".$_POST['rutreg']."',
                Email='".$_POST['emailreg']."',
                 clave='".$_POST['passwordreg']."',
                 Telefono=".$_POST['telefonoreg']."  where Usuario='".$_POST['usernamereg1']."'";
                 
      if(mysqli_query($connect, $query)){
        echo 'Yes';  
      }
      else{
        echo 'No';  
      }
      
      mysqli_close($connect);
    
 }
 if(isset($_POST["action"]))  
 {  
      unset($_SESSION["username"]);  
 }  
 ?>  