<?php

// requiere la inclusion externa del archibo 'conexion.php'
include_once 'helper_sql.php';

class adoPeriodo {

//se declaran los atributos de la clase, que son los atributos de la clase empleado
private $id;
private $nombre;
private $inicio;
private $fin;
private $creador;

private $obj_periodo;
private $array_periodos=array();


//metodo que obtiene el id del periodo pasando como argumento el nombre
//si no se pasa argumento devolvera el proximo id que se generara al insertar un periodo
	
	function getIdPeriodo($nombre=null) {

		if($nombre==null) {
			
		$result = executeQuery("SELECT MAX(id_periodo) AS id_periodo FROM periodo"); // ejecuta la consulta para encontrar el id
		$row = mysqli_fetch_array($result);

		$this->id=$row['id_periodo'];
			return $this->id+1;;
		}
		else {

			$result = executeQuery("SELECT id_periodo FROM periodo WHERE nombre_periodo = '$nombre' "); // ejecuta la consulta para encontrar el id
			$row=mysqli_fetch_array($result);
			$this->id=$row['id_periodo'];
			return $this->id;
		}
	}

	
//metodo que regresa el objeto periodo pasando como parametro el id

	function getPeriodo($id_periodo) {
	
		if ($id_periodo) {
			
			$result = executeQuery("SELECT * FROM periodo WHERE id_periodo = $id_periodo"); // ejecuta la consulta para traer el objetivo
			$row=mysqli_fetch_array($result);

			$this->id=$row['id_periodo'];
			$this->nombre=$row['nombre_periodo'];
			$this->inicio=$row['inicio_periodo'];
			$this->fin=$row['fin_periodo'];
			$this->creador=$row['id_creador'];
			
		//creamos el objeto objetivo con los datos recividos
			$obj_periodo = new periodo($this->nombre,$this->inicio,$this->fin,$this->creador,$this->id);
		
		//var_dump($obj_periodo); //para ver el contenido del objeto
		
			return $obj_periodo;
		}
	}


//metodo que regresa si un periodo ya existe

