<?php

include_once 'helper_sql.php';

class adoObjetivo {

//se declaran los atributos de la clase, que son los atributos de la clase empleado
private $nombre;
private $descripcion;
private $tipo;
private $id_perfil;

private $obj_objetivo;

//metodo que obtiene el id del empleado pasando como argumento el numero de dni
	
	function getIdByDni($dni) {

		$result = executeQuery("select id_empleado from empleados where dni = $dni"); // ejecuta la consulta para encontrar el id
		$row = mysqli_fetch_array($result);
		$id = $row['id_empleado'];
			
		return $id;
	}
	
//metodo que trae un objeto OBJETIVO mediante el nombre
	function getObjetivo($nombre) {

		if ($nombre) {

			$obj_cliente=new sQuery();
			$result = executeQuery("SELECT * FROM objetivos WHERE nombre_objetivo = $nombre"); // ejecuta la consulta para traer el objetivo
			$row=mysqli_fetch_array($result);		
			$this->id=$row['id_objetivo'];
			$this->nombre=$row['nombre_objetivo'];
			$this->descripcion=$row['descripcion_objetivo'];
			$this->tipo=$row['tipo_objetivo'];
			$this->id_perfil=$row['id_perfil'];
			
	//creamos el objeto objetivo con los datos recividos
			$this->obj_objetivo = new objetivo($this->id, $this->nombre, $this->descripcion, $this->tipo, $this->id_perfil);
			return $this->obj_objetivo;
		}
	}
	

//metodo que trae un objeto OBJETIVO mediante el Id
	function getObjetivoById($id) {

		if ($id) {

			$result = executeQuery("SELECT * FROM objetivos WHERE id_objetivo = $id"); // ejecuta la consulta para traer el objetivo
			$row=mysqli_fetch_array($result);		
			$this->id=$row['id_objetivo'];
			$this->nombre=$row['nombre_objetivo'];
			$this->descripcion=$row['descripcion_objetivo'];
			$this->tipo=$row['tipo_objetivo'];
			$this->id_perfil=$row['id_perfil'];
			
	//creamos el objeto objetivo con los datos recividos
		$this->obj_objetivo = new objetivo($this->nombre,$this->descripcion,$this->tipo,$this->id_perfil,$this->id);
		return $this->obj_objetivo;
		}
	}


//metodo que almacena los datos del objetivo en la BD
	public function guardarObjetivo($obj_objetivo) {

	$this->nombre=$obj_objetivo->getNombre();
	$this->descripcion=$obj_objetivo->getDescripcion();
	$this->tipo=$obj_objetivo->getTipo();
	$this->id_perfil=$obj_objetivo->getId_perfil();
	
		$query="INSERT INTO objetivos(nombre_objetivo,descripcion_objetivo,tipo_objetivo,id_perfil)
				VALUES('$this->nombre','$this->descripcion','$this->tipo','$this->id_perfil')";
				
		executeQuery($query); // ejecuta la consulta para insertar objetivo	
	}
	

//metodo que modifica los datos del objetivo en la BD
	public function updateObjetivo($obj_objetivo) {

	}
	
//Borra un objetivo en particular
	public	function eliminarObjetivo($id)	{

		$query1="DELETE FROM objetivo WHERE id_objetivo=$id";

		executeQuery($query1); // ejecuta la consulta para  borrar el registro del objetivo
	}	
	

//Regresa un array con los nombres de los objetivos y los id como indices de un empleado
	function getObjetivos($id_empleado,$id_periodo)	{
		
		$query ="	SELECT DISTINCT id_objetivo,nombre_objetivo
						FROM objetivos as o 
						JOIN empleados_periodo as ep
						WHERE o.id_perfil=ep.id_perfil
						AND ep.id_empleado=$id_empleado
						AND ep.id_periodo=$id_periodo
						AND o.tipo_objetivo='o'
						";

		$result = executeQuery($query); // ejecuta la consulta 
			
		//llenamos el array de objetivos con los datos recividos
		while($row = mysqli_fetch_array($result)) {

			$array_objetivos[$row['id_objetivo']] = $row['nombre_objetivo'];
		}
			
		//var_dump($result);
		//var_dump($array_objetivos); //para ver el contenido del array
	
		return @$array_objetivos;	
	}	
	

//Retorna un array con las fechas de evaluacion de un ojetivo

