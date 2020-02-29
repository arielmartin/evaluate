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
	require('../php_lib/ado.objetivo.php');//incluimos la clase de acceso a datos de los objetivos
	require('../php_lib/ado.perfil.php');//incluimos la clase de acceso a datos de los perfiles
	require('../model/class.perfil.php');//incluimos el modelo de la clase perfil
	//creamos los objetos de acceso a datos
	$ado=new adoObjetivo();
	$adoP=new adoPerfil();
	$adoE=new adoEmpleado();
	
//recibimos por GET el id del empleado 
$id_empleado=$_GET['id'];
//lo guardamos en session
$_SESSION['TEMP']['id_empleado']=$id_empleado;
//var_dump($_SESSION['TEMP']['id_empleado']);

//recuperamos el id_periodo de la session
$id_periodo=$_SESSION['TEMP']['id_periodo'];
//var_dump($_SESSION['TEMP']['id_periodo']);

//obtenemos un array con los objetivos del empleado de este periodo
$objetivos=$ado->getObjetivos($id_empleado,$id_periodo);
//var_dump($objetivos);

//obtenemos un array con los promedios de los objetivos
foreach($objetivos as $key=>$nombre){
$promedios_objetivos[$key]=$ado->getAVGobjetivo($key,$id_empleado,$id_periodo);
}

//buscamos el objeto perfil correspondiente
$obj_perfil=$adoP->findPerfil($id_empleado,$id_periodo);
//var_dump($obj_perfil);

//obtenemos un array con las competencias del perfil
$competencias=$ado->getCompetencias($obj_perfil->getId());
//var_dump($competencias);

//obtenemos un array con los promedios de las competencias
foreach($competencias as $key=>$nombre){
$promedios_competencias[$key]=$ado->getAVGobjetivo($key,$id_empleado,$id_periodo);
//echo 'key: '.$key.'</br>';
}
//var_dump($competencias);
//var_dump($promedios_competencias);

?>
<div class="container_12" id="dejar_espacio5">
<div id="div_titulo">
<label class="subtitulo"><?php echo ''.$adoE->getNameEmpleado($id_empleado); ?></label>
</br>
<label class="subtitulo2"><?php echo ''.$obj_perfil->getNombre(); ?></label>
</div>
<div class="clear cl1" id="espacio"></div>
		<div class="content" id="dejar_espacio">
		
		<div class="grid_6" id="columna_objetivos">
			<h5 class="texto2">Objetivos</h5>
			<ul id="lista_objetivos">
				<?php
				if(@$objetivos)
				{
					echo"<table id='tabla_objetivos_para_evaluar'><tbody> ";
					foreach($objetivos as $key=>$nombre){
							echo "
						<tr>
							<td class=''><li><a href='../controller/detalles_controller.php?id=$key'>$nombre</td>
							<td id='derecha'>$promedios_objetivos[$key]</a></li></td> </li>
						</tr>
						";
					}
											echo"</tbody></table>	";
				}
				?>
			</ul>
		</div>


		<div class="grid_6" id="columna_objetivos">
			<h5 class="texto2">Competencias</h5>
			<ul id="lista_competencias_desactivada">
				<?php
				if(@$competencias)
					{
						echo"<table id='tabla_competencias'><tbody> ";
						foreach($competencias as $key=>$nombre){
						echo"
							<tr>
							<td><li>$nombre</td>
							<td id='derecha'>$promedios_competencias[$key]</td> </li>
							</tr>
						";
						}
						echo"</tbody></table>	";
					}
				?>
			</ul>
		</div>

		</div>
	    <div class="clear cls" id=""></div>

		</div>


<!--==============================footer=================================-->
</div>
<?php include("footer/pie.php"); ?>
</body>
</html>