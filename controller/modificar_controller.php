<?php
session_start();
/*
 * 
 */

if ($_SERVER['REQUEST_METHOD']=='POST') { // ¿Nos mandan datos por el formulario?
    require_once('../model/class.empleado.php'); //incluimos la clase empleado
	require_once('../php_lib/conexion.php'); //incluimos la clase conexion
	require_once('../php_lib/ado.empleado.php');//incluimos la clase de acceso a datos
	
	//recibimos los datos por post
    @$nombre=$_POST['nombre'];
	@$apellido=$_POST['apellido'];
	@$dni=$_POST['dni'];
	@$email=$_POST['email'];
	@$puesto=$_POST['puesto'];
	@$pass=$_POST['password'];
	@$rol1=$_POST['rol1'];
	@$rol2=$_POST['rol2'];
	
	@$usuario=$_POST['dni']; //usamos el dni como usuario

	//die(print_r($_POST) );
	
	//Generamos el hash de la contraseña encriptada para comparar o lo dejamos como texto plano
        switch (METODO_ENCRIPTACION_CLAVE) {
            case 'sha1'|'SHA1':
                $hash=sha1($pass);
                break;
            case 'md5'|'MD5':
                $hash=md5($pass);
                break;
            case 'texto'|'TEXTO':
                $hash=$pass;
                break;
            default:
                trigger_error('El valor de la constante METODO_ENCRIPTACION_CLAVE no es válido. Utiliza MD5 o SHA1 o TEXTO',E_USER_ERROR);
	}	
	
	//definimos la variabel $rol
	if (!$rol2){@$rol=1;};
	if (!$rol1){@$rol=2;};
	if ($rol1 and $rol2){@$rol=3;};
	if (!$rol1 and!$rol2){@$rol=0;};
	

//creamos el objeto empleado con los datos recividos
	$empleado1 = new empleado($nombre,$apellido,$dni,$email,$puesto,$usuario,$hash,$rol);

//guardamos el empleado en la BD
	$ado = new adoEmpleado();
	$ado->updateEmpleado($empleado1);
	

	//guardamos en la variable de session una bandera
	$_SESSION['modificar']='modificado';

	//volvemos a buscar_registro.php
	header('Location: ../view/buscar_registro.php');
	die();
} 
?>
