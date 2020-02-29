<?php

// requiere la inclusion externa del archibo 'conexion.php'
include_once 'helper_sql.php';

class adoEmpleado {

//se declaran los atributos de la clase, que son los atributos de la clase empleado
private $id;
private $nombre;
private $apellido;
private $dni;
private $email;
private $puesto;
//se declaron los atributos de la clase usuario
private $usuario;
private $pass;
private $rol;

private $obj_empleado;

private $array_empleados=array();


//metodo que obtiene el id del empleado pasando como argumento el numero de dni
	
	function getIdByDni($dni=0) {

		if ($dni!=0) {

			$result = executeQuery("SELECT id_empleado FROM empleados WHERE dni = $dni"); // ejecuta la consulta para traer al empleado 
			$row = mysqli_fetch_array($result);
			$this->id=$row['id_empleado'];
			
			return $this->id;
		}
		else { 
			return 0;
		}
	}
	

//metodo que trae los datos del empleado y regresa un objeto empleado por el DNI(sin los datos de usuario)

	function getEmpleado($dni=0) {
	// declara el constructor, si trae el numero de cliente lo busca , si no, no hace nada.
	
		if ($dni!=0) {

			$result = executeQuery("SELECT * FROM empleados WHERE dni = $dni"); // ejecuta la consulta para traer al cliente 
			$row = mysqli_fetch_array($result);		
			$this->id=$row['id_empleado'];
			$this->nombre=$row['nombre'];
			$this->apellido=$row['apellido'];
			$this->dni=$row['dni'];
			$this->email=$row['email'];
			$this->puesto=$row['puesto'];
			
	//creamos el objeto empleado con los datos recividos
			$this->obj_empleado = new empleado($this->nombre, $this->apellido, $this->dni, $this->email, $this->puesto);

			return $this->obj_empleado;
		}
	}
	

//metodo que trae los datos del empleado y regresa un objeto empleado por el ID(sin los datos de usuario)

	function getEmpleadoById($id=0) {
	// declara el constructor, si trae el numero de cliente lo busca , si no, no hace nada.
	
		if ($id!=0) {
		
			$result = executeQuery("SELECT * FROM empleados WHERE id_empleado = $id"); // ejecuta la consulta para traer al cliente 
			$row = mysqli_fetch_array($result);	

			$this->id=$row['id_empleado'];
			$this->nombre=$row['nombre'];
			$this->apellido=$row['apellido'];
			$this->dni=$row['dni'];
			$this->email=$row['email'];
			$this->puesto=$row['puesto'];
			
	//creamos el objeto empleado con los datos recividos
			$this->obj_empleado = new empleado($this->nombre,$this->apellido,$this->dni,$this->email,$this->puesto);
			return $this->obj_empleado;
		}
	}


//metodo que almacena los datos del empleado en la BD

	public function guardarEmpleado($obj_empleado) {
	
		$this->nombre=$obj_empleado->getNombre();
		$this->apellido=$obj_empleado->getApellido();
		$this->dni=$obj_empleado->getDni();
		$this->email=$obj_empleado->getEmail();
		$this->puesto=$obj_empleado->getPuesto();
		$this->usuario=$obj_empleado->getUsuario();
		$this->pass=$obj_empleado->getPass();
		$this->rol=$obj_empleado->getRol();
	
		//$obj_sQuery=new sQuery();
		$query = "INSERT INTO empleados(nombre,apellido,dni,email,puesto)
				  VALUES('$this->nombre','$this->apellido','$this->dni','$this->email','$this->puesto')";
				
		//$obj_sQuery->executeQuery($query); // ejecuta la consulta para insertar empleado
		executeQuery($query); // ejecuta la consulta para insertar empleado
		
	//obtenemos en numero de id que se genero para el empleado
		$this->id = $this->getIdByDni($this->dni);
		
		$query2 = "	INSERT INTO usuarios(usuario,pass,rol,id_empleado)
					VALUES('$this->usuario','$this->pass','$this->rol',$this->id)"; 

		executeQuery($query2); // ejecuta la consulta para insertar usuario
	}
	

//metodo que modifica los datos del empleado en la BD

	public function updateEmpleado($obj_empleado) {
	
		$this->nombre=$obj_empleado->getNombre();
		$this->apellido=$obj_empleado->getApellido();
		$this->dni=$obj_empleado->getDni();
		$this->email=$obj_empleado->getEmail();
		$this->puesto=$obj_empleado->getPuesto();
		$this->usuario=$obj_empleado->getUsuario();
		$this->pass=$obj_empleado->getPass();
		$this->rol=$obj_empleado->getRol();
	
		$query ="	UPDATE empleados 
					SET nombre='$this->nombre', apellido='$this->apellido', email='$this->email', puesto='$this->puesto'
					WHERE dni=$this->dni 
					";
		
		executeQuery($query); // ejecuta la consulta para modificar empleado
		
	//obtenemos en numero de id del empleado
		$this->id = $this->getIdByDni($this->dni);
		
		$query2="	UPDATE usuarios 
					SET pass='$this->pass', rol='$this->rol'
				 	WHERE id_empleado=$this->id 
				 	"; 
			
		executeQuery($query2); // ejecuta la consulta para insertar usuario
	}
	

//Borra los registros de las tablas Empleados y Usuarios usando el id del 

	function eliminarEmpleado($id)	{
	
			//$obj_cliente=new sQuery();
			$query1="DELETE FROM empleados WHERE id_empleado=$id";
			$query2="DELETE FROM usuarios WHERE id_empleado=$id";
			executeQuery($query1); // ejecuta la consulta para  borrar el registro del empleado
			executeQuery($query2); // ejecuta la consulta para  borrar el registro del usuario
	}


//Retorna un array con los nombres de todos los empleados y sus IDs como indices

	function getAllEmpleados() {

		$result = executeQuery("SELECT * FROM empleados"); // ejecuta la consulta para traer al cliente 
			//$row=mysql_fetch_row($result);

	//llenamos el array de empleados con los datos recividos
		while($row = mysqli_fetch_array($result)) {

			$array_empleados[$row['id_empleado']] = $row['nombre'].' '.$row['apellido'];
		}
			
		//var_dump($array_empleados); //para ver el contenido del array
		
		unset ( $array_empleados[1]);
		
		return $array_empleados;
	}
		

//Retorna un string con el nombre del empleado por su ID

function getNameEmpleado($id) {
	
		if($id) {

			$result = executeQuery("	SELECT nombre,apellido
										FROM empleados
										WHERE id_empleado='$id'
										"); // ejecuta la consulta para traer el nombre

			$row = @mysqli_fetch_array($result);
			
			//var_dump($row); //para ver el contenido del array
	
			$nombreCompleto = $row['nombre'].' '.$row['apellido'];
	
			return $nombreCompleto;
		}
	}

}

?>