	function checkPeriodo($nombre_periodo) {

			$result = executeQuery("	SELECT nombre_periodo
										FROM periodo 
										WHERE nombre_periodo = '$nombre_periodo'
										"); // ejecuta la consulta
											
			@$row = mysqli_fetch_array($result);		
			$nombre = $row['nombre_periodo'];
			
			if($nombre){
				return true;
			}
			else {
				return false;
			}		
	}	
	
	
//metodo que almacena los datos del perfil en la BD

	public function guardarPeriodo($obj_periodo) {

		$nombre=$obj_periodo->getNombre();
		$inicio=$obj_periodo->getInicio();
		$fin=$obj_periodo->getFin();
		$creador=$obj_periodo->getIdCreador();
	
	//var_dump($obj_periodo); //para ver el contenido del objeto
	
		$query="INSERT INTO periodo(nombre_periodo,inicio_periodo,fin_periodo,id_creador)
				VALUES('$nombre','$inicio','$fin','$creador')";
				
		executeQuery($query); // ejecuta la consulta para insertar objetivo
		
		$query2="	SELECT MAX(id_periodo) as max FROM periodo ";

		$result = executeQuery($query2); // ejecuta la consulta para  obtener el id del registro nuevo
		$row = mysqli_fetch_array($result);

		return $row['max'];
	}

	
//Borra los registros del periodo

	function eliminarPeriodo($id_periodo)	{
			
			$query1 ="	DELETE FROM evaluacion WHERE id_periodo=$id_periodo";
			executeQuery($query1); // borra las evaluaciones
			
			$query2 ="	DELETE FROM notas WHERE id_periodo=$id_periodo ";
			executeQuery($query2); //borra las notas si las Hubiera
			
			$query3 ="	DELETE FROM empleados_periodo WHERE id_periodo=$id_periodo ";
			executeQuery($query3); //borra las relaciones	
			
			$query4="	DELETE FROM periodo WHERE id_periodo=$id_periodo";
			executeQuery($query4); // ejecuta la consulta para  borrar el periodo
	}	


//Retorna un array con los nombres de todos los Periodos y sus IDs como indices

	function getAllPeriodos() {

		$result = executeQuery("SELECT * FROM periodo"); // ejecuta la consulta para traer una lista

	//llenamos el array  con los datos recividos
	
		while($row = mysqli_fetch_array($result)) {

			$array_periodos[$row['id_periodo']] = $row['nombre_periodo'];
		}
			
		//var_dump($array_perfiles); //para ver el contenido del array
	
		return $array_periodos;
	}
	
//Retorna un array con los periodos creados por un evaluador especifico (NO FINALIZADOS)

	function getMyPeriodos($id_creador) {
	
		$result = executeQuery("	SELECT * 
									FROM periodo 
									WHERE id_creador=$id_creador
									AND fin_periodo>=curdate()
									"); // ejecuta la consulta para traer una lista

	//llenamos el array  con los datos recividos
		while($row = mysqli_fetch_array($result)) {

			$array_periodos[$row['id_periodo']] = $row['nombre_periodo'];
		}
			
		//var_dump($array_perfiles); //para ver el contenido del array
	
		return $array_periodos;
	}
	
//Retorna los periodos de un evaluador que ya estan cerrados (FINALIZADOS)

	function getMyPeriodosFinalizados($id_creador) {

		$result = executeQuery("	SELECT * 
									FROM periodo 
									WHERE id_creador=$id_creador
									AND fin_periodo<curdate()
									"); // ejecuta la consulta para traer una lista

	//llenamos el array  con los datos recividos
		while($row = mysqli_fetch_array($result)) {

			$array_periodos[$row['id_periodo']] = $row['nombre_periodo'];
		}
			
		//var_dump($array_perfiles); //para ver el contenido del array
	
		return $array_periodos;
	}
	

//Retorna un array con los nombres de los Periodos que corresponden a un Empleado
//y que no estan finalizados

	function getPeriodos($id_empleado) {
	
		$result = executeQuery("		SELECT p.id_periodo,p.nombre_periodo
										FROM periodo as p
										JOIN empleados_periodo as ep
										ON p.id_periodo=ep.id_periodo
										WHERE ep.id_empleado=$id_empleado
										AND fin_periodo>=curdate()
										"); // ejecuta la consulta para traer una lista

		//llenamos el array  con los datos recividos
		while($row=mysqli_fetch_array($result)) {

			$array_periodos[$row['id_periodo']]=$row['nombre_periodo'];
		}
			
		//var_dump($); //para ver el contenido del array
	
		return $array_periodos;
	}
	
//Retorna un array con los nombres de los Periodos finalizados en los que participo un empleado

	function getPeriodosFinalizados($id_empleado) {

		$result = executeQuery("	SELECT p.id_periodo,p.nombre_periodo
									FROM periodo as p
									JOIN empleados_periodo as ep
									ON p.id_periodo=ep.id_periodo
									WHERE ep.id_empleado=$id_empleado
									AND fin_periodo<curdate()
									"); // ejecuta la consulta para traer una lista

		//llenamos el array  con los datos recividos
		while($row = mysqli_fetch_array($result)) {

			$array_periodos[$row['id_periodo']] = $row['nombre_periodo'];
		}
			
		//var_dump($array_perfiles); //para ver el contenido del array
	
		return $array_periodos;
	}
		

//Guardar fechas de evaluacion del periodo
//retorna el id de la nueva evaluacion guardada

	function guardarFecha($fecha,$id_periodo,$tipo) {
	
		$query1="	INSERT INTO evaluacion (fecha_evaluacion,id_periodo,tipo_evaluacion) 
					VALUES ('$fecha','$id_periodo','$tipo')";
			
		executeQuery($query1); // ejecuta la consulta para  guardar el registro 
			
		$query2 ="	SELECT MAX(id_evaluacion) as max FROM evaluacion ";
		$result = executeQuery($query2); // ejecuta la consulta para  obtener el id del registro nuevo
		$row = mysqli_fetch_array($result);

		return $row['max'];
	}
	
	
//Obtener las fechas de evaluacion de un periodo

	function getFechas($id_periodo) {
			
		$query1="	SELECT * FROM evaluacion
					WHERE id_periodo='$id_periodo'
					AND tipo_evaluacion='o'
					ORDER BY fecha_evaluacion;
					";
			
		$result = executeQuery($query1); // ejecuta la consulta para  guardar el registro 
			//var_dump($result);
	
		//llenamos el array  con los datos recividos
		while($row = mysqli_fetch_array($result)) {

			$array_fechas[$row['id_evaluacion']] = $row['fecha_evaluacion'];
		}
			
		//var_dump($array_fechas); //para ver el contenido del array
	
		return $array_fechas;
	}
	
//Guardar las relaciones entre los IDs de periodo, empleado y perfil

	function guardarRelacion($id_empleado,$id_perfil,$id_periodo) {

		$query1="	INSERT INTO empleados_periodo (id_empleado,id_periodo,id_perfil) 
					VALUES ('$id_empleado','$id_periodo','$id_perfil')";

		executeQuery($query1); // ejecuta la consulta para  guardar el registro 
	}
	

//Retorna un array con los nombres de todos los empleados y sus IDs como indices correspondientes a un periodo

	function getEmpleados($id_periodo) {

		$result = executeQuery(" 	SELECT ep.id_empleado, e.nombre, e.apellido
									FROM empleados_periodo as ep join empleados as e
									WHERE ep.id_empleado=e.id_empleado 
									AND ep.id_periodo=$id_periodo"); 

	//llenamos el array de empleados con los datos recividos
		while($row = mysqli_fetch_array($result)) {

			$array_empleados[$row['id_empleado']] = $row['nombre'].' '.$row['apellido'];
		}
			
		//var_dump($array_empleados); //para ver el contenido del array
	
		return $array_empleados;
	}
		
//Metodo que checkea si el periodo esta siendo utilizado

	public function checkUsoPeriodo($id_periodo) {

		$result = executeQuery("	SELECT id_periodo 
									FROM periodo 
									WHERE id_periodo=$id_periodo
									AND inicio_periodo < now()
									"); 

		$row = mysqli_fetch_array($result);		
		$id_periodo = $row['id_periodo'];
		
		return $id_periodo;
	}
	

//Metodo que retorna el creador de un periodo

	public function getCreadorPeriodo($id_periodo) {

		$result = executeQuery("	SELECT id_creador
									FROM periodo 
									WHERE id_periodo='$id_periodo'
									");

		$row = mysqli_fetch_array($result);	

		$id_creador=$row['id_creador'];
		
		return $id_creador;	
	}	
		
		
}


?>