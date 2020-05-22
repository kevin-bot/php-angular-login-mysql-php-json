<?php 
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// RECIBE EL JSON DEL FORMULARIO DE LOGIN ANGULAS
$json_angular = file_get_contents('php://input');

// RECIBE EL JSON DE ANGULAR Y LO TRANFORMA EN UN ARRAY DE PHP
$parametro_angular = json_decode($json_angular);

require("conexion.php"); // IMPORTA EL ARCHIVO CON LA CONEXION A LA DB

$conexion = conexion(); // CREA LA CONEXION

//PREPARA LA SENTENCIA PHP Y EJECUTA 
$sentencia = $conexion->prepare("SELECT * FROM login WHERE user = :user AND contrasena = :pass ");
$sentencia->execute(array(':user' => $parametro_angular->user, ':pass'=>$parametro_angular->pass));

// ARRAY JSON QUE SE ENVIA COMO RESULTADO A ANGULAR
//$json_to_sent=array();
class Result {}
    
// GENERA LOS DATOS DE RESPUESTA
$response = new Result();

if($result = $sentencia->fetchAll(PDO::FETCH_ASSOC)){
	//$json_to_sent = $result;
	$response->resultado = 'OK';
	$response->mensaje = 'LOGIN EXITOSO';

} else {
	//$json_to_sent ['fds']= "no";
	$response->resultado = 'FAIL';
	$response->mensaje = 'LOGIN FALLIDO';
}
		
header('Content-Type: application/json');
  
echo json_encode($response,JSON_UNESCAPED_UNICODE); // MUESTRA EL JSON GENERADO

?> 