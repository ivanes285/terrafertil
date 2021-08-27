<?php
session_start();
if ($_SESSION['rol'] != 1) {
  header("location: ./");
}
include "../conexion.php";


//Seccion para enviar los datos a la bdd
if (!empty($_POST)) {
  $alert = '';

  $user = $_POST['user'];
  $password = md5($_POST['password']);
  $rol = $_POST['rol'];
  $correo = $_POST['correo'];
  $estatus =1;
  $query = mysqli_query($conection, " SELECT * FROM usuario  WHERE  user='$user' ");
  $result = mysqli_fetch_array($query);

  if ($result > 0) {
    $alert = '<p class="msg_error">!Ya existe un usuario con este nombre INTENTA POR FAVOR CON OTRO</p>';
  } else {

    $query_insert = mysqli_query($conection, "INSERT INTO usuario (user,password,rol,correo,estatus) VALUES ('$user','$password','$rol','$correo','$estatus')");

    if ($query_insert) {
      $alert = '<p class="msg_save">Usuario creado correctamente</p>';
    } else {
      $alert = '<p class="msg_error">Error al crear usuario</p>';
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <?php include "includes/scripts.php"; ?>
  <title>Registro de Usuario</title>
</head>

<body>
  <?php include "includes/header.php"; ?>
  <section id="container">

    <div class="form_register">
      <h1 style="text-align: center">Registro de Usuarios</h1>
      <hr>
      <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

      <form action="" method="POST">

        <label for="user">Nombre</label>
        <input type="text" name="user" id="user" placeholder="Ingrese su nombre" required>


        <label for="password">password</label>
        <input type="password" name="password" id="password" placeholder="Ingrese su password " required>

        <label for="correo">correo</label>
        <input type="text" name="correo" id="correo" placeholder="Ingrese su correo" required>

        <label for="rol">Rol</label>
        <?php

        $query_id_rol = mysqli_query($conection, "SELECT * FROM rol ");
        mysqli_close($conection);
        $result_id_rol = mysqli_num_rows($query_id_rol);
        ?>

        <select name="rol" id="rol">
          <?php
          if ($result_id_rol > 0) {
            while ($rol = mysqli_fetch_array($query_id_rol)) {
          ?>
              <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?></option>
          <?php
            }
          }
          ?>
        </select>
        <br>
        <a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 132px; background-color: #36A152; border-radius: 6px;" class="btn_save1" href="lista_usuario.php">Regresar</a> 
        <input type="submit" value="Crear Usuario" class="btn_save">
        

      </form>
    </div>

  </section>

</body>

</html>