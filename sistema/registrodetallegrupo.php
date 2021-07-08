<?php
session_start();

include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';


    $idusername = $_POST['idusuario'];
    $idrolauditor = $_POST['idrolauditor'];
    $actividadrealizada = $_POST['actividad'];
    $idgrupo = $_POST['idgrupo'];

    $query_insert = mysqli_query($conection, "INSERT INTO detallegrupo (id_user,idrolauditor,actividadrealizada,idgrupo) VALUES 
    ('$idusername','$idrolauditor','$actividadrealizada','$idgrupo')");

    if ($query_insert) {
        $alert = '<p class="msg_save">CREADO CORRECTAMENTE</p>';
    } else {

        $alert = '<p class="msg_error">Error al Registrar GRUPO AUDITORES</p>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Grupos Auditores</title>
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
            <h1 style="text-align: center">Registro de Auditores</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form action="" method="POST">

                <label for="idusuario">Auditor del Grupo</label>
                <?php

                $query_id_user = mysqli_query($conection, "SELECT * FROM usuario  WHERE rol=2");
                // mysqli_close($conection);
                $result_id_user = mysqli_num_rows($query_id_user);
                ?>
                <select name="idusuario" id="idusuario">
                    <?php
                    if ($result_id_user > 0) {
                        while ($user = mysqli_fetch_array($query_id_user)) {
                    ?>
                            <option value="<?php echo $user["id_user"]; ?>"><?php echo $user["user"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>



                <label for="idrolauditor">Rol Auditor</label>
                <?php
                $query_id_user = mysqli_query($conection, "SELECT * FROM rolauditor");
                $result_id_user = mysqli_num_rows($query_id_user);
                ?>
                <select name="idrolauditor" id="idrolauditor">
                    <?php
                    if ($result_id_user > 0) {
                        while ($rol = mysqli_fetch_array($query_id_user)) {
                    ?>
                            <option value="<?php echo $rol["idrolauditor"]; ?>"><?php echo $rol["rolauditor"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>


                <label for="actividad">Actividad Realizada</label>
                <textarea name="actividad" cols="30" rows="10" placeholder="Ingrese la Actividad"></textarea>


                <label for="idgrupo">Asignar a Grupo</label>
                <?php
                $query_id_user = mysqli_query($conection, "SELECT * FROM grupoauditor");
                $result_id_user = mysqli_num_rows($query_id_user);
                ?>
                <select name="idgrupo" id="idgrupo">
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

                <input type="submit" value="Registrar" class="btn_save">
            </form>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#idusuario').select2();
        });
    </script>
</body>

</html>