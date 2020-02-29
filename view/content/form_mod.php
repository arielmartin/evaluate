<?php
//incluimos el archivo de la clase empleado y el del ado y creamos el objeto
//require('model/class.empleado.php');
	require_once('../php_lib/conexion.php'); //incluimos la clase conexion
	$ado = new adoEmpleado();

//getEmpleado regresa un objeto con los datos del empleado
	$obj_empleado=$ado->getEmpleado(@$_SESSION[modificar]);

?>
	<div class="container_12">
	<div class="content" id="dejar_espacio">
	<div class="grid_6 prefix_3">
				<form action="../controller/modificar_controller.php" method="post" id="abm_empleados" novalidate="novalidate">
				<header>
                    Datos del Empleados
                </header>
                <fieldset>
						<section>
                        <label class="input">
                            <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $obj_empleado->getNombre()?>"></input>
                            <b class="tooltip tooltip-bottom-right">
                                Solo se admiten letras.
                            </b>
                        </label>
                    </section>
					<section>
                        <label class="input">
                            <input type="text" name="apellido" placeholder="Apellido" value="<?php echo $obj_empleado->getApellido()?>"></input>
                            <b class="tooltip tooltip-bottom-right">
                                Solo se admiten letras.
                            </b>
                        </label>
                    </section>
                    <section>
                        <label class="input">
                            <input type="numbers" name="dni" placeholder="Dni" value="<?php echo $obj_empleado->getDni()?>" readonly="readonly"></input>
                            <b class="tooltip tooltip-bottom-right">
							El DNI no se puede modificar
                            </b>
                        </label>
                    </section>
					<section>
                        <label class="input">
                            <input type="text" name="email" placeholder="Email" value="<?php echo $obj_empleado->getEmail()?>"></input>
                            <b class="tooltip tooltip-bottom-right">
                                Introduzca un E-mail verdadero por favor.
                            </b>
                        </label>
                    </section>
                    <section>
                        <label class="input">
                            <input type="text" name="puesto" placeholder="Puesto" value="<?php echo $obj_empleado->getPuesto()?>"></input>
                            <b class="tooltip tooltip-bottom-right">
							Ingrese el puesto que tiene en la empresa
                            </b>
                        </label>
                    </section>
                    <section>
                        <label class="input">
							<input id="password" type="password" name="password" placeholder="Contrase&ntilde;a" />
                            <b class="tooltip tooltip-bottom-right">
							Ingrese una contrase&ntilde;a.
							</b>
                        </label>
						<label class="input">
							<input id="password_again" type="password" name="password_again" placeholder="Repita Contrase&ntilde;a" />
                            <b class="tooltip tooltip-bottom-right">
							Confirme la contrase&ntilde;a.
                            </b>
                        </label>
                    </section>
					<section>
						<input type="checkbox"  name="rol1" value="1">Administrador</input>
						<input type="checkbox"  name="rol2" value="2">Evaluador</input>
						<label class="aclaracion">*Si no selecciona ninguno, sera un simple empleado.</label>
					</section>
                </fieldset>
                    <button class="button" type="submit">Guardar</button>
            </form>
	</div>
	</div>