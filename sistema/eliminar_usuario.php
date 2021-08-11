<?php
session_start();

if ($_SESSION['rol'] != 1) {
  header("location: ./");
}
include "../conexion.php";

if (!empty($_POST)) {

  /*if($_POST['id_user'] == 1){
    header("location: lista_usuario.php");
    mysqli_close($conection);
    exit;*/

  $idusuario = $_POST['id_user'];
  $query_delete = mysqli_query($conection, "UPDATE usuario SET estatus = 0 WHERE id_user = $idusuario");
  mysqli_close($conection);
  if ($query_delete) {
    header("location: lista_usuario.php");
  } else {
    echo "Error al eliminar";
  }
}


if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
  header('Location: lista_usuario.php');
  mysqli_close($conection);
} else {

  $idusuario = $_REQUEST['id'];
  $sql = mysqli_query($conection, "SELECT u.id_user, u.user,r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE id_user= $idusuario");
  mysqli_close($conection);
  $result = mysqli_num_rows($sql);

  if ($result > 0) {

    while ($data = mysqli_fetch_array($sql)) {
      $idusuario = $data['id_user'];
      $usuario = $data['user'];
      $rol = $data['rol'];
    }
  } else {
    header('Location: lista_usuario.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <?php include "includes/scripts.php"; ?>
  <title>Eliminar Usuarios</title>
</head>

<body>
  <?php include "includes/header.php"; ?>
  <section id="container">
    <div class="data_delete">
      <h2 style="color: #C82333">¿Está seguro de eliminar este registro?</h2>
      <p>Nombre: <span><?php echo $usuario; ?></span></p>
      <p>Rol: <span><?php echo $rol; ?></span></p>
      <form method="POST" action="">
        <input type="hidden" name="id_user" value="<?php echo $idusuario; ?>">
        <a style="border: 2px solid #2e518b; padding: 10px 132px; color: #ffffff; background-color: #1883ba; border-radius: 6px;" href="lista_usuario.php" class="btn_cancel">Cancelar</a>
        <input type="submit" value="Aceptar" class="btn_ok">
      </form>
    </div>
  </section>
</body>
</html>