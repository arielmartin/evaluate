<?php
session_start();
/*
 * 
 */

if ($_SERVER['REQUEST_METHOD']=='POST') { // ¿Nos mandan datos por el formulario?
   
	require_once('../php_lib/conexion.php'); //incluimos la clase conexion
	require('../php_lib/ado.empleado.php');//incluimos la clase de acceso a datos de empleado
	require('../php_lib/ado.periodo.php'); //incluimos la clase de acceso a datos de periodo
	require('../model/class.periodo.php');
	
	
	$adoE=new adoEmpleado();
	$adoP=new adoPeriodo();
	//$id= $adoE->getIdByDni(@$_SESSION['USUARIO']['user']);
	
//recibimos un id de periodo por post y los guardamos en una variable
 @$id_periodo=$_POST['id_periodo'];
	
//recibimos por session la pagina
$page=$_SESSION['TEMP']['page'];
		
//obtenemos los datos del periodo
	$obj_periodo=$adoP->getPeriodo($id_periodo);
	//var_dump($obj_periodo);
	
//guardamos en session los DATOS del Periodo
	
	$_SESSION['TEMP']['id_periodo']=$id_periodo;
	$_SESSION['TEMP']['nombre_perido']=$obj_periodo->getNombre();
	$_SESSION['TEMP']['inicio']=$obj_periodo->getInicio();
	$_SESSION['TEMP']['fin']=$obj_periodo->getFin();	
	
//guardamos en session un array con las fechas de evaluacion

	$fechas_ev=$adoP->getFechas($id_periodo);
	$_SESSION['TEMP']['fechas_ev']=$fechas_ev;
	
//obtenemos un array con los empleados del periodo
	$empleados=$adoP->getEmpleados($id_periodo);

//quitamos el usuario logueado del array
	$id_user= $adoE->getIdByDni(@$_SESSION['USUARIO']['user']);
	unset($empleados[$id_user]);
	
//guardamos el array en session
	$_SESSION['TEMP']['empleados']=$empleados;
	
if($page==1){
	//vamos a detalles_objetivos_emp.php
	header("Location: ../view/detalles_objetivos_EMP.php?id=$id_user");
	die();
	}
	
if($page==2){
	//vamos a detalles_objetivos_emp.php
	header("Location: ../view/detalles_objetivos_EMP.php?id=$id_user");
	die();
	}	
	
if($page==3){
	//vamos a periodo_vigente.php
		header('Location: ../view/periodo_vigente_EMP.php');
		die();
	}
} 
?>