<?php
session_start();
/*
 * 
 */
 
//limpiamos las variables guardadas en sesion
unset($_SESSION['lista']);
unset($_SESSION['TEMP']);

if ($_SERVER['REQUEST_METHOD']=='POST') { // ¿Nos mandan datos por el formulario?
    //require('../model/class.periodo.php'); //incluimos la clase periodo
	require_once('../php_lib/conexion.php'); //incluimos la clase conexion
	require('../php_lib/ado.empleado.php');//incluimos la clase de acceso a datos
	require('../php_lib/ado.periodo.php');//incluimos la clase de acceso a datos de periodo
	
	$adoE=new adoEmpleado();
	$adoP=new adoPeriodo();
	$id= $adoE->getIdByDni(@$_SESSION['USUARIO']['user']);
	//var_dump($id);
	
//recibimos los datos por post y los guardamos en variables
    @$nombre=$_POST['nombre_periodo'];
	@$inicio=$_POST['theDate1'];
	@$fin=$_POST['theDate2'];
	@$creador=$id;
	@$cantidad=$_POST['cantidad'];
	
//verificamos si el nombre existe en la BD ( checkPeriodo retorna true o false)
	$existe=$adoP->checkPeriodo($nombre);

//Guardamos en session el resultado
	$_SESSION['TEMP']['existe']=$existe;
	
//si el nombre ya esta en uso volvemos a crear_periodo.php
	if($existe){
	$_SESSION['MSJ']="* Ya existe un periodo con el nombre $nombre";
	header("Location: ../crear_periodo.php");
	die();
	}
//si no continuamos normalmente 

//guardamos en session los DATOS
	
	$_SESSION['TEMP']['nombre_periodo']=$nombre;
	$_SESSION['TEMP']['inicio']=$inicio;
	$_SESSION['TEMP']['fin']=$fin;
	$_SESSION['TEMP']['cantidad']=$cantidad;
	$_SESSION['TEMP']['creador']=$id;

//echo $_SESSION['TEMP']['creador'];	
	
//vamos a agregar_evaluaciones.php
	//unset($_SESSION['MSJ']);
	header('Location: ../view/agregar_evaluaciones.php');
	die();
} 
?>