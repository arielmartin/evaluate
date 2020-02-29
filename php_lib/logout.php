<?php
/* 
 * Cierra la sesión como usuario validado
 */

include('ado.login.php'); //incluimos las funciones
logout(); //vacia la session del usuario actual
header('Location: ../index.php'); //saltamos a login.php

?>
