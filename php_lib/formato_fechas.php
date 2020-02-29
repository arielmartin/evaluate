<?php

//convierte una fecha del formato de la BD(YYYY-mm-dd) al formato de js (m/d/Y)
function sqlajs($fechaSql)
{
	$js=date("m/d/Y",strtotime($fechaSql));

return $js;
}

//convierte una fecha del formato javascript (m/d/Y) al formato SQL de la BD(YYYY-mm-dd)
function jsasql($fechaJs)
{
	$sql=date("Y-m-d",strtotime($fechaJs));

return $sql;
}

//convierte una fecha del formato standar (d/m/Y) al formato SQL de la BD(YYYY-mm-dd)
//funciona en PHP 5.3 o superiores
/*
function stdasql($fechaStd)
{
	$date = DateTime::createFromFormat('d/m/Y', $fechaStd);
	$sql=$date->format('Y-m-d');

return $sql;
}*/

//convierte una fecha del formato SQL de la BD(YYYY-mm-dd) al formato standar (d/m/Y)
function sqlastd($fechaSql)
{
	$std=date("d/m/Y",strtotime($fechaSql));

return $std;
}

//convierte una fecha del formato standar (d/m/Y) al formato SQL de la BD(YYYY-mm-dd)
//Funcion para PHP 5.2
function stdasql($date)
{
	$dateInput = explode('/',$date);
	$ukDate = $dateInput[2].'-'.$dateInput[1].'-'.$dateInput[0];
	return $ukDate;
}

function ordenar($arraySql){

	foreach($arraySql as $fechaSql)
	{
		$fechaJs=sqlajs($fechaSql);
		$arrayJs[]=$fechaJs;
	}
		sort($arrayJs);
		
		foreach($arrayJs as $fechaJs)
	{
		$fechaSql=jsasql($fechaJs);
		$arraySqlOrdenado[]=$fechaSql;	
	}	
	return $arraySqlOrdenado;
}

?>