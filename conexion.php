<?php 

$host= 'localhost';
$user= 'root';
$password ='';
$db='terrafertil';
$conection=@mysqli_connect($host,$user,$password,$db);
if(!$conection){
    echo "Error de Conexion";
}

?>