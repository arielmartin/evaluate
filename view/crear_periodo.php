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
	<div class="grid_8 prefix_2">
		
		<form action="../controller/periodo_controller.php" method="post" id="crear_periodo" name="crear_periodo" class="alta_periodo" novalidate="novalidate">
			<header>Crear Periodo</header>
			<fieldset>
				<section>
				<label class="input">
                            <input type="text" name="nombre_periodo"  placeholder="Nombre"  maxlength="40"></input>
                            <b class="tooltip tooltip-bottom-right">Ingrese un nombre para el periodo</b>  
                </label>
				</section>
				<section>
						<input type='radio'  name='cantidad' value='1'>1</input>
						<input type='radio'  name='cantidad' value='2'>2</input>
						<input type='radio'  name='cantidad' value='3'>3</input>
						<input type='radio'  name='cantidad' value='4'>4</input>
						<input type='radio'  name='cantidad' value='5'>5</input>
						<input type='radio'  name='cantidad' value='6'>6</input>
						<input type='radio'  name='cantidad' value='7'>7</input>
						<input type='radio'  name='cantidad' value='8'>8</input>
						<input type='radio'  name='cantidad' value='9'>9</input>
						<input type='radio'  name='cantidad' value='10'>10</input>
						<input type='radio'  name='cantidad' value='11'>11</input>
						<input type='radio'  name='cantidad' value='12'>12</input>
						
						<label class="aclaracion2">.:Cantidad de evaluaciones:.</label>

				</section>
				<section >
						<input type="text" value="" readonly name="theDate1" placeholder="Fecha de inicio" class="calendario" id="fecha_inicio"/>
						<input type="button" value="Calendario" onclick="displayCalendar(document.crear_periodo.theDate1,'dd/mm/yyyy',this)"/>
												
						<label class="aclaracion2">.:Formato dia/mes/a&ntilde;o:.</label>
				</section>
				<section >
						<input type="text" value="" readonly name="theDate2" placeholder="Fecha de finalizacion" class="calendario"/ id="fecha_final">
						<input type="button" value="Calendario" onclick="displayCalendar(document.crear_periodo.theDate2,'dd/mm/yyyy',this)"/>
						
						<label class="aclaracion2">.:Formato dia/mes/a&ntilde;o:.</label>

				</section>
				<button class="button" type="submit" onclick="return validar_fecha_periodo()">Siguiente</button>
			</fieldset>
        </form>	
		
	<div id="divErrores">
		<ul id="lista"></ul>
		<span id="error1" style='display:none'> * La fecha de inicio no puede coincidir con la fecha de finalizacion </br> </span>
		<span id="error2" style='display:none'> * La fecha de inicio no puede ser posterior a la fecha de finalizacion </br> </span>
		<span id='error2'><?php echo @$_SESSION['MSJ'];UNSET($_SESSION['MSJ']);?></span>
		
	</div>
						
						
	</div>
    </div>
	
	    <div class="clear"></div>
</div>
  <!--==============================Flecha Atras =================================-->
	<!--
		<div class="grid_1" id="flecha_atras">
        <a href="home_evaluador.php">
          <img src="images/flecha_atras.png" alt="ATRAS">
        </a>
		</div>
		
<!--==============================footer=================================-->

<?php include("footer/pie.php"); ?>
</body>
</html>