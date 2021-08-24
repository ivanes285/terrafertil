<?php
session_start();
if ($_SESSION['rol'] != 3) {
  header("location: ./");
}
include "../conexion.php";



if (!empty($_POST)) {

  $iddetalleclausula = $_POST["iddetalleclausula"];
  $consecuencia = $_POST["consecuencia"];
  $analisiscausa = $_POST["analisiscausa"];
  $desametodo = $_POST["desametodo"];
  $causaraiz = $_POST["descausaraiz"];


  $query_insert = mysqli_query($conection, "INSERT INTO plandeaccion (iddetalleclausula,consecuencia,analisiscausa,desarrollometodo,causaraiz) VALUES ('$iddetalleclausula','$consecuencia','$analisiscausa','$desametodo','$causaraiz')");
  $query_update = mysqli_query($conection, "UPDATE detalleclausula SET planaccion=2 WHERE iddetalleclausula=$iddetalleclausula");

  if ($query_insert && $query_update) {
    $alert = '<p class="msg_save">Plan de Accion creado Correctamente</p>';
  } else {
    $alert = '<p class="msg_error">Error al Crear Plan de Acción</p>';
  }
}

if (empty($_REQUEST['id'])) {
  header('Location: lista_auditadovista.php');
  mysqli_close($conection);
}

$iddetalleclausula = $_REQUEST['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <?php include "includes/scripts.php"; ?>
  <title>Registro Plan de Acción</title>
</head>

<body>
  <?php include "includes/header.php"; ?>
  <section id="container">

    <div class="form_register">
      <h1 style="text-align: center">Registro de Plan de Acción</h1>
      <hr>
      <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

      <form action="" method="POST">

        <input type="hidden" name="iddetalleclausula" value="<?php echo $iddetalleclausula; ?>">

        <label for="consecuencia">Consecuencia</label>
        <textarea name="consecuencia" id="consecuencia" cols="30" rows="10" placeholder="Describa la consecuencia" required></textarea>

        <label for="actividad">Parametros de Calificación</label>

        <select name="analisiscausa" id="analisiscausa">
          <option value="5 por que?" selected>5 por que?</option>
          <option value="Lluvia de ideas">Lluvia de ideas</option>
          <option value="Diagrama de Ishkawa">Diagrama de Ishkawa</option>
          <option value="Pareto">Pareto</option>
          <option value="Otros">Otros</option>
        </select>

        
        <label for="desametodo">Desarrollo método</label>
        <textarea name="desametodo" id="desametodo" cols="30" rows="10" placeholder="Describa el Desarrollo del método" required></textarea>

        <label for="descausaraiz">Descripción Causa Raiz</label>
        <textarea name="descausaraiz" id="descausaraiz" cols="30" rows="10" placeholder="Describa la causa raíz" required></textarea>

        <br/>
        <center> <a style="border: 2px solid #2e518b;  color: #ffffff; background-color: #1883ba;" class="btn_cancel" href="lista_auditadovista.php">Regresar</a> </center>
        <input type="submit" value="Guardar" class="btn_save">

      </form>
    </div>

  </section>

</body>

</html>