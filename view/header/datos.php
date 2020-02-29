<?php
//incluimos el archovo de la clase empleado y la clase ado y creamos el objeto ado
require_once('../model/class.empleado.php');
require_once('../php_lib/conexion.php');
require_once('../php_lib/ado.empleado.php');
$adoE = new adoEmpleado();

//tomamos las variables de session
$user=$_SESSION['USUARIO']['user'];
$rol=$_SESSION['USUARIO']['rol'];

switch ($rol) {
  case 1:
    $rol_name='Administrador';
    break;
  case 2:
    $rol_name='Evaluador';
    break;
  case 3:
    $rol_name='Evaluador - Admin.';
    break;
  default:
	$rol_name='Empleado';
	break;
} 
if($user!='admin'){
$id=$adoE->getIdByDni($user);
$user=$adoE->getNameEmpleado($id);

//$obj_empleado=$ado->getEmpleado($user);
//$user=$obj_empleado->getNombre()." ".$obj_empleado->getApellido();

}else{
  $user="Super Administrador";	
}
?>
<form action="../php_lib/logout.php" method="post">
				<span class="user"><?php echo $user?></span>
				<span class="rol">|<?php echo $rol_name?>| </span>
				<input type="submit" value="Logout"/>
				<a href="#"><img src="../public/images/user_icon.jpg"></a>
</form>	
   