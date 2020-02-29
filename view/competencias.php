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
<?php

	//require('php_lib/conexion.php'); //incluimos la clase conexion
	require('../php_lib/ado.objetivo.php');//incluimos la clase de acceso a datos
	$ado=new adoObjetivo();
	$competencias=$ado->getCompetencias();
?>	
	
	
	<div class="container_12">
    <div class="content" id="dejar_espacio">
					
	<div class="grid_8 prefix_2">
	
		<form action="../controller/competencias_controller.php" method="post" id="alta_perfil" class="abm_perfil" >
			<header>Establecer Competencias
				<label class="aclaracion">.:Seleccione las competencias:.</label>
            </header>
			<fieldset>
				<section>
			<?php
			if($competencias)
			{
				
				echo "<ul id='lista_checkbox_competencias'>";
				
				foreach($competencias as $key=>$nombre)
				{
                    echo"
					
					<li>
					<input type='checkbox' id='' checked='checked' name='$key' value='$key' > $nombre  </input>
					</li>
					
					";
				}
				echo "</ul>";
			
			}
			?>
				</section>
				
				<button class="button" type="submit">Siguiente</button>
				
				<button class="button" type="button" onclick="location='nueva_competencia.php'">Nueva Competencia</button>
			
        </fieldset>
        </form>
			</div>	
			

    </div>

	    <div class="clear"></div>
		
<!--	<!--==============================Flecha Atras =================================-->

		<div class="grid_1" id="flecha_atras">
        <a href="home_evaluador.php">
          <img src="../public/images/flecha_atras.png" alt="ATRAS">
        </a>
		</div>
		
<!--==============================footer=================================-->
</div>
<?php include("footer/pie.php"); ?>
</body>
</html>