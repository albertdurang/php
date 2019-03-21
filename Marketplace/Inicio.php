<?php   
 session_start();  
 ?>  
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Pagina principal</title>
    <!--<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>-->
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.3/css/foundation.min.css?ver=4.4.2'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/Ladda/0.9.8/ladda.min.css'>

	<link rel="stylesheet" href="recurso/css/bootstrap.css" />
    <link rel="stylesheet" href="recurso/css/carrito.css">
    <link rel="stylesheet" href="recurso/css/main.css">
    <script src="recurso/js/bootstrap.js"></script>
    <script src="recurso/Scripts/jquery-1.7.1.min.js"  type="text/javascript"></script>
    
    <script type="text/javascript">
        var JQ171 = jQuery.noConflict();    
    </script>   
    
  <script src="recurso/Scripts/jquery-2.1.3.js" type="text/javascript"></script>
     <script type="text/javascript">
         var JQ213 = jQuery.noConflict();    
    </script>    

    <script src="recurso/Scripts/jquery-ui-1.11.4.js" type="text/javascript"></script>
  
    <script src="recurso/Scripts/jquery-ui1_8_9.js" type="text/javascript"></script>
       <script type="text/javascript">
           var JQ_UI1_8_9 = jQuery.noConflict();    
    </script>
    <script src="recurso/Libreria/jquery.validaciones_plugin.js"  type="text/javascript"></script>
   <script src="recurso/Scripts/jquery.BetterGrow.js" type="text/javascript"></script>
    <script src="recurso/Libreria/validadores.js"  type="text/javascript"></script>
    <link href="recurso/estilo/estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<header id="page-header">
    <div class="container">
	   <?php  
                if(isset($_SESSION['username']))  
                {  
                ?>  
                <div align="center">
                     <h1>Bienvenido - <?php echo $_SESSION['username']; ?></h1><br />
                     <a href="#" id="logout">Logout</a>
                    <button type="button" name="panel_button" id="panel_button" class="btn btn-warning">Panel de control</button>
                    <button type="button" name="carro_button" id="carro_button" class="btn btn-warning"><img src="recurso/img/carro.png" width="50"/>
                    <br>
                </div>
                    <h1>Amazing</h1>
                    <p>Las mejores ofertas sólo en Amazing</p>
                <?php  
                }  
                else  
                {  
                ?>  
                <div align="center">
                    <h1>Amazing</h1>
                    <p>Las mejores ofertas sólo en Amazing</p>
                     <button type="button" name="login" id="login" class="btn btn-success" data-toggle="modal" data-target="#loginModal">Ingresar</button>
                     <button type="button" name="registro" id="registro" class="btn btn-success" data-toggle="modal" data-target="#registroModal">Registrarse</button>                     
                </div>  
                <?php  
                }  
                ?>  
           </div>

    </div>
</header
<section>
    <div align="center">
 <input type="text" id="txtBusqueda" name="txtBusqueda"  placeholder="Busqueda de producto" maxlength="50"/>
      <button class="btn btn-block" type='button' name='buscar' id='buscar' class='btn btn-success '>Buscar</button>
    </div>
</section>
<?php  
//tomamos los datos del archivo conexion.php

$connect = mysqli_connect("127.0.0.1", "root", "", "marketplace");

$value =  "";//$_REQUEST['txtBusqueda'];
$query = "SELECT id_prod, nombre_prod, desc_prod, valor_prod, cant_prod, tbl_producto.usuario, estado_prod,
      cant_prod- IFNULL((select sum(cantidad)cant from tbl_venta where tbl_venta.id_producto=tbl_producto.id_prod ),0)as vendido ,
       url,concat(nombres,' ', apellidos) as nombre
      FROM tbl_producto inner join tbl_usuario
       on tbl_producto.usuario=tbl_usuario.id
      where estado_prod=1 and desc_prod like '%%'";
      $result = mysqli_query($connect, $query);
      mysqli_close($connect);?>
      <h2 class="major"><span>Nuestros Productos</span></h2>
      <?php
      if(mysqli_num_rows($result) > 0)  {
      ?>
      

<section class="box features">
    <?php
    while ($columna = mysqli_fetch_array( $result ))
    {
    ?>
        <div align="center">
            <div class="row">
                <div class="12u 3u(mobile)">
                   <!--productos-->
                        <section class="box feature">
                        <?php echo"<img src='recurso/img/repara.jpg'  alt=''height='42' width='42'/>"?>
                        <h3><?php echo "$columna[1]"."<br /> Precio $"."$columna[3]"?></h3>
                        <p><?php echo "Vendedor"."$columna[9]"?></p>
                            <p><?php echo "Stock:"."$columna[7]"?></p>
                            <p><?php echo "URL"."<a href='"."$columna[8]"."'>Link</a>"?></p>
                            <?php
                            if(isset($_SESSION['username']))
                            {
                            echo "<td><button type='button' name='carrito_" . $columna[0] . "' id='carrito" . $columna[0] . "' class='btn btn-success cargar' data-toggle='modal' data-target='#compraModal'>Comprar</button></td>";
                            }
                            ?>
                            <?php
                    }
      }
                    ?>
                        </section>
                </div>
            </div>
        </div>
