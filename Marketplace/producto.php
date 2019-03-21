  <?php   
 session_start();
//tomamos los datos del archivo conexion.php

$connect = mysqli_connect("127.0.0.1", "root", "", "marketplace");

$query = "SELECT * FROM tbl_producto P inner join tbl_usuario U on P.usuario= U.id where U.Usuario='".$_SESSION['username']."';";
      $result = mysqli_query($connect, $query);
        mysqli_close($connect);
      ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
 <html>
 <head>
     <title>Pagina principal</title>
     <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.3/css/foundation.min.css?ver=4.4.2'>
     <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/Ladda/0.9.8/ladda.min.css'>

     <link rel="stylesheet" href="recurso/css/bootstrap.css" />
     <link rel="stylesheet" href="recurso/css/carrito.css">
     <link rel="stylesheet" href="recurso/css/main.css">
     <script src="recurso/js/bootstrap.js"></script>
     <script src="recurso/Scripts/jquery-1.7.1.min.js"  type="text/javascript"></script>
     <link href="recurso/estilo/estilo.css" rel="stylesheet" type="text/css" />

 </head>
 <body>
 <?php
 if(isset($_SESSION['username']))
 {
     ?>
     <div align="center">
         <h1>Bienvenido - <?php echo $_SESSION['username']; ?></h1><br />
         <a href="#" id="logout">Logout</a>
     </div>
     <?php
 }
 ?>
 </div>
 <br />


 <div align="center">
     <button type="button" name="registro" id="registro" class="btn btn-success" data-toggle="modal" data-target="#registroModal">Agregar Producto</button>
     <button type="button" name="usuario_mod" id="usuario_mod" class="btn btn-success" data-toggle="modal" data-target="#UsuarioModal">Modificar datos usuario</button>
     <button type="button" name="volver_button" id="volver_button" class="btn btn-warning">Volver Busqueda</button>
 </div>

 <h2 class="major"><span>Tus Productos</span></h2>
 <section class="box featured" >
     <?php
     while ($columna = mysqli_fetch_array( $result ))
     { ?>
     <div align="center">
         <div class="row" >
             <div class="12u 3u(mobile)">
                 <!--productos-->
                 <section class="box feature">
                     <img src="recurso/img/repara.jpg" alt=""/>
                     <h3><?php echo "$columna[1]"." "."$columna[3]"?></h3>
                     <p><?php echo "$columna[2]"?></p>
                     <?php
                     }
                     ?>
                 </section>
             </div>
         </div>
     </div>
 </section>
 <div id="UsuarioModal" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Registro</h4>
             </div>
             <div class="modal-body">
                 <label>Usuario</label>
                 <input type="text" maxlength="15" name="usernamereg" id="usernamereg" class="form-control" />
                 <label>Nombres</label>
                 <input type="text" maxlength="30" name="nombrereg" id="nombrereg" class="form-control" />
                 <label>Apellidos</label>
                 <input type="text" maxlength="30" name="apellidoreg" id="apellidoreg" class="form-control" />
                 <label>Rut</label>
                 <input type="text" maxlength="11" name="rutreg" id="rutreg" class="form-control" />
                 <label>Telefono contacto</label>
                 <input type="number" maxlength="15" name="telefonoreg" id="telefonoreg" class="form-control" />
                 <label>E-mail</label>
                 <input type="email" maxlength="30" name="emailreg" id="emailreg" class="form-control" />
                 <label>Password</label>
                 <input type="password" maxlength="10" name="passwordreg" id="passwordreg" class="form-control" />
                 <label>Verificar Password</label>
                 <input type="password" maxlength="10" name="passwordregver" id="passwordregver" class="form-control" />
                 <br />
                 <button type="button" name="usuario_button" id="usuario_button" class="btn btn-warning">Modificar</button>
             </div>
         </div>
     </div>
 </div>
<div id="registroModal" class="modal fade" role="dialog">
      <div class="modal-dialog">  
   <!-- Modal content-->  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Registro</h4>  
                </div>  
                <div class="modal-body">  
                     <label>Nombre producto</label>  
                     <input type="text" maxlength="20" name="nombre_prod" id="nombre_prod" class="form-control" />
                     <label>Descripcion</label>  
                     <input type="text" maxlength="100" name="desc_prod" id="desc_prod" class="form-control" />
                     <label>valor</label>  
                     <input type="text" maxlength="8" name="valor_prod" id="valor_prod" class="form-control" /> 
                     <label>Cantidad</label>  
                     <input type="text" maxlength="6" name="cant_prod" id="cant_prod" class="form-control" />                     
                     <br />
                    <!--<label>Nombre de la Foto</label>
                    <input type="text" maxlength="100" name="nom_foto" id="nom_foto" class="form-control" />
                    <br />
                    <input type="file"  name="foto" id="foto" class="form-control" />
                     <br />-->
                    <button type="button" name="registro_button" id="registro_button" class="btn btn-warning">Agregar Producto</button>
                     
                     
                </div>  
           </div>  
      </div>  
 </div>  
