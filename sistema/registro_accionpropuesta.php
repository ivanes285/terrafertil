<?php
session_start();
if ($_SESSION['rol'] != 3) {
    header("location: ./");
}

include "../conexion.php";

if (!empty($_POST)) {

    $idplanaccion = $_POST['idplanaccion'];
    $accionpropuesta = $_POST['accionpropuesta'];
    $responsable = $_POST['responsable'];
    $fechapropuesta = $_POST['fechapropuesta'];
    $evidencia = $_POST['evidencia'];

    $query_insert = mysqli_query($conection, "INSERT INTO accionespropuestas (idplanaccion,accionpropuesta,responsable,fechapropuesta,evidencia) VALUES ($idplanaccion,'$accionpropuesta','$responsable','$fechapropuesta','$evidencia')");
    if ($query_insert) {
        $alert = '<p class="msg_save">Acción Propuesta Guardada Correctamente</p>';
    } else {
        $alert = '<p class="msg_error">Error al Guardar la Acción Propuesta</p>';
    }
}

if (empty($_REQUEST['idpa'])) {
    header('Location: lista_inclumplimientospe.php');
    mysqli_close($conection);
}

$idplanaccion = $_REQUEST['idpa'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Registro Acciones Propuestas</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">

        <div class="form_register">
            <h1 style="text-align: center">Registro Acciones Propuestas</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form action="" method="POST">

               <input type="hidden" name="idplanaccion" value="<?php echo $idplanaccion;?>"> 

                <label for="accionpropuesta">Acción Propuesta</label>
                <textarea name="accionpropuesta"  cols="30" rows="10" placeholder="Ingrese la acción propuesta" required></textarea>
                <label for="responsable">Responsable</label>
                <input type="text" name="responsable"  placeholder="Ingrese un responsable" required>
                <label for="fechapropuesta">Fecha Propuesta</label>
                <input type="text" name="fechapropuesta" id="fechapropuesta" autocomplete="off">
                <label for="evidencia">Evidencias</label>
                <textarea name="evidencia" id="evidencia" cols="30" rows="10" placeholder="Describa la evidencia" required></textarea>
                <br />
                <br />
                <a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 132px; background-color: #36A152; border-radius: 6px;" class="btn_save1" href="lista_accionpropuesta.php?id=<?php echo $idplanaccion ?>">Regresar</a> 
                <input type="submit" value="Guardar" class="btn_save">

            </form>
        </div>

    </section>
    <script>
        $(function() {
            $("#fechapropuesta").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 0
            });
        });
    </script>
</body>

</html>