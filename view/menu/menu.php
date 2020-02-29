<?php

$rol=@$_SESSION['USUARIO']['rol'];
//var_dump($rol);

switch ($rol) {
  case 0:
  //solo empleado 
    $principal='home_empleado.php';
    break;
  case 1:
  //administrador y empleado
    $principal='home_admin.php';
    break;
  case 2:
  //evaluador y empleado
    $principal='home_evaluador.php';
    break;
  case 3:
  //administrador, evaluador y empleado
    $principal='home_admin.php';
    break;
  default:
	$principal='home.php';
	break;
} 
?>


<div class="menu_block">
          <nav class="horizontal-nav full-width horizontalNav-notprocessed">
            <ul class="sf-menu">
				<!--<li><a href="session_test.php">Session Test</a></li><!--linea de prueba temporal-->
			<?php 
			if ($rol=='0'){
			echo "<li><a href='home_empleado.php'>Menu Empleado</a></a></li> ";
			}
			if ($rol==1){
			echo "<li><a href='home_admin.php'>Menu Administrador</a></li> ";
			echo "<li><a href='home_empleado.php'>Menu Empleado</a></a></li> ";
			}
			if ($rol==2){
			echo "<li><a href='home_evaluador.php'>Menu Evaluador</a></li> ";
			echo "<li><a href='home_empleado.php'>Menu Empleado</a></a></li> ";
			}
			if ($rol==3){
			echo "<li><a href='home_admin.php'>Menu Administrador</a></li> ";
			echo "<li><a href='home_evaluador.php'>Menu Evaluador</a></li> ";
			echo "<li><a href='home_empleado.php'>Menu Empleado</a></a></li> ";
			}
			
			?>
                 <li><a href="contacto.php">Contacto</a></li>
             </ul>
           </nav>
           <div class="clear"></div>
</div>