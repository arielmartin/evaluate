<?php @session_start(); ?>

<!DOCTYPE html>
<html lang="es">
	<head>
	 <?php include("metadata.php"); ?>
	</head>
 <body class="page1" id="top">
<!--==============================header=================================--> 
<div class="container_12">
<div class="grid_12">
<?php include("header/header.php"); ?>
<!--==============================menu=================================--> 
<?php include("menu/menu.php"); ?>
</div>
</div>
<!--==============================Content=================================-->
  <div class="container_12">
    <div class="content">
      <!--
      <div class="grid_12">
          <div class="map">
                <figure>
                  <iframe src="https://mapsengine.google.com/map/embed?mid=zGH4DTZm7YLQ.kmxOGROxmaHA"></iframe>
               </figure> 
          </div>
      </div>  -->
    <div class="clear"></div>
	
	
    <div class="grid_2" id="">
	
        <h4 class="head1">Datos</h4>
        <p>Evaluate<br>
         Florencio Varela 1903 <br>
  	     San Justo</br>
  	     Buenos Aires, Argentina</p>
         Tel&eacute;fono (54-11) 4480-8900<br>
    </div>
	
    <div class="grid_6 prefix_1" id="">
      <h4 class="head1">Contacto</h4>

      <form id="form_contacto" class="form_contacto" method="post" action="../php_lib/MailHandler.php">
                      <input type="text" name="nombre" placeholder="Nombre:"/>
                      <input type="text" name="email" placeholder="E-mail:"/>
                      <input type="text" name="telefono" class="placeholder" placeholder="Telefono:"/>
                      <textarea name="mensaje" placeholder="Mensaje:"></textarea>
                    
					<div class="clear"></div>
					  
					  
                      <div class="btns" id="">
					  		<button class="button3" type="submit">ENVIAR</button>
                      </div>
			</form> 
		  
				
				

    </div>
				<div class="grid_3" id="divErrores_contacto">
					<ul id="lista" class="aclaracion"></ul>
				</div>
	
	
  </div>
</div>
<!--==============================footer=================================-->
	<?php include("footer/pie.php"); ?>
</body>
</html>