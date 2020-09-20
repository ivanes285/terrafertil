<?php
session_start();
if($_SESSION['id_rol'] != 1)
	{
		header("location: ./");
	}
  include "../conexion.php";
   include ("validar.php");
if (!empty($_POST)) {
    $alert = '';
          
          $user=$_POST['user'];
          $password=md5($_POST['password']);
          $id_rol=$_POST['rol'];

          $query = mysqli_query($conection, " SELECT * FROM usuario  WHERE  user='$user' ");
          $result= mysqli_fetch_array($query);
        
          if ($result > 0) {
            $alert = '<p class="msg_error">!Ya existe un usuario con este nombre INTENTA POR FAVOR CON OTRO</p>';  
          } else {

            $query_insert= mysqli_query($conection, "INSERT INTO usuario 
            (user,password,rol) VALUES ('$user','$password','$id_rol')");
         
         if($query_insert){
              $alert = '<p class="msg_save">user Creado CORRECTAMENTE</p>';
            }else{
              $alert = '<p class="msg_error">Error al Crear user</p>';
            }
          } 
        }  
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Registro de Usuario</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">

	<div class="form_register">
  <h1 style="text-align: center">Registro de Usuarios</h1><hr>
<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>  

<form action="" method="POST">

<label for="user">Nombre</label>
<input type="text" name="user" id="user" placeholder="Ingrese su nombre" required > 


<label for="password">password</label>
<input type="password" name="password" id="password" placeholder="Ingrese su password " required >

<label for="rol">Rol</label>
<?php
 
 $query_id_rol= mysqli_query($conection,"SELECT * FROM rol ");
 mysqli_close($conection);
 $result_id_rol= mysqli_num_rows($query_id_rol);
?>

<select name="rol" id="rol">
<?php
if($result_id_rol>0){
  while($rol=mysqli_fetch_array($query_id_rol)){
    ?>
     <option value="<?php echo $rol["id_rol"];?>"><?php echo $rol["rol"];?></option> 
     <?php
  }
}
?>
</select>
<input type="submit" value="Crear Usuario" class="btn_save"> 

</form>
</div>

	</section>
	<?php include "includes/footer.php";?>
</body>

</html>