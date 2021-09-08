<?php
session_start();
include "../conexion.php";
if ($_SESSION['rol'] != 2) {
    header("location: ./");
}
if (empty($_REQUEST['idap'])) {
    header('Location: lista_accionespendientes.php');
    mysqli_close($conection);
}


$idplanaccion= $_REQUEST['idpa'];
$iddetalleclausula = $_REQUEST['id'];
$iddetalleauditoria = $_REQUEST['ida'];
$idaccionpropuesta = $_REQUEST['idap'];

$cadena="lista_accionespendientes.php?idpa=".$idplanaccion."&id=".$iddetalleclausula."&ida=".$iddetalleauditoria;

if (!empty($_POST)) {

    $fechacumplimiento  = $_POST['fechacumplimiento'];
    $status  = $_POST['status'];
  

    if (!isset($_POST['eficacia']) || ($status == 'no aceptado')) {
        $eficacia = '';
    } else {
        $eficacia = $_POST['eficacia'];
    }

    if (!isset($_POST['motivonoaceptacion']) || ($status == 'aceptado')) {
        $motivonoaceptacion = '';
    } else {
        $motivonoaceptacion = $_POST['motivonoaceptacion'];
    }
 
    if($status=="aceptado"){
        $query_update = mysqli_query($conection, "UPDATE accionespropuestas SET fechacumplimiento='$fechacumplimiento', status='$status', motivonoaceptacion='$motivonoaceptacion', eficacia='$eficacia' , estadover=2 WHERE idaccionpropuesta=$idaccionpropuesta");
    }else{
        $query_update = mysqli_query($conection, "UPDATE accionespropuestas SET fechacumplimiento='$fechacumplimiento', status='$status', motivonoaceptacion='$motivonoaceptacion', eficacia='$eficacia' WHERE idaccionpropuesta=$idaccionpropuesta");
    }

    
    if ($query_update) {
        $alert = '<p class="msg_save">Acción Propuesta Evaluada</p>';
        header("location:".$cadena);
    } else {
        $alert = '<p class="msg_error">Error al Evaluar </p>';
    }
}
if (empty($_REQUEST['idap'])) {
    header('Location: lista_accionespendientes.php');
    mysqli_close($conection);
}

$sql = mysqli_query($conection, "SELECT * FROM accionespropuestas WHERE idaccionpropuesta=$idaccionpropuesta");

mysqli_close($conection);
$status = "";
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header("location:".$cadena);
} else {
    while ($data = mysqli_fetch_array($sql)) {
        $fechacumplimiento = $data[6];
        $status = $data[7];
        $motivonoaceptacion = $data[8];
        $eficacia = $data[9];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Evaluar Acciónn Propuesta</title>
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
            <h1 style="text-align: center">Evaluar Acción Propuesta</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form action="" method="POST">

                <label for="fechacumplimiento">Fecha Cumplimiento</label>
                <input type="text" name="fechacumplimiento" id="fechacumplimiento" autocomplete="off" value="<?php echo $fechacumplimiento; ?>">

                <label for="status">Status</label>

                <select name="status" id="status" required>
                    <option value="aceptado" selected>Aceptado</option>
                    <option value="no aceptado">No Aceptado</option>
                </select>

                <label for="motivonoaceptacion">Motivo de no Aceptación</label>
                <textarea name="motivonoaceptacion" id="motivonoaceptacion" cols="30" rows="10" placeholder="Describa el motivo de no aceptación" required><?php echo  $motivonoaceptacion ?></textarea>

                <label for="eficacia" >Eficacia</label>
                <select name="eficacia" id="eficacia" required >
                    <option value="excelente">Excelente</option>
                    <option value="bueno">Bueno</option>
                    <option value="regular">Regular</option>
                </select>

                <br />
                
                <br />
                <a style="border: 2px solid #218838;  color: #ffffff; padding:10px 132px; background-color: #218838; border-radius: 6px;" class="btn_save1" href="lista_accionespendientes.php?idpa=<?php echo $idplanaccion ?>&id=<?php echo $iddetalleclausula ?>&ida=<?php echo $iddetalleauditoria ?>">Regresar</a> 
                <input type="submit" value="Evaluar" name="prueba" class="btn_save">
            </form>
        </div>
    </section>

    <script type="text/javascript">
        $(function() {
            $("#fechacumplimiento").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 0
            });
        });


        $(function() {
            $("#status").val('<?php echo $status; ?>')
            $("#eficacia").val('<?php echo $eficacia; ?>')
            if ($(this).val() === "no aceptado") {
                $("#eficacia").val('');
                $("#motivonoaceptacion").prop("disabled", false);
                $("#eficacia").prop("disabled", true);
            } else {
                $("#motivonoaceptacion").val('');
                $("#motivonoaceptacion").prop("disabled", true);
                $("#eficacia").prop("disabled", false);
            }

        });



        $(function() {
            $("#status").change(function() {
                if ($(this).val() === "no aceptado") {
                    $("#eficacia").val('');
                    $("#motivonoaceptacion").prop("disabled", false);
                    $("#eficacia").prop("disabled", true);
                } else {
                    $("#motivonoaceptacion").val('');
                    $("#motivonoaceptacion").prop("disabled", true);
                    $("#eficacia").prop("disabled", false);
                }
            });
        });
    </script>
</body>

</html>