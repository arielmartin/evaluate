<?php session_start();
/*
 * Página asegurada
 * Simplemente hay que añadir esta línea de PHP al principio.
 */
require('../php_lib/include-pagina-restringida.php'); //el incude para vericar que estoy logeado. Si falla salta a la página de login.php
require('../php_lib/solo_evaluadores.php');//restringe acceso a roles diferentes de 1 y 3
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
<!--==============================Content (formulario de alta)=================================-->
	<div class="container_12">
    <div class="content" id="dejar_espacio3">
	<div class="grid_6 prefix_3">
		
		<form action="../controller/objetivo_controller.php" method="post" id="alta_objetivo" class="abm_perfil">
			<header>Nuevo Objetivo</header>
			<fieldset>
				<section>
				<label class="input">
                            <input type="text" name="nombre_objetivo"  placeholder="Nombre"></input>
                            <b class="tooltip tooltip-bottom-right">
							Ingrese un nombre para el objetivo
							</b>  
                </label>
				</section>
				<section>
					<label class="input">
							<input type="text" name="descripcion_objetivo"  placeholder="Descripcion"></input>
							<b class="tooltip tooltip-bottom-right">
							Ingrese una descripcion para el objetivo
							</b>  
					</label>					
				</section>
				
				<button class="button" type="submit">Agregar Objetivo</button>
				
				<button class="button" type="button" onclick="location='competencias.php'">Volver</button>
			
			</fieldset>
		</form>	
			
			</div>
		<div class="grid_8 prefix_2">
		<form id="alta_objetivo" class="abm_perfil">
			<header>Objetivos Agregados</header>
			<fieldset>
					<?php 
		@$objetivos=@$_SESSION['TEMP']['objetivos'];
		if($objetivos){
			echo "<table id='tabla_nuevos_objetivos'>";
			foreach($objetivos as $nombre=>$descripcion)
			{
			echo "<tr>";
			echo "<td class='nombre_objetivo'>$nombre</td>";
			echo "<td class='quitar_objetivo'> <a href='../controller/quitar_objetivo_controller.php?objetivo=$nombre' class='button2'>Quitar</a></td>";        
			echo "</tr>";
			}
		echo "</table>";
		echo "</fieldset>";
		echo "<fieldset>";
				echo "<button class='button' type='button' onclick=\"location='../controller/guardar_perfil_controller.php'\">Guardar Perfil</button>";
		echo "</fieldset>";
		}
		?>
		</form>
			</div>
		<div class="clear"></div>	
	</div>
</div>
<!--==============================footer=================================-->
<?php include("footer/pie.php"); ?>
</body>
</html>