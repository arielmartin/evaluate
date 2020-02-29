<?php
class periodo{

private $id;
private $nombre;
private $inicio;
private $fin;
private $creador;

public function __construct($nombre,$inicio,$fin,$creador,$id=0)
{
	$this->nombre=$nombre;
	$this->inicio=$inicio;
	$this->fin=$fin;
	$this->creador=$creador;
	$this->id=$id;
}

// metodos que devuelven valores

	function getNombre()
	 { return $this->nombre;}
	function getInicio()
	 { return $this->inicio;}
	function getFin()
	 { return $this->fin;}
	function getIdCreador()
	 { return $this->creador;}
	function getIdPeriodo()
	 { return $this->id;}
	 
// metodos que setean los valores
	function setNombre($val)
	 { $this->nombre=$val;}

}
?>