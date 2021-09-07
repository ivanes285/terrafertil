<?php
session_start();
if ($_SESSION['rol'] != 3) {
  header("location: ./");
}
include "../conexion.php";

$iddetalleauditoria = $_REQUEST['ida'];
$iddetalleclausula = $_REQUEST["id"];

if (!empty($_POST)) {

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <?php include "includes/scripts.php"; ?>
  <title>Registro Plan de Acción</title>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
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
        <div style="display: flex; justify-content: space-evenly; ">
          <select name="analisiscausa" id="analisiscausa" onchange="obtenerdocumento();" required>
            <option value="5 por que" selected >5 por que?</option>
            <option value="Lluvia de ideas">Lluvia de ideas</option>
            <option value="Diagrama de Ishkawa">Diagrama de Ishkawa</option>
            <option value="Pareto">Pareto</option>
            <option value="Otros">Otros</option>
          </select>
          <a target="_blank" style="font-size: 30px; text-align: right; padding-left: 10px;" id="descargarcausa" href="./archivos/5porque.png"><abbr id="texto" title="Descargue un ejemplo 5 por que"><i id="icono" class="fas fa-cloud-download-alt"></i></abbr> </a>
        </div>

        <label for="desametodo">Desarrollo método</label>
        <textarea name="desametodo" id="desametodo" cols="30" rows="10" placeholder="Describa el Desarrollo del método" required></textarea>
        <label for="descausaraiz">Descripción Causa Raiz</label>
        <textarea name="descausaraiz" id="descausaraiz" cols="30" rows="10" placeholder="Describa la causa raíz" required></textarea>
        <br />
        <br />
        <a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 132px; background-color: #36A152; border-radius: 6px;" class="btn_save1" href="lista_auditadovista.php?ida=<?php echo $iddetalleauditoria ?>">Regresar</a>
        <input type="submit" value="Guardar" class="btn_save">
      </form>
    </div>
  </section>

  <script type="text/javascript">
    function obtenerdocumento() {
      let ruta = document.getElementById("analisiscausa");
      let documento = ruta.value;
      var input = document.getElementById("descargarcausa");
      let icono = document.getElementById("icono");
      let texto = document.getElementById("texto");
   
      console.log(documento);
      if (documento == "5 por que") {
        input.href = "./archivos/5porque.png";
      } else if (documento == "Lluvia de ideas") {
        input.href = "./archivos/lluviaideas.png";
      } else if (documento == "Diagrama de Ishkawa") {
        input.href = "./archivos/ishkawa.png";
      } else if (documento == "Pareto") {
        input.href = "./archivos/pareto.png";
      } else if (documento == "Otros") {
        input.removeAttribute("href");
      }

      if(documento == "Otros"){
        texto.title="No hay archivo para descargar";
      }else{
        texto.title=`Visualiza un ejemplo de ${documento}`;
      }

    }
  </script>


</body>

</html>