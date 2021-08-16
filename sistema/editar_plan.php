<?php
session_start();

include "../conexion.php";

$cadena="";

$idplandeaccion = $_REQUEST['id'];



if (!empty($_POST)) {

    
    $consecuencia=$_POST['consecuencia'];
    $analisiscausa=$_POST['analisiscausa'];
    $desarrollometodo=$_POST['desarrollometodo'];
    $causaraiz=$_POST['causaraiz'];
        $query_update = mysqli_query($conection, "UPDATE plandeaccion SET consecuencia='$consecuencia', analisiscausa='$analisiscausa', desarrollometodo='$desarrollometodo',causaraiz='$causaraiz' WHERE idplandeaccion=$idplandeaccion");
        if ($query_update) {
            $alert = '<p class="msg_save">analisiscausa Actualizado </p>';
        } else {
            $alert = '<p class="msg_error">Error al Actualizar </p>';
        }
    }



if (empty($_REQUEST['id'])) {
    $cadena="lista_planaccion.php";
    header("location:".$cadena);
    mysqli_close($conection);
}

$idplandeaccion = $_REQUEST['id'];
$sql = mysqli_query($conection, "SELECT * FROM plandeaccion WHERE idplandeaccion=$idplandeaccion");

mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    $cadena="lista_planaccion.php";
    header("location:".$cadena);
} else {

    $option = '';
    while ($data = mysqli_fetch_array($sql)) {
        $idplandeaccion = $data[0];
        $consecuencia = $data[2];
        $analisiscausa = $data[3];
        $desarrollometodo=$data[4];
        $causaraiz=$data[4];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar plan de acción</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <h1 style="text-align: center">Actualizar Plan Acción</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="POST">
                <input type="hidden" name="idplandeaccion" value="<?php echo $data[0]; ?>">
                <label for="consecuencia">consecuencia </label>
                <input type="text" name="consecuencia" id="consecuencia" placeholder="Ingrese la consecuencia" required value="<?php echo $consecuencia; ?>">
                <label for="analisiscausa">Ingrese el análisis causa</label>
                <label for="actividad">Parametros de Calificación</label>
                     <select name="analisiscausa" id="analisiscausa">
                        <option value="5 por que?" selected>5 por que?</option>
                        <option value="Lluvia de ideas">Lluvia de ideas</option>
                        <option value="Diagrama de Ishkawa">Diagrama de Ishkawa</option>
                        <option value="Pareto">Pareto</option>
                        <option value="Otros">Otros</option>
                     </select>
                <label for="desarrollometod">Ingrese el desarrollo del método</label>
                <input type="text" name="desarrollometodo" id="desarrollometodo" placeholder="Ingrese el desarrollo del método" required value="<?php echo $desarrollometodo; ?>">
                <label for="analisiscausa">Ingrese la causaraiz</label>
                <input type="text" name="causaraiz" id="causaraiz" placeholder="Ingrese la causa raíz" required value="<?php echo $causaraiz; ?>">
                
                <center><a style="border: 2px solid #2e518b;  color: #ffffff; background-color: #1883ba;" href="lista_planaccion.php" class="btn_cancel">Cancelar</a> </center>
                <input type="submit" value="Actualizar" class="btn_save">
            </form>
        </div>
    </section>
</body>

</html>