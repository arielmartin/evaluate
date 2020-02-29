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
    <div class="content" id="dejar_espacio">
					
	<div class="grid_6 prefix_3">
	
		<form action="../controller/alta_perfil_controller.php" method="post" id="alta_perfil" class="abm_perfil" >
			<header>Alta De Perfil
				<label class="aclaracion">.:Realice el alta de un nuevo perfil:.</label>
            </header>
			<fieldset>
				<section>
				<label class="input">
                            <input type="text" name="nombre_perfil"  placeholder="Nombre" maxlength="40"></input>
                            <b class="tooltip tooltip-bottom-right">
							Ingrese un nombre del perfil
							</b>  
                </label>
				</section>
				<section>
					<label class="input">
								<input type="text" name="descripcion_perfil"  placeholder="Descripcion" maxlength="60"></input>
								<b class="tooltip tooltip-bottom-right">
								Ingrese una descripcion para el perfil
								</b>  
					</label>					
				</section>
				
				<!--
				<button class="button" type="button" onclick="location='nuevo_objetivo.php'">Agregar Objetivos</button>
				<button class="button" type="button" onclick="location='competencias.php'">Competencias</button>
				-->
				<button class="button" type="submit">Siguiente</button>
        </fieldset>
		
	
        </form>
		
		<div class="clear"></div>	
		<span id='error2'><?php echo @$_SESSION['MSJ'];UNSET($_SESSION['MSJ']);?></span>
		</div>	
    </div>
 </div>

<!--==============================footer=================================-->
<?php include("footer/pie.php"); ?>
</body>
</html>