</section>

<section class="page-section">
    <div class="container">

        <section class="page-section">
            <div class="container">
                <br>

                <center>
                    <div class="row">


                        <div class="masVendidos large-12 columns">

                        </div>

                    </div>
                </center>
            </div>
        </section>
        <center>
            <section class="video">
                <h2 class="major"><span>Lo más nuevo</span></h2>
                <video poster="/marketplace/recurso/img/iphone.jpg" controls="controls">
                    <source src="/marketplace/recurso/video/iphonex.mp4" type="video/mp4" />
                </video>
            </section>
        </center>
    </div>
</section>

 <div id="loginModal" class="modal fade" role="dialog">
      <div class="modal-dialog">  
   <!-- Modal content-->  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Login</h4>  
                </div>  
                <div class="modal-body">  
                     <label>Usuario</label>  
                     <input type="text" name="username" class='sololetra req  largo' rel="maxlength=15" id="username" />  
                     <br />  
                     <label>Contraseña</label>  
                     <input type="password" name="password" class='letranumero req largo styleTextBox' rel="maxlength=15"  id="password" />  
                     <br />  
                     <button type="button" name="login_button" id="login_button" class="btn btn-warning">Login</button>  
                </div>  
           </div>  
      </div>  
 </div>
<div id="compraModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ingresar venta</h4>
            </div>
            <div class="modal-body">
                <label>Codigo producto</label>
                <input type="text" maxlength="20" name="codigoCom_prod" id="codigoCom_prod" class="form-control" />
                <label>Nombre producto</label>
                <input type="text" class='sololetra req  largo' rel="maxlength=20" name="nombreCom_prod" id="nombreCom_prod" class="form-control" />
                <label>Descripcion</label>
                <input type="text" class='sololetra req  largo' rel="maxlength=100" name="descCom_prod" id="descCom_prod" class="form-control" />
                <label>valor</label>
                <input type="text" class='numero req  largo valmax' rel="valormax=90000000&maxlength=8" name="valorCom_prod" id="valorCom_prod" class="form-control" />
                <label>Cantidad</label>
                <input type="text" class='numero req  largo valmax' rel="valormax=900000&maxlength=6" name="cantCom_prod" id="cantCom_prod" class="form-control" />
                <br />
                <button type="button" name="Agregar_button" id="Agregar_button" class="btn btn-warning">Agregar Carro Compra</button>


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
                     <label>Usuario</label>  
                     <input type="text" class='sololetra req  largo form-control' rel="maxlength=15" name="usernamereg" id="usernamereg" />
                     <label>Nombres</label>  
                     <input type="text" class='sololetra req  largo form-control' rel="maxlength=30"  name="nombrereg" id="nombrereg"/>
                     <label>Apellidos</label>  
                     <input type="text" class='sololetra req  largo form-control' rel="maxlength=30"  name="apellidoreg" id="apellidoreg"/> 
                     <label>Rut</label>  
                     <input type="text" class='req  largo' rel="maxlength=11"  name="rutreg" id="rutreg" class="form-control" />
                     <label>Telefono contacto</label>  
                     <input type="number" class='numero req  largo form-control' rel="maxlength=10"  name="telefonoreg" id="telefonoreg" />                     
                     <label>E-mail</label>                     
                     <input type="mail" class='req  largo form-control' rel="maxlength=30" name="emailreg" id="emailreg" />                     
                     <label>Password</label>                     
                     <input type="password" class='letranumero req  largo' rel="maxlength=10" name="passwordreg" id="passwordreg" class="form-control" /> 
                     <label>Verificar Password</label>  
                     <input type="password" class='letranumero req  largo' rel="maxlength=10" name="passwordregver" id="passwordregver" class="form-control" />  
                     <br />  
                     <button type="button" name="registro_button" id="registro_button" class="btn btn-warning">Registrarse</button>  
                </div>  
           </div>  
      </div>  
 </div>
