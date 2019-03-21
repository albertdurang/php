<?php  
 session_start();  
 $connect = mysqli_connect("127.0.0.1", "root", "", "marketplace");
 if(isset($_POST["username"]))  
 {
   
      $query = "  
      SELECT * FROM tbl_usuario  
      WHERE Usuario  = '".$_POST["username"]."'  
      AND clave  = '".$_POST["password"]."'  
      ";  
      $result = mysqli_query($connect, $query);
      mysqli_close($connect);
      if(mysqli_num_rows($result) > 0)  
      {  
           $_SESSION['username'] = $_POST['username'];  
           echo 'Yes';  
      }  
      else  
      {  
           echo 'No';  
      }  
 }  
 if(isset($_POST["action"]))  
 {  
      unset($_SESSION["username"]);  
 }  
 ?>  