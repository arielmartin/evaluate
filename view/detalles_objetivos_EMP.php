<?php session_start();
/*
 * Página asegurada
 * Simplemente hay que añadir esta línea de PHP al principio.
 */
require('../php_lib/include-pagina-restringida.php'); //el incude para vericar que estoy logeado. Si falla salta a la página de login.php
// require('php_lib/solo_evaluadores.php');//restringe acceso a roles diferentes de 1 y 3
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
//recibimos poe session la pagina
$page=$_SESSION['TEMP']['page'];

if($page==1)
{
	include('content/mis_objetivos.php');
}
if($page==2)
{
	include('content/mis_competencias.php');
}

?>
<!--==============================footer=================================-->
<?php include("footer/pie.php"); ?>
</body>
</html>