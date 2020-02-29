<?php
session_start();
/*
 * Recibe un numero por SESSION de dni que usaremos para eliminar al empleado
 */
	require_once('../php_lib/conexion.php'); //incluimos la clase conexion
	require_once('../php_lib/ado.periodo.php');//incluimos la clase de acceso a datos
	
	$adoP= new adoPeriodo();
	
//recibimos los datos por post 
    @$id_periodo=$_POST['id_periodo'];
	var_dump($id_periodo);
	
//checkeamos que el periodo no haya comenzado
	$comenzado=$adoP->checkUsoPeriodo($id_periodo);
	var_dump($comenzado);

	$adoP->eliminarPeriodo($id_periodo);
	echo "Periodo eliminado";
	$_SESSION['TEMP']['comenzado']=false;

//volvemos a buscar_registro.php
	header('Location: ../view/eliminar_periodos.php');
	die();
			
	
	
?>