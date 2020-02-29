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
		<div class="content">

			<?php include("content/buscar.php"); ?>
				<div class="clear cl2"></div>
			<?php include("content/resultado.php"); ?>
		</div>
			<div class="clear"></div>
<!--==============================Flecha Atras =================================-->
		<div class="grid_1" id="flecha_atras">
			<a href="home_admin.php">
			  <img src="../public/images/flecha_atras.png" alt="ATRAS">
			</a>
		</div>
	</div>
<!--==============================footer=================================-->
<?php include("footer/pie.php"); ?>
</body>
</html>