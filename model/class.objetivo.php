<?php
class objetivo{

private $id;
private $nombre;
private $descripcion;
private $tipo;

public function __construct($nombre,$descripcion,$tipo,$id_perfil,$id=0)
{
	$this->nombre=$nombre;
	$this->descripcion=$descripcion;
	$this->tipo=$tipo;
	$this->id_perfil=$id_perfil;
	$this->id=$id;
}

// metodos que devuelven valores

	function getNombre()
	 { return $this->nombre;}
	function getDescripcion()
	 { return $this->descripcion;}
	function getTipo()
	 { return $this->tipo;}
	function getId()
	 { return $this->id;}
	function getId_perfil()
	 { return $this->id_perfil;}

	 
// metodos que setean los valores
	function setNombre($val)
	 { $this->nombre=$val;}
	function setDescripcion($val)
	 {  $this->descripcion=$val;}

}
?>