<script>  
 $(document).ready(function(){
        $("buscar").click(function(){
         
         location.reload();
         });
          
        $(".cargar").click(function(){
            var id = this.id.replace("carrito","");
            var action = "cargarproducto";
            $.ajax({
                url:"insertarProducto.php",
                method:"POST",
                data: {idproducto:id,actionproducto:action},
                success:function(data)
                {
                    result=data;

                    if($.trim(result) == 'No')
                    {
                        alert("Error en conexion de base de datos");
                    }
                    else
                    {
                        // alert (result);
                        var res = result.split('_');
                        $('#codigoCom_prod').val(res[0]);
                        $('#codigoCom_prod').prop("disabled", true);
                        $('#nombreCom_prod').val(res[1]);
                        $('#nombreCom_prod').prop("disabled", true);
                        $('#descCom_prod').val(res[2]);
                        $('#descCom_prod').prop("disabled", true);
                        $('#valorCom_prod').val(res[3]);
                        $('#valorCom_prod').prop("disabled", true);
                        //    location.reload();
                    }
                }
            });

        });
        $('#Agregar_button').click(function(){
            var idproducto = $('#codigoCom_prod').val();
            var valor_prod = $('#valorCom_prod').val();
            var cantidad = $('#cantCom_prod').val();
            var total = parseInt( valor_prod) * parseInt(cantidad);
            var action = "insventa";
            if(cantidad != '')
            {

                $.ajax({
                    url:"insertarProducto.php",
                    method:"POST",
                    data: {idproducto:idproducto, valor_prod:valor_prod,cantidad:cantidad,total:total,insventa:action},
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
                            $('#compraModal').hide();
                            location.reload();
                            alert("Compra registrada");
                        }
                    }
                });
            }
            else
            {
                alert("Ingrese la cantidad");
            }
        });

        $('#carro_button').click(function(){
            var action = "Verificaventa";
            if(username != '')
            {

                $.ajax({
                    url:"insertarProducto.php",
                    method:"POST",
                    data: {Verificaventa:action},
                    success:function(data)
                    {
                        result=data;
                        if($.trim(result) == 'No')
                        {
                            alert("Ud. no registra venta");
                        }
                        else
                        if($.trim(result) == 'Yes')
                        {

                            window.location='realizaVenta.php';
                            //location.reload();
                        }
                    }
                });
            }
            else
            {
                alert("faltan campos requerido");
            }
        });
        $('#registro_button').click(function(){
            var username = $('#usernamereg').val();
            var password = $('#passwordreg').val();
            var nombre = $('#nombrereg').val();
            var apellido = $('#apellidoreg').val();
            var rut = $('#rutreg').val();
            var email = $('#emailreg').val();
            var telefono = $('#telefonoreg').val();
            if(username != '' && password != '')
            {

                $.ajax({
                    url:"insertarUsuario.php",
                    method:"POST",
                    data: {usernamereg:username, passwordreg:password,nombrereg:nombre,apellidoreg:apellido,rutreg:rut,emailreg:email,telefonoreg:telefono},
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
                            alert("El usuario  creado");
                        }
                    }
                });
            }
            else
            {
                alert("Both Fields are required");
            }
        });

        $('#login_button').click(function(){
            var username = $('#username').val();
            var password = $('#password').val();
            if(username != '' && password != '')
            {

                $.ajax({
                    url:"ValidaUsuario.php",
                    method:"POST",
                    data: {username:username, password:password},
                    success:function(data)
                    {
                        result=data;

                        if($.trim(result) == 'No')
                        {
                            alert("El usuario  o la contraseña incorrecta");
                        }
                        else
                        if($.trim(result) == 'Yes')
                        {

                            window.location='inicio.php';
                            //location.reload();
                        }
                    }
                });
            }
            else
            {
                alert("faltan campos requerido");
            }
        });
        $('#panel_button').click(function(){
            window.location='producto.php';
        });
        $('#logout').click(function(){
            var action = "logout";
            $.ajax({
                url:"ValidaUsuario.php",
                method:"POST",
                data:{action:action},
                success:function()
                {
                    location.reload();
                }
            });
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
</body>
</html>
