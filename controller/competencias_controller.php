<?php
session_start();
/*
 * Guarda el objetivo creado
 */

if ($_SERVER['REQUEST_METHOD']=='POST') { // ¿Nos mandan datos por el formulario?
    require('../model/class.objetivo.php'); //incluimos la clase perfil
	require('../php_lib/conexion.php'); //incluimos la clase conexion
	require('../php_lib/ado.objetivo.php');//incluimos la clase de acceso a datos

//creamos el objeto de acceso a datos de objetivos
	$ado=new adoObjetivo();
	
//obtenemos un array con la lista completa de competencias
$competencias=$ado->getCompetencias();

//generamos los POST que reciviran los datos generados en competencias.php
foreach($competencias as $key=>$nombre){

	if(@$_POST[$key])
	{
		$competencias_selectas[$key]=$_POST[$key];
	}
}
 //var_dump($competencias_selectas);
	
//Guardamos los datos en session para almacenarlos mas adelante
	$_SESSION['TEMP']['competencias_selectas']=$competencias_selectas;
	
//volvemos a alta_perfil.php
	header('Location: ../view/nuevo_objetivo.php');
	die();
} 
?>
