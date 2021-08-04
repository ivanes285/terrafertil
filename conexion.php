<?php 

$host= 'localhost';
$user= 'root';
$password ='';
$db='terra';
$conection=@mysqli_connect($host,$user,$password,$db);
if(!$conection){
    echo "Error de Conexion";
}

?>