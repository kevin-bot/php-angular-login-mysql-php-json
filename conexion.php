<?php

function conexion() {
  
  try {		
	/*	$nom_bd="tuinvest_bienestaruniversitario";
		$nom_usuario="tuinvest_usuario";
		$contraseña_usu="carlos*usuario*kevin";
		$direccion_host="localhost";
		$conexion=new PDO("mysql:host=$direccion_host;dbname=$nom_bd", "$nom_usuario", "$contraseña_usu"); */

		$conexion=new PDO("mysql:host=localhost;dbname=angular", "root", "");
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion->exec("SET CHARACTER SET utf8");

	} catch (Exception $e) {            
            echo 'Error: '.$e->getMessage();
    }
    
  return $conexion;
}

?>