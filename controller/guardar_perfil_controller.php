<?php
session_start();
/*
 * Guarda el perfil creado
 */


    require('../model/class.perfil.php'); //incluimos la clase perfil
	require('../model/class.objetivo.php'); //incluimos la clase objetivo / competencia
	require('../php_lib/conexion.php');//incluimos la clase  coneccion
	require('../php_lib/ado.perfil.php');//incluimos la clase de acceso a datos
	require('../php_lib/ado.objetivo.php');//incluimos la clase de acceso a datos
	
	$ado=new adoObjetivo();
	$adoP=new adoPerfil();
	
//recibimos los datos por session
    @$nombre=$_SESSION['TEMP']['nombre_perfil'];
	@$descripcion=$_SESSION['TEMP']['descripcion_perfil'];
	
//creamos el objeto objetivo con los datos recividos
	$obj_perfil = new perfil($nombre,$descripcion);

//guardamos el perfil en la BD y obtenemos su id
	$id_perfil=$adoP->guardarPerfil($obj_perfil);

//lista de competencias selectas para este perfil
	$competencias=$_SESSION['TEMP']['competencias_selectas'];

//Almacenamos en la BD con el metodo "competencia_perfil" que establece las relaciones 
foreach($competencias as $id_competencia)
{
	$adoP->competencia_perfil($id_competencia,$id_perfil);
}
//var_dump($competencias);

//guardamos los objetivos
$objetivos=$_SESSION['TEMP']['objetivos'];
$tipo='o';

foreach($objetivos as $nombre=>$descripcion)
{
//creamos el objeto objetivo con los datos recividos
	$obj = new objetivo($nombre,$descripcion,$tipo,$id_perfil);
	$ado->guardarObjetivo($obj);
}

//borramos las variables temporales de session
unset($_SESSION['TEMP']);
	
//salimos del modulo perfil.php
//$_SESSION['MSJ']="Perfil creado con exito";
	header('Location: ../view/home_evaluador.php');
	die();

?>