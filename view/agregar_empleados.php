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
<!--==============================Content (formulario de ingreso de fechas)=================================-->
<?php
	//creamos el ado perfil
	require_once('../model/class.perfil.php');
	require('../php_lib/ado.perfil.php');//incluimos la clase de acceso a datos
	$adoP=new adoPerfil();

	//recibimos los datos por post
    //@$id_periodo=$_POST['id_periodo'];
	$listaEmpleados=$adoE->getAllEmpleados();
	
	//quitamos el usuario logueado del array
	//si queremos que el usuario pueda agregarse a una evaluacion comentamos estas 2 lineas
	$id_user= $adoE->getIdByDni(@$_SESSION['USUARIO']['user']);
	unset($listaEmpleados[$id_user]);
	
	
	
	$listaPerfiles=$adoP->getAllPerfiles();
?>
	<div class="container_12">
    <div class="content" id="dejar_espacio2">
	
	<div class="grid_8 prefix_2">
	
		<form action="agregar_empleados.php" method="post" id="empleados" name="empleados" class="alta_periodo">
			<header>Agregar Empleados al Periodo <?php echo ''?></header>
			
		<fieldset>
		
		
		<div id="asignaciones">
		
		<div  id="asignar_empleados">
		<label>Empleado</label>
		<select name="id_empleado" id="listItem2">
		<?php
			foreach($listaEmpleados as $key=>$valor) {
			echo '<option  value='. $key .'>' . $valor .'</option>';
			}
		?>
		</select>
		</div>
		<div  id="asignar_perfil">
		<label>Perfil</label>
		<select name="id_perfil" id="listItem2">
		<?php
		if($listaPerfiles){
			foreach($listaPerfiles as $key=>$valor) {
			echo '<option value='. $key .'>' . $valor .'</option>';
			}
		}
		?>
		</select>
		</div>

		</div>
		
		
				<button class="button" type="submit">Agregar</button>
		</fieldset>
		
		<fieldset>	
		<?php include("content/lista_empleados.php"); ?>
		</fieldset>

        </form>	
		
	</div>
	
	
 </div>
  <!--==============================Flecha Atras =================================-->
	    <div class="clear"></div>
		<div class="grid_1" id="flecha_atras">
        <a href="agregar_evaluaciones.php">
          <img src="../public/images/flecha_atras.png" alt="ATRAS">
        </a>
		</div>
		</div>
<!--==============================footer=================================-->
<?php include("footer/pie.php"); ?>
</body>
</html>