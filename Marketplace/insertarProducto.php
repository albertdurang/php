<?php  
 session_start();  
 $connect = mysqli_connect("127.0.0.1", "root", "", "marketplace");
   
if(isset($_POST["insventa"]))  
 {
      $query = "INSERT INTO tbl_venta(usuario, id_producto,valor, cantidad, total,estado)
            VALUES ('".$_SESSION['username']."' , ".$_POST['idproducto'].", ".$_POST['valor_prod'].", ".$_POST['cantidad'].",".$_POST['total'].", 1)";
      
      if(mysqli_query($connect, $query)){
        echo 'Yes';  
      }
      else{
        echo 'No';  
      }
      
      mysqli_close($connect);
    
 }
 if(isset($_POST["nombre_prod"]))  
 {
   
      $query = "INSERT INTO tbl_producto(nombre_prod, desc_prod, valor_prod, cant_prod, usuario, estado_prod)
            VALUES ('".$_POST["nombre_prod"]."' , '".$_POST["desc_prod"]."', ".$_POST["valor_prod"].", ".$_POST["cant_prod"].",
             '".$_SESSION['username']."', 1)";
      
      if(mysqli_query($connect, $query)){
        echo 'Yes';  
      }
      else{
        echo 'No';  
      }
      
      mysqli_close($connect);
    
 }
 
 if(isset($_POST["Verificaventa"]))  {
   $query = "  
      SELECT *
      FROM tbl_venta WHERE Estado=1 
      and  usuario  = '".$_SESSION['username']."'";
      
      $result = mysqli_query($connect, $query);
      mysqli_close($connect);
      if(mysqli_num_rows($result) > 0)  
      {  
           echo 'Yes';
        
      }  
      else  
      {  
           echo 'No';  
      }
 }
 if(isset($_POST["actionElimVenta"]))
 {
   $query = "  
      delete FROM tbl_venta 
      WHERE id  = ".$_POST["idventa"]."";
      
      //$result = mysqli_query($connect, $query);
      
      if(mysqli_query($connect, $query))  
      {
           echo "yes";
      }
      else  
      {  
           echo 'No';  
      }
      mysqli_close($connect);
 }
 if(isset($_POST["actionGrabarVenta"]))
 {
   $query = "  
      update tbl_venta  set estado=2
      WHERE usuario  = '".$_SESSION['username']."'";
      
      //$result = mysqli_query($connect, $query);
      
      if(mysqli_query($connect, $query))  
      {
           echo "Yes";
      }
      else  
      {  
           echo 'No';  
      }
      mysqli_close($connect);
 }
 if(isset($_POST["actionproducto"]))  
 {  
     $query = "  
      SELECT id_prod,nombre_prod,desc_prod,valor_prod,cant_prod,usuario FROM tbl_producto 
      WHERE id_prod  = ".$_POST["idproducto"]."";
      
      $result = mysqli_query($connect, $query);
      mysqli_close($connect);
      if(mysqli_num_rows($result) > 0)  
      {
        while ($columna = mysqli_fetch_array( $result)){
               
           echo $columna[0] . "_" . $columna[1] ."_" . $columna[2] . "_" . $columna[3] . "_" . $columna[4] ."_" . $columna[5] ;
        }
           
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