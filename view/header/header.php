<?php 

//include_once('php_lib/config.ini.php'); //incluimos configuración
include_once('../php_lib/ado.login.php'); //incluimos las funciones
			
?>
<header>  
    <div class="grid_4">
        <a href="../index.php">
          <img src="../public/images/logo.png" alt="Evaluate !">
		</a>
	</div> 

	<div class="prefix_4"> 

		<div id="container">
			<?php 
			if (!estoy_logueado()) { // si no estoy logueado
				include("login.php"); 
			}
			else	{
				include ("datos.php"); //si estoy logueado muestro los datos del usuario
			}
			?>
		</div>	

	</div>     
</header>