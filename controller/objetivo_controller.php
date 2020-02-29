<?php
session_start();
/*
 * Guarda en session los objetivo creados
 */

if ($_SERVER['REQUEST_METHOD']=='POST') { // ¿Nos mandan datos por el formulario?
    require('../model/class.objetivo.php'); //incluimos la clase perfil
	require('../php_lib/conexion.php'); //incluimos la clase conexion
	require('../php_lib/ado.objetivo.php');//incluimos la clase de acceso a datos
	require('../php_lib/ado.perfil.php');//incluimos la clase de acceso a datos
	$adoP=new adoPerfil();
	
	//recibimos los datos por post
    @$nombre=$_POST['nombre_objetivo'];
	@$descripcion=$_POST['descripcion_objetivo'];
	@$tipo='o';
	
	//@$id_perfil=$_SESSION['id_perfil'];
	//@$id_perfil=$adoP->NextIdPerfil();

//var_dump($id_perfil);

//Guardamos los datos en una variable temporal
	
	$_SESSION['TEMP']['objetivos'][$nombre]=$descripcion;
	//var_dump($_SESSION['TEMP']['objetivos']);
	
//guardamos el objetivo en la BD
	//$ado=new adoObjetivo();
	//$ado->guardarObjetivo($obj);


//vamos a nuevo_objetivo.php
	header('Location: ../view/nuevo_objetivo.php');
	die();
} 
?>
