
<?php
  session_start();

  if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}
  include "../conexion.php";
  
if(!empty($_POST)){
  
  if($_POST['idusuario'] == 1){
    header("location: lista_usuario.php");
    mysqli_close($conection);
    exit;
  }
  $idusuario=$_POST['idusuario'];

  $query_delete = mysqli_query($conection, "UPDATE usuario SET estatus = 0 WHERE idusuario = $idusuario");
  mysqli_close($conection);
  if($query_delete){
    header("location: lista_usuario.php");
  }else{
    echo "Error al eliminar";
  }
}


if (empty($_REQUEST['id'])|| $_REQUEST['id'] == 1 ) {
    header('Location: lista_usuario.php');   
    mysqli_close($conection);
    }else{
       
        $idusuario=$_REQUEST['id'];
        $sql = mysqli_query($conection, "SELECT u.cedula,u.usuario,u.apellido,u.edad,u.correo,
        r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE idusuario= $idusuario");
        	mysqli_close($conection);
        $result= mysqli_num_rows($sql);

 if($result>0){

while($data=mysqli_fetch_array($sql)){
$cedula=$data['cedula'];
$usuario=$data['usuario'];
$apellido=$data['apellido'];
$edad=$data['edad'];
$correo=$data['correo'];
$rol=$data['rol'];
}
 }else{
    header('Location: lista_usuario.php');
 }
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Eliminar Usuarios</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
       <div class="data_delete">
<h2 style="color: #C82333">¿Está seguro de eliminar este registro?</h2>
<p>Cedula: <span><?php  echo $cedula;?></span></p>
<p>Nombre: <span><?php  echo $usuario;?></span></p>
<p>Apellido: <span><?php  echo $apellido;?></span></p>
<p>Edad : <span><?php  echo $edad;?></span></p>
<p>Correo: <span><?php  echo $correo;?></span></p>
<p>Rol: <span><?php  echo $rol;?></span></p>

<form method="POST" action="">
<input type="hidden" name="idusuario" value="<?php echo $idusuario;?>"> 
<a href="lista_usuario.php" class="btn_cancel">Cancelar</a>
<input type="submit" value="Aceptar" class="btn_ok" >

</form>

  </div>


	</section>
	<?php include "includes/footer.php";?>
</body>
</html>