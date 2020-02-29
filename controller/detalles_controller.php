<?php session_start();
/*
 * 
 */
   
require_once('../php_lib/conexion.php'); //incluimos la clase conexion
require('../php_lib/ado.objetivo.php');//incluimos la clase de acceso a datos de objetivo

$ado=new adoObjetivo();
	
//recibimos los datos por GET y por SESSION y los guardamos en variables

$id_objetivo=$_GET['id'];
$_SESSION['TEMP']['id_objetivo']=$id_objetivo;
$id_empleado=$_SESSION['TEMP']['id_empleado'];
$id_periodo=$_SESSION['TEMP']['id_periodo'];

echo '<h2>Fechas de evaluacion: </h2>';
@$fechas=$ado->getFechasEvaluacion($id_objetivo,$id_empleado,$id_periodo);

echo 'id_objetivo: '.$id_objetivo;
echo '</br>';
echo 'id_empleado: '.$id_empleado;
echo '</br>';
echo 'id_periodo: '.$id_periodo;
echo '</br>';

var_dump($fechas);

$id_evaluacion=$ado->evaluacionActual($fechas);

$_SESSION['TEMP']['id_evaluacion']=$id_evaluacion;

$rol=@$_SESSION['USUARIO']['rol'];
echo "rol: "; var_dump($rol);
echo "page: "; var_dump($_SESSION['TEMP']['page']);
//die();

if($rol=='0' or @$_SESSION['TEMP']['page']==1)
	{
	//Si soy solo un empleado vamos a revisar_objetivo_EMP.php
	header('Location: ../view/revisar_objetivo_EMP.php');
	die();
	}
//si no vamos a evaluar_objetivo.php
	header('Location: ../view/evaluar_objetivo.php');
	die();

?>