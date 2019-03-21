  <?php   
 session_start();
      ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Confirmar ventas</title>
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.3/css/foundation.min.css?ver=4.4.2'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/Ladda/0.9.8/ladda.min.css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                    <button type="button" name="panel_button" id="panel_button" class="btn btn-warning">Volver</button>
                    <br>
                    <h1>Confirmar venta</h1>
                </div>  
                <?php  
                } 
                ?>   
           </div>
    </div>		
</header
<?php  
//tomamos los datos del archivo conexion.php

$connect = mysqli_connect("127.0.0.1", "root", "", "marketplace");

$query = "SELECT tbl_venta.id, nombre_prod, desc_prod, tbl_venta.cantidad, tbl_venta.valor,
					tbl_venta.total, url,concat(nombres,' ', apellidos) as nombre
		  FROM tbl_producto inner join tbl_venta on tbl_producto.id_prod=tbl_venta.id_producto
		  inner join tbl_usuario on tbl_venta.usuario=tbl_usuario.Usuario
		  where tbl_venta.estado=1 and tbl_venta.usuario='".$_SESSION['username']."'";
      $result = mysqli_query($connect, $query);
      mysqli_close($connect);?>
      <h2 class="major"><span>Productos seleccionado para comprar</span></h2>
      <?php  
while ($columna = mysqli_fetch_array( $result ))
{
    ?>
<section class="box features">    
        <div>
            <div class="row">
                <div class="3u 12u(mobile)">
                   <!--productos-->
                        <section class="box feature">
                        <?php echo"<img src='recurso/img/repara.jpg'  alt=''height='42' width='42'/>"?>
                        <h3><?php echo "$columna[1]"."<br /> cantidad $:"."$columna[3]"?></h3>
						<p><?php echo "<br /> Precio $:"."$columna[4]"?></p>
						<p><?php echo "<br /> Total $:"."$columna[5]"?></p>
                        <p><?php echo "Vendedor: "."$columna[7]"?></p>
                            <p><?php echo "URL"."<a href='"."$columna[6]"."'>Link</a>"?></p>
                            <?php
                            if(isset($_SESSION['username']))
                            {
                            echo "<td><button type='button' name='Eliminar_" . $columna[0] . "' id='Eliminar" . $columna[0] . "' class='btn btn-success elim'>Eliminar</button></td>";
                            }
                            ?>
                            <?php
                    }
                     
                    ?><br /><br />
                    <button type='button' name='Confirmar' id='Confirmar' class='btn btn-success'>Confirmar venta</button>                   
                        </section>
                </div>
            </div>
        </div>
</section>
	
<script>
     $(document).ready(function(){
        $(".elim").click(function(){
            var id = this.id.replace("Eliminar","");
            var action = "EliminarVenta";
            $.ajax({
                url:"insertarProducto.php",
                method:"POST",
                data: {idventa:id,actionElimVenta:action},
                success:function(data)
                {
                    result=data;

                    if($.trim(result) == 'No')
                    {
                        alert("Error en conexion de base de datos");
                    }
                    else
                    {
                       if($.trim(result) == 'Yes')
                         alert("El Producto fue eleminado de la venta");
                         location.reload();
                    }
                }
            });

        });
        $('#Confirmar').click(function(){
         
         var action = "actionGrabarVenta";
            $.ajax({
                url:"insertarProducto.php",
                method:"POST",
                data: {actionGrabarVenta:action},
                success:function(data)
                {
                    result=data;
                    if($.trim(result) == 'No')
                    {
                        alert("Error en conexion de base de datos");
                    }
                    else
                    {
                       if($.trim(result) == 'Yes')
                       alert("La venta fue realizada");
                         location.reload();                         
                    }
                }
            });
            window.location='producto.php';
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
</body>
</html>