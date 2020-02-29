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
//incluimos la clase de acceso a datos
	require('../php_lib/ado.periodo.php');
	$adoP=new adoPeriodo();
//obtenemos el array de periodos
	$id_user=$adoE->getIdByDni(@$_SESSION['USUARIO']['user']);
	@$periodos=$adoP->getMyPeriodos($id_user);
	
	//echo @$_SESSION['USUARIO']['rol'];
	//var_dump($id_user); //para ver el contenido del array
?>
	<div class="container_12">
    <div class="content" id="dejar_espacio">
	<div class="grid_8 prefix_2">
		
		<form action="../controller/eliminar_periodo_controller.php" method="post" id="buscar_periodo" class="alta_periodo" >
			<header>Eliminar Periodo
				<label class="aclaracion">.:Seleccione el periodo que quiere eliminar:.</label>
            </header>
			<fieldset>
				<select name="id_periodo" id="listItem">
				<optgroup class="periodos">
					<?php
					if($periodos){
						foreach($periodos as $key=>$valor) {
						echo '<option  value='. $key .'>' . $valor .'</option>';
						}
					}
					?>
				</optgroup>
				</select>
				
				<?php
				if($periodos){
				echo "<button class='button' type='submit'>Eliminar</button>";
				}
				else
				echo "<label class='aclaracion error'>No hay periodos </label>";
				?>
        </fieldset>
        </form>
		
		<div id="divErrores">
		<ul id="lista"></ul>		
		</div>
		
	</div>	
 
	
 </div>
<div class="clear"></div>

 <!--==============================Flecha Atras =========================-->
	 <div class="clear"></div>
		<div class="grid_1" id="flecha_atras">
		    <a href="javascript:history.back(-1);">
		        <img src="../public/images/flecha_atras.png" alt="ATRAS">
		    </a>
		</div>
	</div>
<!--=====================================================================-->

<!--==============================footer=================================-->
<?php include("footer/pie.php"); ?>
</body>
</html>