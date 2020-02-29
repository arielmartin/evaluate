<?php
session_start();
/*
 * Recibe un numero por SESSION de dni que usaremos para eliminar al empleado
 */
	$nombre_objetivo=$_GET['objetivo'];

	unset($_SESSION['TEMP']['objetivos'][$nombre_objetivo]);
	
	
	//volvemos a buscar_registro.php
	header('Location: ../view/nuevo_objetivo.php');
	die();
			
	
	
?>