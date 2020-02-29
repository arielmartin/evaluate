<?php
class empleado{

private $nombre;
private $apellido;
private $dni;
private $email;
private $puesto;
private $usuario;
private $pass;
private $rol;

public function __construct($nombre,$apellido,$dni,$email,$puesto,$usuario="",$pass="",$rol="")
{
	$this->nombre=$nombre;
	$this->apellido=$apellido;
	$this->dni=$dni;
	$this->email=$email;
	$this->puesto=$puesto;
	$this->usuario=$usuario;
	$this->pass=$pass;
	$this->rol=$rol;
}

// metodos que devuelven valores

	function getNombre()
	 { return $this->nombre;}
	function getApellido()
	 { return $this->apellido;}
	function getDni()
	 { return $this->dni;}
	function getEmail()
	 { return $this->email;}
	function getPuesto()
	 { return $this->puesto;}
	function getUsuario()
	 { return $this->usuario;}
	function getPass()
	 { return $this->pass;}
	function getRol()
	 { return $this->rol;}
	 
// metodos que setean los valores
	function setNombre($val)
	 { $this->nombre=$val;}
	function setApellido($val)
	 {  $this->apellido=$val;}
	function setDni($val)
	 {  $this->dni=$val;}
	function setEmail($val)
	 {  $this->email=$val;}
	function setPuesto($val)
	 {  $this->puesto=$val;}

}
?>