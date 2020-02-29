<div class="grid_12">
<p class="subtitulo2">
<?php


if ($_SERVER['REQUEST_METHOD']=='POST') { // ¿Nos mandan datos por EL FORM?
    //require_once('model/class.empleado.php'); //incluimos la clase empleado
	require_once('../php_lib/conexion.php'); //incluimos la clase conexion
	//require_once('php_lib/ado.empleado.php');//incluimos la clase de acceso a datos
	
	//Creamos el objeto ado
	//$ado=new adoEmpleado();
	
	//recibimos los datos por get
    $dni=$_POST['dni'];
	$id=$adoE->getIdByDni($dni);
	$nombre=$adoE->getNameEmpleado($id);
	//$empleado=$adoE->getEmpleado($dni);
	
	if($nombre)
	{
		echo $nombre;
		echo ' | ';
		echo '<a href="modificar_registro.php" class="modificar"> MODIFICAR </a>';	
		$_SESSION['borrar']=$dni;
		echo ' | ';
		$_SESSION['modificar']=$dni;
		echo '<a href="../controller/eliminar_controller.php" class="eliminar">ELIMINAR</a>';

	}
	else
	{
		echo 'No se encontro empleado';
	}
}
	if(@$_SESSION['borrar']=='borrado'){
	$_SESSION['borrar']="";
		echo 'Registro Eliminado';
	}
		if(@$_SESSION['modificar']=='modificado'){
	$_SESSION['modificar']="";
		echo 'Registro Modificado';
	}
	
?>
</p>
</div>