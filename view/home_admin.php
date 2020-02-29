<?php session_start();
/* 
 * Página asegurada
 * Simplemente hay que añadir esta línea de PHP al principio.
 */
require('../php_lib/include-pagina-restringida.php'); //el incude para vericar que estoy logeado. Si falla salta a la página de login.php
require('../php_lib/solo_administradores.php');
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include("metadata.php"); ?>
	</head>
 <body class="page1" id="top">
<!--==============================header=================================--> 
<div class="container_12">
<div class="grid_12">
<?php include("header/header.php"); ?>
<!--==============================menu=================================--> 
<?php include("menu/menu.php"); ?>
</div>
</div>
<!--==============================Content=================================-->
  <div class="container_12">
    <div class="content" id="dejar_espacio4">
		<div class="clear cl1"></div>
		<div class="grid_4 prefix_2">
			<div class="opcion">
				<a href="abm_empleados.php"><img src="../public/images/alta_empleado.jpg" alt="ALTA DE EMPLEADOS"/></a>
			</div>
		</div>
		<div class="grid_4">
			<div class="opcion">
				<a href="buscar_registro.php"><img src="../public/images/buscar_empleado.jpg" alt="BUSCAR EMPLEADOS"/></a>
			</div>
		</div>
	<div class="clear"></div>
    </div>
  </div>
<!--==============================footer=================================-->
<?php include("footer/pie.php"); ?>
</body>
</html>

