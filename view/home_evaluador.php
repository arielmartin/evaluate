<?php session_start();
/* 
 * Página asegurada
 * Simplemente hay que añadir esta línea de PHP al principio.
 */
require('../php_lib/include-pagina-restringida.php'); //el incude para vericar que estoy logeado. Si falla salta a la página de login.php
include('../php_lib/solo_evaluadores.php');
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
    <div class="clear cl1"></div>
<div class="content">
    <div class="grid_4">
      <div class="opcion">
		<a href="opciones_perfil.php"><img src="../public/images/opciones_perfil.jpg" alt="OPCIONES DE PERFIL"/></a>
	  </div>
    </div>
	<div class="grid_4">
      <div class="opcion">
		<a href="opciones_periodos.php"><img src="../public/images/opciones_periodos.jpg" alt="PERIODO"/></a>
	  </div>
    </div>
	<div class="grid_4">
      <div class="opcion">
		<a href="seguir.php"><img src="../public/images/seguir_evaluar.jpg" alt="SEGUIR / EVALUAR"/></a>
	  </div>
    </div>
	<div class="grid_4 prefix_2">
      <div class="opcion">
		<a href="seguir_historial.php"><img src="../public/images/ver_historial.jpg" alt="VER HISTORIAL"/></a>
	  </div>
    </div>
	<div class="grid_4">
      <div class="opcion">
		<a href="ranking.php"><img src="../public/images/ranking.jpg" alt="RANKING"/></a>
	  </div>
    </div>
<div class="clear"></div>
</div>
</div>
<!--==============================footer=================================-->
<?php include("footer/pie.php"); ?>
</body>
</html>