<script>  
 $(document).ready(function(){
      $('#registro_button').click(function(){  
           var nombre_prod = $('#nombre_prod').val();  
           var desc_prod = $('#desc_prod').val();
           var valor_prod = $('#valor_prod').val();
           var cant_prod = $('#cant_prod').val();
           if(nombre_prod != '' && valor_prod != '')  
           {
              
                $.ajax({  
                     url:"insertarProducto.php",  
                     method:"POST",  
                     data: {nombre_prod:nombre_prod, desc_prod:desc_prod,valor_prod:valor_prod,cant_prod:cant_prod},
                     success:function(data)  
                     {                      
                          result=data;
                          
                          if($.trim(result) == 'No') 
                          {  
                               alert("Error base de datos o conexión");  
                          }  
                          else
                          if($.trim(result) == 'Yes')  
                          {  
                               $('#registroModal').hide();  
                               location.reload();
                               alert("El producto fue agregado"); 
                          }  
                     }  
                });  
           }  
           else  
           {  
      alert("Both Fields are required");  
           }  
      });
     $('#usuario_button').click(function(){
                        
             var action = "Actualizarusuario";
              var username = $('#usernamereg').val();
            var password = $('#passwordreg').val();
            var nombre = $('#nombrereg').val();
            var apellido = $('#apellidoreg').val();
            var rut = $('#rutreg').val();
            var email = $('#emailreg').val();
            var telefono = $('#telefonoreg').val();
            
             $.ajax({
                 url:"insertarUsuario.php",
                 method:"POST",
                 data: {usernamereg1:username, passwordreg:password,nombrereg:nombre,apellidoreg:apellido,rutreg:rut,emailreg:email,telefonoreg:telefono,updateusuario:action},
                 success:function(data)
                 {
                     result=data;
            
                     if($.trim(result) == 'No')
                     {   
                         alert("Error base de datos o conexión");
                     }
                     else
                    if($.trim(result) == 'Yes')
                     {
                        
                         alert("El usuario  modificando");
                     }
                 }
             });
         
     });  
     $('#usuario_mod').click(function(){
                        
             var action = "Actualizarusuario";
             $.ajax({
                 url:"insertarUsuario.php",
                 method:"POST",
                 data: {actionActusu:action},
                 success:function(data)
                 {
                     result=data;
                    
                     if($.trim(result) == 'No')
                     {
                         alert("Error base de datos o conexión");
                     }
                     else
                    // if($.trim(result) == 'Yes')
                     {
                        var res = result.split('_');
                       
                         $('#usernamereg').val(res[0]);
                        $('#usernamereg').prop("disabled", true);
                        $('#passwordreg').val(res[6]);
                        $('#nombrereg').val(res[1]);
                         $('#apellidoreg').val(res[2]);
                         $('#rutreg').val(res[3]);
                         $('#emailreg').val(res[5]);
                         $('#telefonoreg').val(res[7]);
                         //alert("El usuario  modificando");
                     }
                 }
             });
         
     });
      $('#logout').click(function(){  
           var action = "logout";  
           $.ajax({  
                url:"ValidaUsuario.php",  
                method:"POST",  
                data:{action:action},  
                success:function()  
                {  
                     window.location='Inicio.php'; 
                }  
           });  
      });
      $('#volver_button').click(function(){
         window.location='Inicio.php';  
      });
      
 });  
 </script>

 <footer class="blockquote-footer page-footer ">
     <div class="container">
         <p>
             Diseño de Aplicaciones web
         </p>
         <address>
             <img src="recurso/img/inacap.png" width="50px"height="50px">
             Inacap<br />
             Almirante Barroso 76<br />
             Santiago Centro<br />
         </address>
         <p>
             &#169; 2018 Todos los derechos reservados
         </p>
     </div>
 </footer>
 <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js?ver=1.11.2'></script>
 <script src='https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js'></script>
 <script src='https://cdnjs.cloudflare.com/ajax/libs/Ladda/0.9.8/spin.min.js'></script>
 <script src='https://cdnjs.cloudflare.com/ajax/libs/Ladda/0.9.8/ladda.min.js'></script>
 <script  src="assets/scripts/carrito.js"></script>
 </body>
</html>