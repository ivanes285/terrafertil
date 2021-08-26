<?php
session_start();
include "../conexion.php";
    $idaccionpropuesta = $_REQUEST['idap'];
    $idplanaccion = $_REQUEST['idpa'];
    $iddetalleclausula = $_REQUEST['id'];
    $iddetalleauditoria = $_REQUEST['ida'];

if (!empty($_POST)) {
    $accionpropuesta = $_POST['accionpropuesta'];
    $responsable = $_POST['responsable'];
    $fechapropuesta = $_POST['fechapropuesta'];
    $evidencia = $_POST['evidencia'];
    $cadena="lista_accionpropuesta.php?idpa=".$idplanaccion."&id=".$iddetalleclausula."&ida=".$iddetalleauditoria;
        $query_update = mysqli_query($conection, "UPDATE accionespropuestas SET accionpropuesta='$accionpropuesta', responsable='$responsable',fechapropuesta='$fechapropuesta',evidencia='$evidencia' WHERE idaccionpropuesta=$idaccionpropuesta");
        if ($query_update) {
            $alert = '<p class="msg_save">Acción propuesta Actualizada </p>';
        } else {
            $alert = '<p class="msg_error">Error al Actualizar </p>';
        }
    }



if (empty($_REQUEST['idap'])) {
    header("location:".$cadena);
    mysqli_close($conection);
}

$idaccionpropuesta = $_REQUEST['idap'];
$sql = mysqli_query($conection, "SELECT * FROM accionespropuestas WHERE idaccionpropuesta=$idaccionpropuesta");

mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header("location:".$cadena);
} else {
    
    $option = '';
    while ($data = mysqli_fetch_array($sql)) {
        $accionpropuesta = $data[2];
        $responsable = $data[3];
        $fechapropuesta = $data[4];
        $evidencia = $data[5];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar Proceso</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <h1 style="text-align: center">Actualizar Proceso</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="POST">
                <input type="hidden" name="idaccionpropuesta" value="<?php echo $idaccionpropuesta; ?>">
                <label for="accionpropuesta">Acción propuesta</label>
                <textarea name="accionpropuesta"  cols="30" rows="10" placeholder="Ingrese la acción propuesta" required><?php echo $accionpropuesta; ?></textarea>
                <label for="responsable">Responsable</label>
                <input type="text" name="responsable" id="responsable" placeholder="Ingrese el responsable" required value="<?php echo $responsable; ?>">
                <label for="fechapropuesta">Fecha Propuesta</label>
                <input type="text" name="fechapropuesta" id="fechapropuesta" autocomplete="off" value="<?php echo $fechapropuesta; ?>">
                <label for="evidencia">Evidencias</label>
                <textarea name="evidencia"  cols="30" rows="10" placeholder="Ingrese la evidencia" required><?php echo $evidencia; ?></textarea>
                <br />
                <br />
                <a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 132px; background-color: #36A152; border-radius: 6px;" class="btn_save1"  href="lista_accionpropuesta.php?idpa=<?php echo $idplanaccion ?>&id=<?php echo $iddetalleclausula ?>&ida=<?php echo $iddetalleauditoria ?>">Regresar</a> 
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