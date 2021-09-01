<?php
session_start();

if ($_SESSION['rol'] != 2) {
  header("location: ./");
}
include "../conexion.php";

$usu = $_SESSION['id_user'];

$iddetalleauditoria = $_REQUEST['ida'];
if (!empty($_POST)) {

  $iddetalleclausula = $_POST['iddetalleclausula'];

  $query_delete = mysqli_query($conection, "UPDATE detalleclausula SET estadoplan=2 WHERE iddetalleclausula = $iddetalleclausula");
  mysqli_close($conection);


  $cadena=" lista_noconformidades.php?id=".$iddetalleauditoria;
  
  if ($query_delete) {
 
    header("Location:".$cadena);
  } else {
    $alert = '<p class="msg_error">Error al Cerrar el PLAN </p>';
  }
}


if (empty($_REQUEST['id'])) {
  header("Location:".$cadena);
  mysqli_close($conection);
} else {

  $iddetalleclausula = $_REQUEST['id'];

  
  $sql = mysqli_query($conection, "SELECT consecuencia, analisiscausa,desarrollometodo,causaraiz FROM plandeaccion pa, detalleclausula dc WHERE pa.iddetalleclausula=dc.iddetalleclausula AND pa.iddetalleclausula=$iddetalleclausula; ");
  mysqli_close($conection);
  $result = mysqli_num_rows($sql);

  if ($result > 0) {

    while ($data = mysqli_fetch_array($sql)) {
      
      $consecuencia = $data[0];
      $analisiscausa= $data[1];
      $desarrollometodo = $data[2];
      $causaraiz=$data[3];
    }
  } else {
    header("Location:".$cadena);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <?php include "includes/scripts.php"; ?>
  <title>Cerrar Plan</title>
</head>

<body>
  <?php include "includes/header.php"; ?>
  <section id="container">
  <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
    <div class="data_delete">
      <h2 style="color: #C82333">¿Está seguro de CERRAR este PLAN?</h2>
      <p>Consecuencia: <span><?php echo $consecuencia; ?></span></p>
      <p>Análisis Causa: <span><?php echo $analisiscausa; ?></span></p>
      <p>Desarrollo Método: <span><?php echo $desarrollometodo; ?></span></p>
      <p>Causa Raíz: <span><?php echo $causaraiz; ?></span></p>
      <form method="POST" action="">
        <input type="hidden" name="iddetalleclausula" value="<?php echo $iddetalleclausula; ?>">
      
        <center><a style="border: 2px solid #2e518b;  color: #ffffff; background-color: #1883ba;" href="lista_noconformidades.php?id=<?php echo $iddetalleauditoria; ?>" class="btn_cancel">Regresar</a> </center>
        <input type="submit" style="border: 2px solid #2e518b;  color: #ffffff; background-color: #04B404; font-size: 17px;" value="Cerrar Plan" class="btn_ok">
      </form>
    </div>
  </section>
</body>
</html>