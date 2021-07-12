<?php
session_start();

if ($_SESSION['rol'] != 1) {
    header("location: ./");
}

include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';

    $codigoauditoria = $_POST['codigoauditoria'];
    $idperiodo = $_POST['tiempoperiodo']; 
    $fechaejecucion=$_POST['fechaejecucion'];
    $idgrupode=$_POST['detallegrupo'];
    

    $query = mysqli_query($conection, "SELECT * FROM detalleauditoria WHERE  codigoauditoria='$codigoauditoria' ");
    $result = mysqli_fetch_array($query);
    if ($result > 0) {
        $alert = '<p class="msg_error">Proceso YA existe !Intente de Nuevo con una nueva Auditoria</p>';
    } else {
        $query_insert = mysqli_query($conection, "INSERT INTO detalleauditoria (codigoauditoria,idperiodo,fechaejecucion,idgrupo) VALUES 
        ('$codigoauditoria',$idperiodo,'$fechaejecucion', $idgrupode)");

        if ($query_insert) {
            $alert = '<p class="msg_save">CREADO CORRECTAMENTE</p>';
        } else {

            $alert = '<p class="msg_error">Error al Registrar Auditoria </p>';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Registro de Auditoria</title>
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
            <h1 style="text-align: center">Registro de Auditoria</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="POST">

                <label for="codigoauditoria">Código Auditoria</label>
                <input type="text" name="codigoauditoria" id="codigoauditoria" placeholder="Ingrese el código de auditoría" required>

                <label for="tiempoperiodo">Tiempo Periodo</label>
                <?php
                $query_id_user = mysqli_query($conection, "SELECT * FROM periodo");
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
                <input type="text" name="fechaejecucion" id="fechaejecucion" autocomplete="off">

                <label for="grupoauditor">Grupo de Auditoria</label>
                <?php
                $query_id_user = mysqli_query($conection, "SELECT  nombregrupo,iddetallegrupo FROM grupoauditor ga, detallegrupo dg WHERE ga.idgrupo=dg.idgrupo AND dg.idrolauditor=1");
                $result_id_user = mysqli_num_rows($query_id_user);
                ?>
                <select name="detallegrupo" id="detallegrupo">
                    <?php
                    if ($result_id_user > 0) {
                        while ($grupo = mysqli_fetch_array($query_id_user)) {
                    ?>
                            <option value="<?php echo $grupo["iddetallegrupo"]; ?>"><?php echo $grupo["nombregrupo"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <input type="submit" value="Registrar" class="btn_save">
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