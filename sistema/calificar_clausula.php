<?php
session_start();
include "../conexion.php";

if (!empty($_POST)) {


    if (empty($_POST['desincumplimiento'])) {
        $iddetalleclausula = $_POST['iddetalleclausula'];
        $parametroscali = $_POST['parametroscali'];
        $docsoporte = $_POST['docsoporte'];

        $query_update = mysqli_query($conection, "UPDATE detalleclausula SET parametroscalificacion='$parametroscali', documentacionsoporte='$docsoporte' WHERE iddetalleclausula=$iddetalleclausula");
        if ($query_update) {
            $alert = '<p class="msg_save">Clausula Evaluada</p>';
        } else {
            $alert = '<p class="msg_error">Error al Evaluar </p>';
        }
    } else {
        $iddetalleclausula = $_POST['iddetalleclausula'];
        $parametroscali = $_POST['parametroscali'];
        $desincumplimiento = $_POST['desincumplimiento'];
        $docsoporte = $_POST['docsoporte'];

        if ($parametroscali != "cumple") {
            $query_update = mysqli_query($conection, "UPDATE detalleclausula SET parametroscalificacion='$parametroscali', desincumplimiento='$desincumplimiento', documentacionsoporte='$docsoporte' WHERE iddetalleclausula=$iddetalleclausula");
            if ($query_update) {
                $alert = '<p class="msg_save">Clausula Evaluada</p>';
            } else {
                $alert = '<p class="msg_error">Error al Evaluar </p>';
            }
        }
    }
}


if (empty($_REQUEST['id'])) {
    header('Location: formulario_clausulas.php');
    mysqli_close($conection);
}

$iddetalleclausula = $_REQUEST['id'];
$iddetalleauditoria = $_REQUEST['da'];

$sql = mysqli_query($conection, "SELECT * FROM detalleclausula WHERE iddetalleclausula=$iddetalleclausula");

mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header('Location: formulario_clausulas.php');
} else {
    while ($data = mysqli_fetch_array($sql)) {
        $iddetalleclausula = $data[0];
        $parametroscali = $data[2];
        $desincumplimiento = $data[3];
        $docsoporte = $data[4];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar Grupo Auditor</title>
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
            <h1 style="text-align: center">EVALUAR</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form action="" method="POST">

                <input type="hidden" name="iddetalleclausula" value="<?php echo $iddetalleclausula; ?>">

                <label for="actividad">Parametros de Calificación</label>

                <select name="parametroscali" id="parametroscali">

                    <option value="cumple" selected>Cumple</option>
                    <option value="noconformidadmayor">No Conformidad Mayor</option>
                    <option value="noconformidadmenor">No confirmidad Menor</option>
                    <option value="observacion">Observacion</option>
                    <option value="oportunidaddemejora">Oportunidad de mejora</option>
                </select>

                <label for="actividad">Descripcion de Incumplimiento</label>
                <textarea name="desincumplimiento" id="desincumplimiento" disabled cols="30" rows="10" placeholder="Ingrese la Descripcion del Incumplimiento"><?php echo  $desincumplimiento ?></textarea>
                <label for="docsoporte">Documentacion Soporte</label>
                <input type="text" name="docsoporte" id="docsoporte" placeholder="Ingrese Documentacion Soporte" value="<?php echo  $docsoporte ?>">
                <br />
                <a name="se" href="formulario_clausulas.php?id=<?php echo $iddetalleauditoria ?>" class="btn_save">REGRESAR</a>
                <input type="submit" value="Evaluar" name="prueba" class="btn_save">
            </form>
        </div>
    </section>

    <script type="text/javascript">
        $(function() {
            $("#parametroscali").change(function() {
                if ($(this).val() === "cumple") {
                    $("#desincumplimiento").val('');
                    $("#desincumplimiento").prop("disabled", true);
                } else {
                    $("#desincumplimiento").prop("disabled", false);
                }
            });
        });
        $(function() {
            $("#parametroscali").val('<?php echo $parametroscali; ?>')
            if ($(this).val() === "cumple") {
                $("#desincumplimiento").val('');
                $("#desincumplimiento").prop("disabled", true);
            } else {
                $("#desincumplimiento").prop("disabled", false);
            }
        });
    </script>
</body>

</html>