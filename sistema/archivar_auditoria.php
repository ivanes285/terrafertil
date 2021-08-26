<?php
session_start();

if ($_SESSION['rol'] != 2) {
  header("location: ./");
}
include "../conexion.php";

$usu = $_SESSION['id_user'];

if (!empty($_POST)) {

  $iddetalleauditoria = $_POST['iddetalleauditoria'];

  $query_delete = mysqli_query($conection, "UPDATE detalleauditoria SET estado =3 WHERE iddetalleauditoria = $iddetalleauditoria");
  mysqli_close($conection);
  if ($query_delete) {
 
    header('Location: lista_auditorvistaeje.php');
  } else {
    $alert = '<p class="msg_error">Error al Archivar Auditoría </p>';
  }
}


if (empty($_REQUEST['id'])) {

  header('Location: lista_auditorvistaeje.php');
  mysqli_close($conection);
} else {

  $iddetalleauditoria = $_REQUEST['id'];
  
  $sql = mysqli_query($conection, "SELECT codigoauditoria,fechaejecucion,nombrenorma,iddetalleauditoria from norma n, grupoauditor ga, detallegrupo dg, detalleauditoria da WHERE n.idnorma=ga.idnorma and ga.idgrupo=dg.idgrupo AND dg.idgrupo=da.idgrupo AND dg.id_user=$usu AND da.estado=2 AND  da.iddetalleauditoria=$iddetalleauditoria; ");
  mysqli_close($conection);
  $result = mysqli_num_rows($sql);

  if ($result > 0) {

    while ($data = mysqli_fetch_array($sql)) {
      
      $codigoauditoria = $data[0];
      $fechaejecucion= $data[1];
      $norma = $data[2];
      $iddetalleauditoria=$data[3];
    }
  } else {
    header('Location: lista_auditorvistaeje.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <?php include "includes/scripts.php"; ?>
  <title>Archivar Auditoría</title>
</head>

<body>
  <?php include "includes/header.php"; ?>
  <section id="container">
  <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
    <div class="data_delete">
      <h2 style="color: #C82333">¿Está seguro de ARCHIVAR esta auditoría?</h2>
      <p>Código Auditoría: <span><?php echo $codigoauditoria; ?></span></p>
      <p>Fecha de Ejecución: <span><?php echo $fechaejecucion; ?></span></p>
      <p>Norma: <span><?php echo $norma; ?></span></p>

      <form method="POST" action="">
        <input type="hidden" name="iddetalleauditoria" value="<?php echo $iddetalleauditoria; ?>">
        <center><a style="border: 2px solid #2e518b;  color: #ffffff; background-color: #1883ba;" href="lista_auditorvistapro.php" class="btn_cancel">Regresar</a> </center>
        <input type="submit" style="border: 2px solid #2e518b;  color: #ffffff; background-color: #04B404; font-size: 17px;" value="Guardar" class="btn_ok">
      </form>
    </div>
  </section>
</body>
</html>