<?php session_start();
/*
 * Página asegurada
 * Simplemente hay que añadir esta línea de PHP al principio.
 */
require('../php_lib/include-pagina-restringida.php'); //el incude para vericar que estoy logeado. Si falla salta a la página de login.php
// require('php_lib/solo_evaluadores.php');//restringe acceso a roles diferentes de 1 y 3
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
	require('../php_lib/ado.objetivo.php');//incluimos la clase de acceso a datos de los objetivos
	require('../php_lib/ado.perfil.php');//incluimos la clase de acceso a datos de los perfiles
	require('../model/class.perfil.php');//incluimos la clase perfil
	$ado=new adoObjetivo();
	$adoP=new adoPerfil();
	$adoE=new adoEmpleado();
	
//obtenemos el usuario logueado	
	$user=$_SESSION['USUARIO']['user'];
	$id_votante=$adoE->getIdByDni($user);
	
//recibimos por GET el id del empleado 
$id_empleado=$_GET['id'];

//lo guardamos en session
$_SESSION['TEMP']['id_empleado']=$id_empleado;

//recuperamos el id_periodo de la session
$id_periodo=$_SESSION['TEMP']['id_periodo'];

//obtenemos un array con los objetivos del empleado de este periodo
$objetivos=$ado->getObjetivos($id_empleado,$id_periodo);

//nos retorna el objeto perfil correspondiente
$obj_perfil=$adoP->findPerfil($id_empleado,$id_periodo);

//var_dump($obj_perfil->getId());

//obtenemos un array con las competencias del perfil
$competencias=$ado->getCompetencias($obj_perfil->getId());

//Guardamos el array en session
$_SESSION['TEMP']['competencias']=$competencias;
foreach($competencias as $key=>$nombre){
$promedios[$key]=$ado->getAVGobjetivo($key,$id_empleado,$id_periodo);
//var_dump($key);
}
//Calculos de tiempo
$ultima_evaluacion=$ado->getUltimaEvaluacion($key,$id_empleado,$id_periodo,$id_votante);
$ultimaInt = strtotime($ultima_evaluacion);
$ahora=date("Y-m-d H:i:s");
$ahoraInt = strtotime($ahora);
$time = $ahoraInt-$ultimaInt;
//VERIFICACION DEL TIEMPO TRANSCURRIDO:
/*
ECHO "Ultima votacion: $ultima_evaluacion</br>";
ECHO "Tiempo actual: $ahora</br>";
ECHO "Diferencia en segundos: $time</br>";
ECHO "86400 = un dia";
*/
?>
<div class="container_12">
<div id="div_titulo">
<label class="subtitulo"><?php echo ''.$adoE->getNameEmpleado($id_empleado); ?></label>
</br>
<label class="subtitulo2"><?php echo ''.$obj_perfil->getNombre(); ?></label>
</div>
<div class="clear cl1" id="espacio"></div>
		<div class="content" id="dejar_espacio">
		<div class="grid_10 prefix_1" id="columna_competencias">
			<h5 class="texto2">Competencias</h5>
			<ul id="lista_competencias">
				<?php
				if(@$competencias){
				//IF que activa o desactiva las votaciones de las competencias
					//time>86400  se activa diariamente
					//time>604800 se activa semanalmente
					//time>1296000 se activa cada 15 dias
					if($time>86400){
					//Form para evaluar las competencias si estan activas
						echo "
						<form action='../controller/evaluar_competencias_controller.php' method='post' id='ingresar_nota' class='abm_perfil' name='ingresar_nota'>
						";
						echo"<table id='tabla_competencias'><tbody> ";
						foreach($competencias as $key=>$nombre){
							echo "
							<tr> 
							<td><li><label>$nombre</label></li> </td>
							<td id='derecha'>
							<select id='ddl_notas' name='nota_$key'>
											<option value=5>5</option>
											<option value=4>4</option> 
											<option value=3>3</option> 
											<option value=2>2</option> 
											<option value=1>1</option> 
							</select>	
							<!--$promedios[$key]-->
							</td>
							</tr>
							";
						} echo"</tbody></table>	";
							echo "
							<button class='button' type='submit' onsubmit='return validar()'> Evaluar </button>
							</form>
							";
					}
					else{
					echo"<ul id='lista_competencias_desactivada'>";
					//cuando ya se evaluaron las competencias el select no aparecerá
					if($promedios)
					echo"<table id='tabla_competencias' class='abm_perfil'><tbody> ";
					foreach($competencias as $key=>$nombre){
							echo "
							<tr> 
							<td><li>$nombre</li> </td>
							<td id='derecha'> $promedios[$key]</td>
							</tr>
							";
							}
							echo"</tbody></table> </ul>	";
					}
				}
				?>
			</ul>
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
	   
	   <div class="clear"></div>

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