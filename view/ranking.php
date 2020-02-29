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
	require('../php_lib/ado.periodo.php');//incluimos la clase de acceso a datos de periodo
	require('../php_lib/ado.ranking.php');//incluimos la clase de acceso a datos de ranking
	//include ("php_lib/formato_fechas.php");
		
	$adoR=new adoRanking();

//array con los empleados
$empleados=$adoR->getAllEmpleados();
//var_dump($empleados);
$ordenado=$adoR->ordenar($empleados);
//var_dump($ordenado);
?>

<div class="container_12">
<div id="div_titulo">
<label class="subtitulo"> Ranking de los mejores empleados </label>
<label class="subtitulo2"> </label>
</div>
		<div class="content" id="dejar_espacio">
		
			<p class="texto3" id=""> Los objetivos tienen un peso nominal del 60% por sobre las competencias que tienen un 40%  </p>

			<div class="grid_10 prefix_1">

					<table id="tabla_ranking">
						<thead>
						<tr id="categorias">
							<th class='posicion'>#</th>
							<th class='nombre'>Nombre del Empleado</th>
							<th class='notaO'>Promedio Objetivo</th>
							<th class='notaC'>Promedio Competencia</th>
							<th class='coeficiente'>Coeficiente Evaluacion</th>
						</tr>
						</thead>
						<tbody>
						
					<?php
					$pos=1;
					foreach($ordenado as $key=>$coeficiente)
					{
							$nombre=$adoR->getNameEmpleado($key);
							$notaO=$adoR->getAVGempleado($key,'o');
							$notaC=$adoR->getAVGempleado($key,'c');
							
							echo"
							<tr class=''>
								<td class='posicion'>$pos</td>
								<td class='nombre'>$nombre</td>
								<td class='notaO'>$notaO</td>
								<td class='notaC'>$notaC</td>
								<td class='coeficiente'>$coeficiente</td>
							</tr>";
						$pos++;
					
					}
					?>

						
						</tbody>
					</table>
						    <div class="clear"></div>

			</div>			
		</div>
		</div>
	    <div class="clear"></div>

<!--==============================footer=================================-->
<?php include("footer/pie.php"); ?>
</body>
</html>