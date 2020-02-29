<?php
session_start();
/*
 * 
 */

if ($_SERVER['REQUEST_METHOD']=='POST') { // ¿Nos mandan datos por el formulario?
include ("../php_lib/formato_fechas.php");
unset($_SESSION['MSJ']);
unset($_SESSION['TEMP']['evaluaciones']);

//tomamos los DATOS del Periodo

	$inicio=$_SESSION['TEMP']['inicio'];
	
	$fin=$_SESSION['TEMP']['fin'];

	$cantidad=$_SESSION['TEMP']['cantidad'];
	

echo 'Periodo desde: '. $inicio.' hasta '. $fin;
		
//recibimos las fechas por post y las guardamos en session
for($i=1 ; $i<=$cantidad ; $i++)
   {
   	$fechaPost=$_POST['theDate'.$i];
	
	if($fechaPost==''){
	//verifica si faltan fechas 
	    $_SESSION['MSJ']="* Falto establecer alguna fecha";
		header('Location: ../view/agregar_evaluaciones.php');
		die();
		}
		
	$fechas[$i]=stdasql($fechaPost);
	
   }
   
//$fechas =$fechasPost;
   //var_dump($fechas);
   
$fechas_copia = array_unique($fechas);
	
//verifica que no se repitan fechas
if(count($fechas_copia) != count($fechas)) {
    $_SESSION['MSJ']="*  Fechas repetidas";
	header('Location: ../view/agregar_evaluaciones.php');
	die();
} 
	
$inicioSql = stdasql($inicio);
//var_dump($inicioSql);

$finSql = stdasql($fin);
//var_dump($finSql);
	
foreach($fechas as $fecha)  { 
	
	if($fecha<$inicioSql or $fecha>$finSql) {
	
		//Verifica el rango
		$_SESSION['MSJ']="* Fechas fuera de rango";
		header('Location: ../view/agregar_evaluaciones.php');
		die();
	}

  }
  
 //Ordena las fechas 

	$fechas_ordenadas=ordenar($fechas);
	//var_dump($fechas_ordenadas);
	$_SESSION['TEMP']['evaluaciones']=$fechas_ordenadas;
	var_dump($_SESSION['TEMP']['evaluaciones']);
	
//vamos a agregar_empleados.php
	header('Location: ../view/agregar_empleados.php');
	die();
} 
?>