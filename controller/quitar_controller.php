<?php
session_start();
/*
 * 
 */

 //recivimos el ID por get
 $id=$_GET['id'];
 
//limpiar los datos de session 

unset($_SESSION['lista'][$id]);
$_SESSION['TEMP']['quitar']='quitado';

//volvemos a buscar_registro.php
	header('Location: ../view/agregar_empleados.php');
	die();
			
	
	
?>

