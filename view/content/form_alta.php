<div class="container_12">
	<div class="content" id="dejar_espacio">
		<div class="grid_8 prefix_2">
				<form action="../controller/alta_controller.php" method="post" id="abm_empleados" novalidate="novalidate">
				<header>
                    Alta De Empleados
                </header>
                <fieldset>
						<section>
                        <label class="input">
                            <input type="text" name="nombre" placeholder="Nombre"></input>
                            <b class="tooltip tooltip-bottom-right">
                                Solo se admiten letras.
                            </b>
                        </label>
                    </section>
					<section>
                        <label class="input">
                            <input type="text" name="apellido" placeholder="Apellido"></input>
                            <b class="tooltip tooltip-bottom-right">
                                Solo se admiten letras.
                            </b>
                        </label>
                    </section>
                    <section>
                        <label class="input">
                            <input type="numbers" name="dni" placeholder="Dni"></input>
                            <b class="tooltip tooltip-bottom-right">
							Ingrese su DNI sin puntos ni espacios
                            </b>
                        </label>
                    </section>
					<section>
                        <label class="input">
                            <input type="text" name="email" placeholder="Email"></input>
                            <b class="tooltip tooltip-bottom-right">
                                Introduzca un E-mail verdadero por favor.
                            </b>
                        </label>
                    </section>
                    <section>
                        <label class="input">
                            <input type="text" name="puesto" placeholder="Puesto"></input>
                            <b class="tooltip tooltip-bottom-right">
							Ingrese el puesto que tiene en la empresa
                            </b>
                        </label>
                    </section>
                    <section>
                        <label class="input">
							<input id="password" type="password" name="password" placeholder="Contrase&ntilde;a"/>
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
                    <button class="button" type="submit">Guardar</button>
                    </fieldset>
				</form>
		</div>
	</div>
</div>
