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
<!--==============================Content=================================-->
<?php
	require_once('../php_lib/conexion.php'); //incluimos la clase conexion
	require('../model/class.objetivo.php');//incluimos la clase objetivo
	require('../php_lib/ado.objetivo.php');//incluimos la clase de acceso a datos de empleado
	include ("../php_lib/formato_fechas.php");

	$ado=new adoObjetivo();
	$adoE=new adoEmpleado();

	$id_objetivo=$_SESSION['TEMP']['id_objetivo'];
	$id_periodo=$_SESSION['TEMP']['id_periodo'];
	$id_empleado=$_SESSION['TEMP']['id_empleado'];
	$id_evaluacion=$_SESSION['TEMP']['id_evaluacion'];
	$obj_objetivo=$ado->getObjetivoById($id_objetivo);
	$nombre_empleado=$adoE->getNameEmpleado($id_empleado); 
	$nombre_objetivo=$obj_objetivo->getNombre();
	$descripcion=$obj_objetivo->getDescripcion();
	//array con las fechas de evaluacion
	@$fechas=$ado->getFechasEvaluacion($id_objetivo,$id_empleado,$id_periodo);
	/************** Cambio solo para deploy en PHP 5.2 ****************/
	       // $fechas = array_reverse($fechas, true);
	/******************************************************************/
	//Metodo que obtiene el id de la evaluacion activa
	$actual=$ado->evaluacionActual($fechas);
	//var_dump($fechas);
	$id_user= $adoE->getIdByDni(@$_SESSION['USUARIO']['user']);
?>
<div class="container_12">
<div id="div_titulo">
<label class="subtitulo"> <?php echo $nombre_empleado ?> </label>
</br>
<label class="subtitulo2"> <?php echo 'Objetivo: '.$nombre_objetivo ?> </label>
</div>
			<div class="clear cl2" id="espacio"></div>
		<div class="content" id="dejar_espacio">
					<div class="grid_12"><p class="texto3"> <?php echo $descripcion ?> </p></div>
				<div class="grid_8 prefix_2" id="tabla_evaluar">
					<table>
						<thead>
						<tr id="categorias">
							<th>#</th>
							<th>Fecha De Evaluacion</th>
							<th>Estado</th>
							<th>Nota</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$pos=1;
						foreach($fechas as $id_evaluacion=>$fecha)
						{
						echo"
						<tr>
							<td>$pos</td>
							<td > ".sqlastd($fecha)." </td>
						";	
						$nota=$ado->getNota($id_objetivo,$id_empleado,$id_evaluacion);
						if($nota=='1'){
						echo"
							<td id=''>EVALUADO</td>
							<td id='derecha' class='numero uno'> $nota </td>
						";
						}
						else if ($nota=='2')
						{
						echo"
							<td id=''>EVALUADO</td>
							<td id='derecha' class='numero dos'> $nota </td>
						";
						}
						else if ($nota=='3')
						{
						echo"
							<td id=''>EVALUADO</td>
							<td id='derecha' class='numero tres'> $nota </td>
						";
						}
						else if ($nota=='4')
						{
						echo"
							<td id=''>EVALUADO</td>
							<td id='derecha' class='numero cuatro'> $nota </td>
						";
						}else if ($nota=='5')
						{
						echo"
							<td id=''>EVALUADO</td>
							<td id='derecha' class='numero cinco'> $nota </td>
						";
						}
						else
						if($actual==$id_evaluacion and $id_user!=$id_empleado){
						echo"
							<td>ACTIVO</td>
							<td>
							<form action='../controller/evaluar_controller.php' method='post' id='ingresar_nota' class='ingresar_nota' name='ingresar_nota'>
										<select id='ddl_notas' name='ddl_notas'>
											<option value=5>5</option>
											<option value=4>4</option> 
											<option value=3>3</option> 
											<option value=2>2</option> 
											<option value=1>1</option> 
										</select>
										<button class='button' type='submit' onsubmit='return validar()'> Evaluar </button>
							</form>
							</td>
						</tr>
						";
						}
						else{
						echo"
							<td>SIN EVALUAR</td>
							<td > - </td>
						";
						}
						$pos++;
						}
						?>
						</tbody>
					</table>
			</div>	
				<div class="grid_3 prefix_4" id="aclaracion_notas">
						<div class="paper">
								<div class="tape"></div>
								<div class="red-line first"></div>
								<div class="red-line"></div>
								<ul id="lines">	
									<label class="texto"> .: Notas :. </label>
									<li></li>
									<li> <label class="numero cinco">5</label> - Excelente</li>
									<li> <label class="numero cuatro">4</label> - Muy Bueno</li>
									<li> <label class="numero tres">3</label> - Bueno</li>
									<li> <label class="numero dos">2</label> - Regular</li>
									<li> <label class="numero uno">1</label> - Mal</li>
									<li></li>
								</ul>
								<div class="left-shadow"></div>
								<div class="right-shadow"></div>
							</div><!--end paper-->					
				</div>
		</div>
		

<!--============================== Flecha Atras =========================-->
	    <div class="clear"></div>
			<div class="grid_1" id="flecha_atras">
		        <a href="javascript:history.back(-1);">
		        	<img src="../public/images/flecha_atras.png" alt="ATRAS">
		        </a>
			</div>
		</div>
<!--=====================================================================-->

</div>

<!--==============================footer=================================-->
<?php include("footer/pie.php"); ?>
</body>
</html>