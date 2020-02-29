<?php
	require_once('../php_lib/conexion.php'); //incluimos la clase conexion
	require('../php_lib/ado.objetivo.php');//incluimos la clase de acceso a datos de los objetivos
	require('../php_lib/ado.perfil.php');//incluimos la clase de acceso a datos de los perfiles
	require('../model/class.perfil.php');//incluimos la clase perfil
	
	$ado=new adoObjetivo();
	$adoP=new adoPerfil();
	$adoE=new adoEmpleado();
	
//recibimos por GET el id del empleado 
$id_empleado=$_GET['id'];

//recuperamos el id_periodo de la session
$id_periodo=$_SESSION['TEMP']['id_periodo'];

//nos retorna el objeto perfil correspondiente
$obj_perfil=$adoP->findPerfil($id_empleado,$id_periodo);

//obtenemos un array con las competencias del perfil
$competencias=$ado->getCompetencias($obj_perfil->getId());
//var_dump($competencias);

foreach($competencias as $key=>$nombre){
$promedios[$key]=$ado->getAVGobjetivo($key,$id_empleado,$id_periodo);
//var_dump($key);
}

?>
<div class="container_12">
<div id="div_titulo">
<label class="subtitulo"><?php echo ''.$adoE->getNameEmpleado($id_empleado); ?></label>
</br>
<label class="subtitulo2"><?php echo ''.$obj_perfil->getNombre(); ?></label>
</div>
<div class="clear cl1" id="espacio"></div>
		<div class="content" id="dejar_espacio">
		

		
		<div class="grid_8 prefix_2" id="columna_competencias">
			<h5 class="texto2">Mis Competencias</h5>
			<ul id="lista_objetivos_desactivada">
				<?php
				if(@$competencias)
					{
					echo"<table id='tabla_competencias' class='abm_perfil'><tbody> ";

						foreach($competencias as $key=>$nombre){
							echo "
							<tr> 
							<td><li>$nombre</li> </td>
							<td id='derecha'> $promedios[$key]</td>
							</tr>
							";
							}
							echo"</tbody></table>	";
					}
				?>
			</ul>
		</div>
		
	</div>
 
 <div class="clear"></div>
 </div> 
