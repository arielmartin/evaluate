<?php
session_start();
/*
 * 
 */

    require('../model/class.periodo.php'); //incluimos la clase periodo
	require_once('../php_lib/conexion.php'); //incluimos la clase conexion
	require('../php_lib/ado.periodo.php');//incluimos la clase de acceso a datos
	require('../php_lib/formato_fechas.php');
	
	$adoP=new adoPeriodo();
	
//tomamos los datos del Periodo de la session
	
	$nombre=$_SESSION['TEMP']['nombre_periodo'];
	$inicio=$_SESSION['TEMP']['inicio'];
	$fin=$_SESSION['TEMP']['fin'];
	$id_creador=$_SESSION['TEMP']['creador'];		
	$cantidad=$_SESSION['TEMP']['cantidad'];

	
$inicio=stdasql($inicio);
//var_dump($inicio);

$fin=stdasql($fin);
//var_dump($fin);
	
//creamose el objeto periodo
	@$obj_periodo= new periodo($nombre, $inicio, $fin, $id_creador);
    //var_dump($obj_periodo); //para ver el contenido del objeto
//die();
	
//Lista con los nombres y los perfiles de los empleados
	$lista=$_SESSION['lista'];
	//echo var_dump($lista);	

if(!$lista)	
{
	header('Location: ../view/agregar_empleados.php');
	die();
}

//Guardamos el Periodo y recuperamos el id
	$id_periodo=$adoP->guardarPeriodo($obj_periodo);
	//var_dump($id_periodo);
	
//Guardamos las fechas de EVALUACION
$tipo='o';
  for($i=0 ; $i<$cantidad ; $i++)
   {
   		$fecha=$_SESSION['TEMP']['evaluaciones'][$i];
		$adoP->guardarFecha($fecha,$id_periodo,$tipo);
   }	

   
//Guardamos las relaciones empleado-periodo-perfil en la BD
foreach ($lista as $key=>$id)
{
	//key = id_empleado
	//id[2] = id_perfil
	//id_periodo = id_periodo
	$adoP->guardarRelacion($key , $id[2] , $id_periodo);
}
//var_dump($lista);


//limpiamos las variables guardadas en sesion
unset($_SESSION['lista']);
unset($_SESSION['TEMP']);

//vamos al menu principal
	header('Location: ../view/home_evaluador.php');
	die();
?>