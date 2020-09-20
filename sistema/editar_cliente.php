
<?php
session_start();
if($_SESSION['rol'] != 1)
{
  header("location: ./");
}
include "../conexion.php";

if (!empty($_POST)) {
		$alert = '';
          $idcliente=$_POST['id'];
          $cedula=$_POST['cedula'];
          $nombre=$_POST['nombre'];
          $apellido=$_POST['apellido'];
          $telefono=$_POST['telefono'];
          $direccion=$_POST['direccion'];
          $correo=$_POST['correo'];
          $fechacumple=$_POST['fechacumple'];
          $query = mysqli_query($conection, "SELECT * FROM cliente WHERE (cedula='$cedula' AND idcliente!= $idcliente)");
          $result= mysqli_fetch_array($query);
          
          if ($result > 0) {
            $alert = '<p class="msg_error">Cedula o usuario YA existe !Intente de Nuevo</p>';  
          } else {
            
              $query_update= mysqli_query($conection, "UPDATE cliente SET cedula='$cedula', 
              nombre='$nombre', apellido='$apellido', telefono='$telefono', direccion='$direccion',
              correo='$correo',fechacumple='$fechacumple'  WHERE idcliente=$idcliente");
              
            if($query_update){
              $alert = '<p class="msg_save">Cliente Actualizado CORRECTAMENTE</p>';
            }else{
              $alert = '<p class="msg_error">ERROR al Actualizar Cliente</p>';
            }

            }     
    } 


    if (empty($_REQUEST['id'])) {
      header('Location: lista_cliente.php');
      mysqli_close($conection);
          }
          $idcliente=$_REQUEST['id'];
          $sql = mysqli_query($conection, "SELECT * FROM cliente  WHERE idcliente= $idcliente AND estatus=1");
         	mysqli_close($conection);
         $result_sql= mysqli_num_rows($sql);
      if($result_sql==0){
  header('Location: lista_cliente.php');
}else{
 $option='';
  while($data=mysqli_fetch_array($sql)){
    $idcliente=$data['idcliente'];
    $cedula=$data['cedula'];
    $nombre=$data['nombre'];
    $apellido=$data['apellido'];
    $telefono=$data['telefono'];
    $direccion=$data['direccion'];
    $correo=$data['correo'];
    $fechacumple=$data['fechacumple'];

  }
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Actualizar Usuario</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">

<div class="form_register">
<h1 style="text-align: center">Actualizar Cliente</h1><hr>
<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>  

<form action="" method="POST">

<input type="hidden" name="id" value="<?php echo $idcliente;?>"> 
<label for="cedula">Cedula</label>
<input type="text" name="cedula" id="cedula" value="<?php echo $cedula;?>"> 

<label for="nombre">Nombre</label>
<input type="text" name="nombre" id="nombre"  value="<?php echo $nombre;?>"> 

<label for="apellido">Apellido</label>
<input type="text" name="apellido" id="apellido" value="<?php echo $apellido;?>"> 

<label for="telefono">Telefono</label>
<input type="text" name="telefono" id="telefono" value="<?php echo $telefono;?>" > 

<label for="direccion">Direccion</label>
<input type="text" name="direccion" id="direccion" value="<?php echo $direccion;?>" > 

<label for="correo">Correo</label>
<input type="email" name="correo" id="correo" value="<?php echo $correo;?>">

<label for="fechacumple">Fecha de Nacimieto</label>
<input type="date" id="fechacumple" name="fechacumple" min="1960-01-01" max="2005-12-31" value="<?php echo $fechacumple;?>">


<input type="submit" value="Actualizar Cliente" class="btn_save"> 

</form>
</div>

	</section>
	<?php include "includes/footer.php";?>
</body>
</html>