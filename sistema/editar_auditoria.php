<?php
session_start();
include "../conexion.php";


if (!empty($_POST)) {
    $alert = '';
    $iddetalleauditoria = $_POST['iddetalleauditoria'];
    $codigoauditoria = $_POST['codigoauditoria'];
    $idperiodo = $_POST['tiempoperiodo'];
    $fechaejecucion = $_POST['fechaejecucion'];
    $idgrupo = $_POST['grupoauditor'];

    $query_update = mysqli_query($conection, "UPDATE detalleauditoria SET codigoauditoria='$codigoauditoria',idperiodo=$idperiodo, fechaejecucion='$fechaejecucion', idgrupo=$idgrupo  WHERE iddetalleauditoria=$iddetalleauditoria");
    if ($query_update) {
        $alert = '<p class="msg_save">PROCESO Actualizado </p>';
    } else {
        $alert = '<p class="msg_error">Error al Actualizar </p>';
    }
}

if (empty($_REQUEST['id'])) {
    header('Location: listar_auditorias.php');
    mysqli_close($conection);
}


$iddetalleauditoria = $_REQUEST['id'];
$sql = mysqli_query($conection, "SELECT * FROM detalleauditoria WHERE iddetalleauditoria=$iddetalleauditoria");


mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header('Location: listar_auditorias.php');
} else {

    $option = '';
    while ($data = mysqli_fetch_array($sql)) {
        $iddetalleauditoria = $data['iddetalleauditoria'];
        $codigoauditoria = $data['codigoauditoria'];
        $idperiodo = $data['idperiodo'];
        $fechaejecucion = $data['fechaejecucion'];
        $idgrupo = $data['idgrupo'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar Proceso</title>
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
            <h1 style="text-align: center">Actualizar Auditoría</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="POST">
                <input type="hidden" name="iddetalleauditoria" value="<?php echo $iddetalleauditoria; ?>">

                <label for="codigoauditoria">Código Auditoria</label>
                <input type="text" name="codigoauditoria" id="codigoauditoria" placeholder="Ingrese el código de auditoría" required value="<?php echo $codigoauditoria; ?>">


                <label for="tiempoperiodo">Tiempo Periodo</label>
                <?php
                include "../conexion.php";
                $query_id_user = mysqli_query($conection, "SELECT * FROM periodo");
                mysqli_close($conection);
                $result_id_user = mysqli_num_rows($query_id_user);
                ?>
                <select name="tiempoperiodo" id="tiempoperiodo">
                    <?php
                    if ($result_id_user > 0) {
                        while ($periodo = mysqli_fetch_array($query_id_user)) {
                    ?>
                            <option value="<?php echo $periodo["idperiodo"]; ?>"><?php echo $periodo["tiempoperiodo"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>

                <label for="fechaejecucion">Fecha de Ejecución</label>
                <input type="text" name="fechaejecucion" id="fechaejecucion" autocomplete="off" value="<?php echo $fechaejecucion; ?>">

                <label for="grupoauditor">Grupo Auditor</label>
                <?php
                include "../conexion.php";
                $query_id_user = mysqli_query($conection, "SELECT * FROM grupoauditor");
                mysqli_close($conection);
                $result_id_user = mysqli_num_rows($query_id_user);
                ?>
                <select name="grupoauditor" id="grupoauditor">
                    <?php
                    if ($result_id_user > 0) {
                        while ($grupo = mysqli_fetch_array($query_id_user)) {
                    ?>
                            <option value="<?php echo $grupo["idgrupo"]; ?>"><?php echo $grupo["nombregrupo"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>


                <center><a style="border: 2px solid #2e518b;  color: #ffffff; background-color: #1883ba;" href="lista_detalleauditoria.php" class="btn_cancel">Cancelar</a> </center>
                <input type="submit" value="Actualizar" class="btn_save">
            </form>
        </div>
    </section>
    <script>
        $(function() {
            $("#fechaejecucion").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 0
            });
        });
    </script>
</body>

</html>