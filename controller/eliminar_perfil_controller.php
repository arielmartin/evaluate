<?php
session_start();
/*
 * Recibe un numero por SESSION de dni que usaremos para eliminar al empleado
 */
	require_once('../php_lib/conexion.php'); //incluimos la clase conexion
	require_once('../php_lib/ado.perfil.php');//incluimos la clase de acceso a datos
	
	$adoP= new adoPerfil();
	
//recibimos los datos por post 
    @$id_perfil=$_POST['id_perfil'];

//checkeamos que el perfil no este en uso
	$enUso=$adoP->checkUsoPerfil($id_perfil);
	var_dump($enUso);

if($enUso==null){
	$adoP->eliminarPerfil($id_perfil);
	$_SESSION['MSJ']="* Perfil eliminado";
	$_SESSION['TEMP']['enUso']=false;
}
else{
	$_SESSION['MSJ']="* Perfil en uso";
	$_SESSION['TEMP']['enUso']=true;
}
	
//volvemos a buscar_registro.php
	
	header('Location: ../view/eliminar_perfiles.php');
	die();
			
	
	
?>