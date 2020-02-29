<?php session_start();
/*
 * Valida un usuario y contraseña o presenta el formulario para hacer login denuevo
 */

if ($_SERVER['REQUEST_METHOD']=='POST') { // ¿Nos mandan datos por el formulario?
    //include('../php_lib/config.ini.php'); //incluimos configuración
    include('../php_lib/ado.login.php'); //incluimos las funciones

//echo"<br>";var_dump($_POST);die();

    //verificamos el usuario y contraseña mandados 
    if (login($_POST['usuario'],$_POST['pass'])) {
			if ($_SESSION['USUARIO']['rol']==1){
				header('Location: ../view/home_admin.php');
				die("1");
			}
			if ($_SESSION['USUARIO']['rol']==2){
				header('Location: ../view/home_evaluador.php');
				die("2");
			}
			if ($_SESSION['USUARIO']['rol']==3){
				header('Location: ../view/home_admin.php');
				die("3");
			}
			if ($_SESSION['USUARIO']['rol']==0){
				header('Location: ../view/home_empleado.php');
				die("0");
			}
			
    } 
	//si el usuario no es valido
	else {
        //acciones a realizar en un intento fallido
        //Ej: mostrar captcha para evitar ataques fuerza bruta, bloqueas durante un rato esta ip, ....
        //preparamos un mensaje de error y continuamos para mostrar el formulario de login
		//$mensaje='Usuario o contraseña incorrecto.';
		
		header('Location: ../view/home.php');
		exit;
    }
} //fin if post

?>