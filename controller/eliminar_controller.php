<?php
session_start();
/*
 * Recibe un numero por SESSION de dni que usaremos para eliminar al empleado
 */
	require_once('../php_lib/conexion.php'); //incluimos la clase conexion
	require_once('../php_lib/ado.empleado.php');//incluimos la clase de acceso a datos
	
	//Creamos el objeto ado
	$ado=new adoEmpleado();

	//obtenemos el id por el dni
	$id=$ado->getIdByDni($_SESSION['borrar']);
	
	//eliminados empleaqdo y usuario
	$ado->eliminarEmpleado($id); 
	
	//guardamos en la variable de session una bandera
	$_SESSION['borrar']='borrado';
	
	//volvemos a buscar_registro.php
	header('Location: ../buscar_registro.php');
	die();
			
	
	
?>