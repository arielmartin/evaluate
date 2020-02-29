<?php
session_start();
/*
 * 
 */

 //limpiamos las variables guardadas en sesion
unset($_SESSION['lista']);
unset($_SESSION['TEMP']);
 
if ($_SERVER['REQUEST_METHOD']=='POST') { // ¿Nos mandan datos por el formulario?
   
	require_once('../php_lib/conexion.php'); //incluimos la clase conexion
	require('../php_lib/ado.empleado.php');//incluimos la clase de acceso a datos de empleado
	require('../php_lib/ado.periodo.php'); //incluimos la clase de acceso a datos de periodo
	require('../model/class.periodo.php');
	
	
	$adoE=new adoEmpleado();
	$adoP=new adoPeriodo();
	//$id= $adoE->getIdByDni(@$_SESSION['USUARIO']['user']);
	
//recibimos los datos por post y los guardamos en variables
    @$id_periodo=$_POST['id_periodo'];
		
//obtenemos los datos del periodo
	$obj_periodo=$adoP->getPeriodo($id_periodo);
	var_dump($obj_periodo);
	
//guardamos en session los DATOS del Periodo
	
	$_SESSION['TEMP']['id_periodo']=$id_periodo;
	$_SESSION['TEMP']['nombre_perido']=$obj_periodo->getNombre();
	$_SESSION['TEMP']['inicio']=$obj_periodo->getInicio();
	$_SESSION['TEMP']['fin']=$obj_periodo->getFin();	
	
//guardamos en session un array con las fechas de evaluacion

	$fechas_ev=$adoP->getFechas($id_periodo);
	$_SESSION['TEMP']['fechas_ev']=$fechas_ev;
	
//guardamos en session un array con los empleados

	$empleados=$adoP->getEmpleados($id_periodo);
	$_SESSION['TEMP']['empleados']=$empleados;
	//var_dump($empleados);
	
//vamos a periodo_vigente.php
	header('Location: ../view/periodo_vigente.php');
	die();
} 
?>