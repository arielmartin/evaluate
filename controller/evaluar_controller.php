<?php session_start();
/*
 * 
 */
   
require_once('../php_lib/conexion.php'); //incluimos la clase conexion
require('../php_lib/ado.objetivo.php');//incluimos la clase de acceso a datos de objetivo

$ado = new adoObjetivo();

$data = $_SESSION['USUARIO']['user'];
//echo"<pre>";print_r($data);echo"</pre>";

//recibimos los datos  SESSION y los guardamos en variables

$id_objetivo=$_SESSION['TEMP']['id_objetivo'];
$id_empleado=$_SESSION['TEMP']['id_empleado'];
$id_evaluacion=$_SESSION['TEMP']['id_evaluacion'];


//Obtenemos el id del evaluador (usuario logueado)
$id_evaluador = $ado->getIdByDni($data);

//Recibimos la nota por POST:

$nota = $_POST['ddl_notas'];

var_dump($nota);

@$fechas = $ado->getFechasEvaluacion($id_objetivo,$id_empleado,$id_periodo);

//Guardamos la nota (requiere id_objetibo, id_empleado,id_evaluacion, nota y id del evaluador)
$ado->guardarNota($id_objetivo,$id_empleado,$id_evaluacion,$nota, $id_evaluador);
	
//vamos a evaluar_objetivo.php
	header('Location: ../view/evaluar_objetivo.php');
	die();

?>