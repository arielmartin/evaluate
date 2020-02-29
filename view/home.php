<?php @session_start(); ?>

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
<!--==============================Content 1 (slider) =================================-->
	<?php include("content/slider_home.php"); ?>
<!--==============================Content 2 (texto - contenido) =================================-->
	<div class="container_12">
	<div class="content" >
			<div class="grid_12" id="about">
 <p>El objetivo general de Evaluate es brindarle a los encargados de los diferentes sectores de su empresa 
 una herramienta eficaz para realizar un seguimiento y evaluaci&oacute;n del rendimiento de los empleados a su cargo, 
 donde se contemplar&aacute;n cuestiones objetivas a las acciones que su puesto requiera.
 Se evaluaran actitudes vinculadas con la relaci&oacute;n entre pares, y objetivos o metas preestablecidas por un superior dise&ntilde;adas 
 especificamente para un grupo de empleados definido.</p>
			</div>			
	</div>
</div>
<!--==============================footer=================================-->
<?php include("footer/pie.php"); ?>
</body>
</html>