	function getFechasEvaluacion($id_objetivo,$id_empleado,$id_periodo) {

			$result = executeQuery(" SELECT ev.id_evaluacion,o.nombre_objetivo,ev.fecha_evaluacion
												FROM objetivos as o 
												JOIN empleados_periodo as ep ON o.id_perfil=ep.id_perfil
												JOIN evaluacion as ev ON ev.id_periodo=ep.id_periodo
												WHERE ep.id_periodo=$id_periodo
												AND ep.id_empleado=$id_empleado
												AND o.id_objetivo=$id_objetivo	
												AND tipo_evaluacion='o'
												ORDER BY ev.fecha_evaluacion;
												"); 

	//llenamos el array de empleados con los datos recividos
		while($row = mysqli_fetch_array($result)) {

			$array_fechas[$row['id_evaluacion']] = $row['fecha_evaluacion'];
		}
			
		//var_dump($array_fechas); //para ver el contenido del array
	
		return $array_fechas;
	}

/////----------------------------METODOS PARA COMPETENCIAS------------------------------//////		


//Regresa un array con los nombres de las COMPETENCIAS y los id como indices de un PERFIL
//si no se ingresa ningun id de perfil regresará un listado completo de todas las competencias
	
function getCompetencias($id_perfil=null) {
	
	if($id_perfil) {

			$query1="	SELECT DISTINCT o.id_objetivo,o.nombre_objetivo
						FROM objetivos as o 
						JOIN competencias_perfil as cp
						ON o.id_objetivo=cp.id_competencia
						WHERE cp.id_perfil=$id_perfil
					";

		$result = executeQuery($query1); // ejecuta la consulta para  borrar el registro del objetivo
					
		//var_dump($result);
		
	//llenamos el array de objetivos con los datos recividos
		while($row=mysqli_fetch_array($result)) {

			$array_competencias[$row['id_objetivo']] = $row['nombre_objetivo'];
		}
			
		//var_dump($array_objetivos); //para ver el contenido del array
		return @$array_competencias;	
	}
	
	else {
			$query1="	SELECT id_objetivo,nombre_objetivo
						FROM objetivos as o 
						WHERE o.tipo_objetivo='c'
					";

		$result = executeQuery($query1); // ejecuta la consulta para  borrar el registro del objetivo
			
		//var_dump($result);
			
	//llenamos el array de objetivos con los datos recividos
		while($row=mysqli_fetch_array($result)) {

			$array_competencias[$row['id_objetivo']] = $row['nombre_objetivo'];
		}
			
		//var_dump($result);
		//var_dump($this->array_objetivos); //para ver el contenido del array
	
		return @$array_competencias;	
	}
		
}
		
		
	
/////----------------------------METODOS PARA NOTAS------------------------------//////		
		
//metodo que dado el id_evaluacion de una nota retorna su periodo

public function getPeriodoNota($id_nota, $id_evaluacion)
{
		$obj_sQuery=new sQuery();
		$query="SELECT e.id_periodo
				FROM notas as n
				JOIN evaluacion as e
				ON n.id_evaluacion = e.id_evaluacion
				WHERE n.id_nota=$id_nota
				AND n.id_evaluacion=$id_evaluacion
				";
				
		$result=$obj_sQuery->executeQuery($query); // ejecuta la consulta 
		
		$row=mysql_fetch_array($result);
		$id_periodo=$row['id_periodo'];
		
		return $id_periodo;	
}

//metodo que almacena los datos en la tabla nota

	public function guardarNota($id_objetivo,$id_empleado,$id_evaluacion,$nota,$id_votante) {
	
		$query="INSERT INTO notas(id_objetivo,id_empleado,id_evaluacion,nota,id_votante)
				VALUES('$id_objetivo','$id_empleado','$id_evaluacion','$nota','$id_votante')";
				
		executeQuery($query); // ejecuta la consulta para insertar objetivo
		
		$query2 = "SELECT MAX(id_nota) as max FROM notas ";
		
		$result = executeQuery($query2); // ejecuta la consulta para  obtener el id del registro nuevo
		$row = mysqli_fetch_array($result);

		return $row['max'];
	}

//metodo que recupera una nota ya guardada

	public function getNota($id_objetivo,$id_empleado,$id_evaluacion) {

		$query="SELECT  nota
				FROM notas
				WHERE id_objetivo='$id_objetivo'
				AND id_empleado='$id_empleado'
				AND id_evaluacion='$id_evaluacion'";
				
		$result = executeQuery($query); // ejecuta la consulta para insertar objetivo
			
		$row = mysqli_fetch_array($result);
		$nota = $row['nota'];
		
		//var_dump($nota);
		
		return $nota;	
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
		if($avg_nota==null) {

			$avg_nota='----';
		}

		return $avg_nota;	
	}	
	
//metodo que dado un array de fechas regresa el id de la fecha correspondiente al periodo actual
// en caso de no haber ninguna fecha que coinsida regresa "0"
	
	public function evaluacionActual($arrayDeFechas) {

		$hoy=date("Y-m-d");
		$id=0;

		foreach($arrayDeFechas as $key=>$fecha) {
		
			if($fecha<=$hoy){

				$id=$key;
			}		
		}

		$query="	SELECT fin_periodo
					FROM evaluacion as e
					JOIN periodo as p
					ON e.id_periodo = p.id_periodo
					WHERE e.id_evaluacion=$key
				";
				
		$result = executeQuery($query); // ejecuta la consulta 
			
		$row = @mysqli_fetch_array($result);
		$fecha_fin = $row['fin_periodo'];
			
		if($fecha_fin<$hoy) {

			$id=0;
		}
		
		return $id;
	}
		
//metodo que regresa la un date con la fecha_hora de la ultima evaluacion corespondiente a estos datos
	
	public function getUltimaEvaluacion($id_objetivo,$id_empleado,$id_periodo,$id_votante) {
	
		$query="SELECT max(fecha_hora) AS max
				FROM notas as n
				JOIN evaluacion as e
				ON n.id_evaluacion=e.id_evaluacion
				WHERE id_empleado=$id_empleado
				AND id_objetivo=$id_objetivo
				AND id_periodo=$id_periodo
				AND id_votante=$id_votante
				";
				
		$result = executeQuery($query); // ejecuta la consulta 

		$row = mysqli_fetch_array($result);
		$max = $row['max'];
		
		return $max;
	}			
		
	
}


?>