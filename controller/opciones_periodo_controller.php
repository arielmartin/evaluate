<?php
session_start();

//limpiamos las variables guardadas en sesion
unset($_SESSION['lista']);
unset($_SESSION['TEMP']);

require_once('../php_lib/conexion.php'); //incluimos la clase conexion
require('../php_lib/ado.perfil.php');//incluimos la clase de acceso a datos de perfil
$adoP=new adoPerfil();

$perfiles=$adoP->getAllPerfiles();

//$perfiles=null;

if(!$perfiles)
{
@$_SESSION['alert']="No existen perfiles, crea un perfil para poder crear un periodo";
	header('Location: ../view/opciones_periodos.php');
	die();
}
else
{
	header('Location: ../view/crear_periodo.php');
	die();
}
?>