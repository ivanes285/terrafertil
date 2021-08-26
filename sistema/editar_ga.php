<?php
session_start();
include "../conexion.php";

$iddetallegrupo = $_REQUEST['id'];
if (!empty($_POST)) {

    $id_user = $_POST['id_user'];
    $idgrupo = $_POST['grupoauditor'];
    $idrolauditor = $_POST['rol'];
    $actividadrealizada = $_POST['actividadrealizada'];


    $query = mysqli_query($conection, "SELECT * FROM detallegrupo  WHERE  idgrupo=$idgrupo AND idrolauditor=$idrolauditor");
    $result = mysqli_fetch_array($query);

    if ($result > 0) {
        $alert = '<p class="msg_error">!Ya existe un Lider para este Grupo, ingresa un auditor secundario</p>';
    } else {

        $query_update = mysqli_query($conection, "UPDATE detallegrupo SET id_user=$id_user, idgrupo=$idgrupo,idrolauditor=$idrolauditor, actividadrealizada='$actividadrealizada' WHERE iddetallegrupo=$iddetallegrupo");
        if ($query_update) {
            $alert = '<p class="msg_save">Grupo Actualizado </p>';
        } else {
            $alert = '<p class="msg_error">Error al Actualizar </p>';
        }
    }
}

if (empty($_REQUEST['id'])) {
    header('Location: listadetallegrupo.php');
    mysqli_close($conection);
}



$sql = mysqli_query($conection, "SELECT * FROM detallegrupo WHERE iddetallegrupo=$iddetallegrupo");


mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header('Location: listadetallegrupo.php');
} else {

    $option = '';
    while ($data = mysqli_fetch_array($sql)) {
        $id_user = $data[0];
        $idgrupo = $data[1];
        $idrolauditor = $data[2];
        $actividadrealizada = $data[3];
        $iddetallegrupo = $data[4];
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
            <h1 style="text-align: center">Actualizar Grupo</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="POST">
                <label for="id_user">Auditor</label>
                <?php
                include "../conexion.php";
                $query_id_user = mysqli_query($conection, "SELECT * FROM usuario where rol=2");
                mysqli_close($conection);
                $result_id_user = mysqli_num_rows($query_id_user);
                ?>
                <select name="id_user" id="id_user">
                    <?php
                    if ($result_id_user > 0) {
                        while ($periodo = mysqli_fetch_array($query_id_user)) {
                    ?>
                            <option value="<?php echo $periodo["id_user"]; ?>"><?php echo $periodo["user"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
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
                <label for="rol">Rol Auditor</label>
                <?php
                include "../conexion.php";
                $query_id_user = mysqli_query($conection, "SELECT * FROM rolauditor");
                mysqli_close($conection);
                $result_id_user = mysqli_num_rows($query_id_user);
                ?>
                <select name="rol" id="rol">
                    <?php
                    if ($result_id_user > 0) {
                        while ($periodo = mysqli_fetch_array($query_id_user)) {
                    ?>
                            <option value="<?php echo $periodo["idrolauditor"]; ?>"><?php echo $periodo["rolauditor"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>

                <label for="actividadrealizada">Actividad Realizada</label>
                <input type="text" name="actividadrealizada" id="actividadrealizada" autocomplete="off" value="<?php echo $actividadrealizada; ?>">

                <center><a style="border: 2px solid #2e518b;  color: #ffffff; background-color: #1883ba;" href="listadetallegrupo.php" class="btn_cancel">Regresar</a></center>
                <input type="submit" style="border: 2px solid #2e518b;  color: #ffffff; background-color: #04B404; font-size: 17px;" value="Actualizar" class="btn_save">
            </form>
        </div>
    </section>
    <script type="text/javascript">
        $(function() {
            $("#id_user").val('<?php echo $id_user; ?>')
        });
        $(function() {
            $("#grupoauditor").val('<?php echo $idgrupo; ?>')
        });

        $(function() {
            $("#rol").val('<?php echo $idrolauditor ; ?>')
        });
    </script>


</body>

</html>