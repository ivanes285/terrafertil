<?php
session_start();
if ($_SESSION['rol'] != 1) {
  header("location: ./");
}
include "../conexion.php";

if (!empty($_POST)) {
  $alert = '';
  $idusuario = $_POST['id'];
  $usuario = $_POST['user'];
  $clave = md5($_POST['password']);
  $rol = $_POST['rol'];
  $query = mysqli_query($conection, "SELECT * FROM usuario WHERE (user='$usuario' AND id_user!=$idusuario)");
  $result = mysqli_fetch_array($query);

  if ($result > 0) {
    $alert = '<p class="msg_error">usuario YA existe !Intente de Nuevo</p>';
  } else {
    if (empty($_POST['password'])) {
      $query_update = mysqli_query($conection, "UPDATE usuario SET user='$usuario', rol='$rol' WHERE id_user=$idusuario");
    } else {

      $query_update = mysqli_query($conection, "UPDATE usuario SET user='$usuario', password='$clave', rol='$rol' 
              WHERE id_user= $idusuario");
    }
    if ($query_update) {
      $alert = '<p class="msg_save">Usuario Actualizado CORRECTAMENTE</p>';
    } else {
      $alert = '<p class="msg_error">Error al Actualizar Usuario</p>';
    }
  }
}

/*********************************************/

if (empty($_REQUEST['id'])) {
  header('Location: lista_usuario.php');
  mysqli_close($conection);
}
$iduser = $_REQUEST['id'];
$sql = mysqli_query($conection, "SELECT u.id_user,u.user,(u.rol) AS idrol,
        (r.rol) AS rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE id_user= $iduser AND estatus=1");
mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header('Location: lista_usuario.php');
} else {
  $option = '';
  while ($data = mysqli_fetch_array($sql)) {
    $idusuario = $data['id_user'];
    $usuario = $data['user'];
    $idrol = $data['idrol'];
    $rol = $data['rol'];

    if ($idrol == 1) {
      $option = '<option value="' . $idrol . '" select>' . $rol . '</option>';
    } else if ($idrol == 2) {
      $option = '<option value="' . $idrol . '" select >' . $rol . '</option>';
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <?php include "includes/scripts.php"; ?>
  <title>Actualizar Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
  <?php include "includes/header.php"; ?>
  <section id="container">

    <div class="form_register">
      <h1 style="text-align: center">Actualizar Usuario</h1>
      <hr>
      <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

      <form action="" method="POST">

        <input type="hidden" name="id" value="<?php echo $idusuario; ?>">

        <label for="user">Nombre</label>
        <input type="text" name="user" id="user" placeholder="Ingrese su nombre" required value="<?php echo $usuario; ?>">

        <label for="password">Clave</label>
        <input type="password" name="password" id="password" placeholder="Puede cambiar su clave">

        <?php
        include "../conexion.php";
        $query_rol = mysqli_query($conection, "SELECT * FROM rol");
        mysqli_close($conection);
        $result_rol = mysqli_num_rows($query_rol);
        ?>

        <label for="rol">Rol</label>
        <select name="rol" id="rol">
          <?php
          echo $option;
          if ($result_rol > 0) {
            while ($rol = mysqli_fetch_array($query_rol)) {
          ?>
              <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?></option>
          <?php
            }
          }
          ?>

        </select>
        <br>
        <a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 132px; background-color: #36A152; border-radius: 6px;" class="btn_save1" href="lista_usuario.php">Regresar</a> 
        <input type="submit" value="Actualizar Usuario" class="btn_save">

      </form>
    </div>

  </section>
  <script type="text/javascript">
        $(function() {
            $("#rol").val('<?php echo $idrol; ?>')
        });
    </script>

</body>

</html>