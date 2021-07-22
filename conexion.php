<?php 

$host= 'localhost';
$user= 'root';
$password ='';
$db='prueba';
$conection=@mysqli_connect($host,$user,$password,$db);
if(!$conection){
    echo "Error de Conexion";
}

?>