<?php
session_start();
/*
 * Guarda en session los objetivo creados
 */

if ($_SERVER['REQUEST_METHOD']=='POST') { // ¿Nos mandan datos por el formulario?
	require('../php_lib/conexion.php'); //incluimos la clase conexion
	require('../php_lib/ado.perfil.php');//incluimos la clase de acceso a datos
	
	$adoP=new adoPerfil();
	
//recibimos los datos por post
    @$nombre=$_POST['nombre_perfil'];
	@$descripcion=$_POST['descripcion_perfil'];
	
//guardamos en session el los datos del perfil 
	$_SESSION['TEMP']['nombre_perfil']=$nombre;
	$_SESSION['TEMP']['descripcion_perfil']=$descripcion;

$existe=$adoP->checkPerfil($nombre);

if($existe){
//volvemos a alta_perfil.php
	$_SESSION['MSJ']="* Ya existe un perfil con el nombre $nombre";
	header("Location: ../view/alta_perfil.php");
	die();
	}
else{
//vamos a nuevo_objetivo.php
unset($_SESSION['MSJ']);
	header('Location: ../view/competencias.php');
	die();
	} 
}
?>
