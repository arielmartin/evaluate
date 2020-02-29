<?php
class perfil{

private $id;
private $nombre;
private $descripcion;

public function __construct($nombre,$descripcion,$id=0)
{
	$this->nombre=$nombre;
	$this->descripcion=$descripcion;
	$this->id=$id;
}

// metodos que devuelven valores

	function getNombre()
	 { return $this->nombre;}
	function getDescripcion()
	 { return $this->descripcion;}
	function getId()
	 { return $this->id;}

	 
// metodos que setean los valores
	function setNombre($val)
	 { $this->nombre=$val;}
	function setDescripcion($val)
	 {  $this->descripcion=$val;}

}
?>