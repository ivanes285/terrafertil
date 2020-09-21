<?php 

$host= 'localhost';
$user= 'root';
$password ='alexander';
$db='pasteles';
$conection=@mysqli_connect($host,$user,$password,$db);
if(!$conection){
    echo "Error de Conexion";
}

?>