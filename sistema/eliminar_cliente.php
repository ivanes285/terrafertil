
<?php
  session_start();

  if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}
  include "../conexion.php";
  
if(!empty($_POST)){
  
  $idcliente=$_POST['idcliente'];

  $query_delete = mysqli_query($conection, "UPDATE cliente SET estatus = 0 WHERE idcliente = $idcliente");
  mysqli_close($conection);
  if($query_delete){
    header("location: lista_cliente.php");
  }else{
    echo "Error al eliminar Cliente";
  }
}




if (empty($_REQUEST['id'])) {
    header('Location: lista_cliente.php');   
    mysqli_close($conection);
    }else{
       
        $idcliente=$_REQUEST['id'];
        $sql = mysqli_query($conection, "SELECT * FROM cliente WHERE idcliente= $idcliente");
        	mysqli_close($conection);
        $result= mysqli_num_rows($sql);

 if($result>0){

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
 }else{
    header('Location: lista_cliente.php');
 }
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Eliminar Clientes</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
       <div class="data_delete">
<h2 style="color: #C82333">¿Está seguro de eliminar el cliente?</h2>
<p>Cedula: <span><?php  echo $cedula;?></span></p>
<p>Nombre: <span><?php  echo $nombre;?></span></p>
<p>Apellido: <span><?php  echo $apellido;?></span></p>
<p>Correo: <span><?php  echo $correo;?></span></p>
<p>Telefono: <span><?php  echo $telefono;?></span></p>
<p>Direccion: <span><?php  echo $direccion;?></span></p>
<p>FechaCumpleaños: <span><?php  echo $fechacumple;?></span></p>

<form method="POST" action="">
<input type="hidden" name="idcliente" value="<?php echo $idcliente;?>"> 
<a href="lista_usuario.php" class="btn_cancel">Cancelar</a>
<input type="submit" value="Aceptar" class="btn_ok" >

</form>

  </div>


	</section>
	<?php include "includes/footer.php";?>
</body>
</html>