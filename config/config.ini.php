<?php
/* 
 * Configuración general: conexión a la base de datos y otro parámetros
 */

 /************** Config Deply ***************
 
$mysql_host = "localhost";
$mysql_database = "";
$mysql_user = "";
$mysql_password = "";

define('HOST',$mysql_host);
define('USER',$mysql_user);
define('PASS',$mysql_password);
define('DBNAME',$mysql_database);

/********************************************/ 
 
  /************** Config Desarrollo ***************/
  
define('HOST','localhost'); //servidor de la base de datos
define('USER','root'); //usuario de la base de datos
define('PASS',''); //la clave para conectar
define('DBNAME','evaluate'); // indica el nombre de la base de datos que contiene la tabla de los usuarios

/********************************************/ 

//método utilizado para almacenar la contraseña encriptada. Opciones: sha1, md5, o texto
define('METODO_ENCRIPTACION_CLAVE','md5');

/************** define la URL del sitio ***************/

define('URL','evaluate');

/********************************************/ 

?>
