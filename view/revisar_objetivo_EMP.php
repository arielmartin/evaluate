<?php session_start();
/*
 * Página asegurada
 * Simplemente hay que añadir esta línea de PHP al principio.
 */
require('../php_lib/include-pagina-restringida.php'); //el incude para vericar que estoy logeado. Si falla salta a la página de login.php
//require('php_lib/solo_evaluadores.php');//restringe acceso a roles diferentes de 1 y 3
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
	require('../php_lib/ado.periodo.php');//incluimos la clase de acceso a datos de perfil
	include ('../php_lib/formato_fechas.php');
		
	$ado=new adoObjetivo();
	$adoE=new adoEmpleado();
	$adoP=new adoPeriodo();

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

//Metodo que obtiene el id de la evaluacion activa
$actual=$ado->evaluacionActual($fechas);

//var_dump($fechas);
$id_user= $adoE->getIdByDni(@$_SESSION['USUARIO']['user']);

$id_creador=$adoP->getCreadorPeriodo($id_periodo);
$evaluador=$adoE->getNameEmpleado($id_creador);

?>

<div class="container_12">
<div id="div_titulo">

<label class="subtitulo"> <?php echo 'Objetivo: '.$nombre_objetivo ?> </label>
</br>
<label class="subtitulo2"> <?php echo 'Evaluador: '.$evaluador ?> </label>

</div>

			<div class="clear cl2" id="espacio"></div>
		<div class="content" id="dejar_espacio2">
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
							<td> ".sqlastd($fecha)." </td>
						";	
						
						$nota=$ado->getNota($id_objetivo,$id_empleado,$id_evaluacion);
						
						if($nota){
						echo"
							<td>EVALUADO</td>
							<td> <b>$nota</b>
						";
						}

						else{
						echo"
							<td>PENDIENTE</td>
							<td> -
						";
						}
						
						$pos++;
						}
						?>
						
						</tbody>
					</table>
			</div>	
		</div>
<div class="clear"></div>
  <!--==============================Flecha Atras =================================-->
	   
		<div class="grid_1" id="flecha_atras">
        <a href="home_evaluador.php">
          <img src="images/flecha_atras.png" alt="ATRAS">
        </a>
		</div>
	
<!--==============================footer=================================-->
</div>
<?php include("footer/pie.php"); ?>
</body>
</html>