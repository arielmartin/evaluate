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
<?php
if(@$_SESSION['alert'])
{
 //var_dump(@$_SESSION['alert']);
   echo "<script languaje='javascript'>alert('Alerta: ".$_SESSION['alert']."')</script>";
   unset($_SESSION['alert']);
}
?>

  <div class="container_12">
    <div class="clear cl1"></div>
<div class="content" id="dejar_espacio4">
    <div class="grid_4 prefix_2">
      <div class="opcion">
		<a href="../controller/opciones_periodo_controller.php"><img src="../public/images/crear_periodo.jpg" alt="CREAR PERIODO"/></a>
	  </div>
    </div>
	<div class="grid_4">
      <div class="opcion">
		<a href="eliminar_periodos.php"><img src="../public/images/eliminar_periodos.jpg" alt="ELIMINAR PERIODOS EXISTENTES"/></a>
	  </div>
    </div>
	
<div class="clear"></div>
</div>
</div>


<!--==============================footer=================================-->
<?php include("footer/pie.php"); ?>
</body>
</html>

<?php
if(@$_SESSION['alert'])
{
   echo "<script languaje='javascript'>Alert('Importante:".$_SESSION['alert']."')</script>";
   unset($_SESSION['alert']);
}
?>

