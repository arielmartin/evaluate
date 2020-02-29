<?php

// requiere la inclusion externa del archibo 'conexion.php'
include_once 'helper_sql.php';

class adoRanking {

//Retorna un string con el nombre del empleado por su ID

function getNameEmpleado($id) {

	$result = executeQuery(" SELECT nombre,apellido
												FROM empleados
												WHERE id_empleado='$id'"); // ejecuta la consulta para traer el nombre
	$row = @mysqli_fetch_array($result);
			
			//var_dump($row); //para ver el contenido del array
	
	$nombreCompleto = $row['nombre'].' '.$row['apellido'];
	
	return $nombreCompleto;
}


//Retorna un array con los nombres de todos los empleados y sus IDs como indices

function getAllEmpleados() {

	$result = executeQuery("SELECT * FROM empleados"); // ejecuta la consulta para traer al cliente 
			//$row=mysql_fetch_row($result);

	//llenamos el array de empleados con los datos recividos
	;
		while($row=mysqli_fetch_array($result)) {

			$array_empleados[$row['id_empleado']]=$row['nombre'].' '.$row['apellido'];
		}	

	unset($array_empleados[0]);
	unset($array_empleados[1]);
		
	//var_dump($array_empleados); //para ver el contenido del array
		
	return $array_empleados;
}


//Retorna un array con los nombres de todos los Perfiles y sus IDs como indices
		
function getAllPerfiles() {

	$result = executeQuery("SELECT * FROM perfil"); // ejecuta la consulta para traer los perfiles
			//$row=mysql_fetch_row($result);

	//llenamos el array de perfiles con los datos recividos
		while($row = mysqli_fetch_array($result)) {

			$array_perfiles[$row['id_perfil']] = $row['nombre_perfil'];
		}
			
		//var_dump($this->array_perfiles); //para ver el contenido del array
	
	return $array_perfiles;
}		


//METODO QUE REGRESA EL NOMBRE DEL PERFIL PASANDO COMO PARAMETRO SU ID

function getNamePerfil($id) {

	$result = executeQuery("	SELECT nombre_perfil 
								FROM perfil 
								WHERE id_perfil = '$id' 
								"); // ejecuta la consulta para encontrar el id

		$row = mysqli_fetch_array($result);

		$nombre_perfil=$row['nombre_perfil'];
			
		return $nombre_perfil;
	}
	

//METODO QUE REGRESA EL NOMBRE DEL PERIODO PASANDO COMO PARAMETRO SU ID

function getNamePeriodo($id) {

	$result = executeQuery("	SELECT nombre_periodo
								FROM periodo
								WHERE id_periodo = '$id' 
								"); // ejecuta la consulta para encontrar el id

	$row = mysqli_fetch_array($result);
			
	$nombre_periodo = $row['nombre_periodo'];
			
	return $nombre_periodo;
}	
	
		
//metodo que regresa el 'objeto' perfil pasando como parametro el ID

	function getPerfilById($id) {
	
		if ($id) {

			$result = executeQuery("SELECT * FROM perfil WHERE id_perfil = $id"); // ejecuta la consulta para traer el objetivo
			$row = mysqli_fetch_array($result);		
			$id = $row['id_perfil'];
			$nombre = $row['nombre_perfil'];
			$descripcion = $row['descripcion_perfil'];
			
		//creamos el objeto objetivo con los datos recividos
			$obj_perfil = new perfil($nombre, $descripcion, $id);
		
		//var_dump($obj_perfil); //para ver el contenido del objeto
		
			return $obj_perfil;
		}
	}


//Regresa el objeto perfil del empleado perteneciente a el periodo

function findPerfil($id_empleado,$id_periodo) {

		$query1="	SELECT p.id_perfil,p.nombre_perfil,p.descripcion_perfil
					FROM perfil as p
					JOIN empleados_periodo as ep
					ON p.id_perfil=ep.id_perfil
					WHERE ep.id_empleado=$id_empleado
					AND ep.id_periodo=$id_periodo";

		$result = executeQuery($query1); // ejecuta la consulta para  borrar el registro del objetivo
			
		$row=mysqli_fetch_array($result);		
		$id=$row['id_perfil'];
		$nombre=$row['nombre_perfil'];
		$descripcion=$row['descripcion_perfil'];
			
	//creamos el objeto objetivo con los datos recividos
		$obj_perfil = new perfil($nombre,$descripcion,$id);
		
		//var_dump($obj_perfil); //para ver el contenido del objeto
		
		return $obj_perfil;		
	}		


	function getPeriodosEmpleado($id_empleado) {

			$query1="	SELECT id_periodo,id_perfil
						FROM empleados_periodo
						WHERE id_empleado = $id_empleado
						";

		$result = executeQuery($query1); // ejecuta la consulta 
			
		while($row=mysqli_fetch_array($result))  {

			$periodos[$row['id_perfil']] = $row['id_periodo'];
		}
		//var_dump($periodos);
		return $periodos;	
	}

	
//metodo que calcula el promedio de un objetivo/competencia

	public function getAVGobjetivo($id_objetivo,$id_empleado,$id_periodo) {

		$query="SELECT ROUND( AVG(nota),1 ) AS avg_nota
				FROM notas as n
				JOIN evaluacion as e
				ON n.id_evaluacion=e.id_evaluacion
				WHERE id_empleado=$id_empleado
				AND id_objetivo=$id_objetivo
				AND id_periodo=$id_periodo
				";
				
		$result = executeQuery($query); // ejecuta la consulta 
			//var_dump($result);
			$row = mysqli_fetch_array($result);
			$avg_nota=$row['avg_nota'];
		
		//var_dump($avg_nota);
		
		return $avg_nota;	
	}	


//metodo que calcula el promedio general de los objetivos u competencias de un empleado
//$tipo = 'o' / 'c'

	public function getAVGempleado($id_empleado, $tipo) {

		$query="SELECT ROUND( AVG(nota),1 ) AS avg_nota
				FROM notas as n
				JOIN evaluacion as e
				ON n.id_evaluacion=e.id_evaluacion
				WHERE id_empleado='$id_empleado'
				AND tipo_evaluacion='$tipo'
				";
				
		$result = executeQuery($query); // ejecuta la consulta 
			//var_dump($result);
			$row = @mysqli_fetch_array($result);
			$avg_nota = $row['avg_nota'];
		
		//var_dump($avg_nota);
		
		return $avg_nota;	
	}		
	
	function getConsulta() {	

		$resultado = mysqli_query("select * from empleados_periodo");

		while ($fila = mysqli_fetch_assoc($resultado)) {

			$datos[] = $fila;  //cada elemento de $datos va a ser una fila del resultado;
		}
		//var_dump($datos);
		return $datos;
	}
	

	function ordenar($empleados) {

		foreach($empleados as $key=>$valor) {

			$notaO = $this->getAVGempleado($key,'o');
			$notaC = $this->getAVGempleado($key,'c');
			
			$coeficiente = ($notaO*60+$notaC*40)/100;
			$ordenado[$key] = $coeficiente;
		}	

		//var_dump($sumas);
		@arsort($ordenado);
		return $ordenado;
	}
	
}


?>