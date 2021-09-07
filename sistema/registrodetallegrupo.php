<?php
session_start();

include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';

    $iduser = $_POST['idusuario'];
    $idgrupo = $_POST['idgrupo'];
    $idrolauditor = $_POST['idrolauditor'];
    $actividadrealizada = $_POST['actividad'];


   // $query = mysqli_query($conection, "SELECT * FROM detallegrupo  WHERE  idgrupo=$idgrupo AND idrolauditor=1");
   // $result = mysqli_fetch_array($query);


    $sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM detallegrupo  WHERE  idgrupo=$idgrupo AND idrolauditor=1");
    $result_register = mysqli_fetch_array($sql_registe);
    $total_registro = $result_register['total_registro'];

    if ($total_registro==1 && $idrolauditor == 1 ) {
        $alert = '<p class="msg_error">!Ya existe un Lider para este Grupo, ingresa un auditor secundario</p>';
    } else {
        $query_insert = mysqli_query($conection, "INSERT INTO detallegrupo (id_user,idgrupo,idrolauditor,actividadrealizada) VALUES 
        ('$iduser','$idgrupo','$idrolauditor','$actividadrealizada')");
        if ($query_insert) {
            $alert = '<p class="msg_save">CREADO CORRECTAMENTE</p>';
        } else {
            $alert = '<p class="msg_error">Error al Registrar GRUPO AUDITORES</p>';
        }
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
                $query = mysqli_query($conection, "SELECT * FROM rolauditor");
                $result_id_user = mysqli_num_rows($query);
                ?>
                <select name="idrolauditor" id="idrolauditor">
                    <?php
                    if ($result_id_user > 0) {
                        while ($rol = mysqli_fetch_array($query)) {
                    ?>
                            <option value="<?php echo $rol["idrolauditor"]; ?>"><?php echo $rol["rolauditor"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>


                <label for="actividad">Actividad Realizada</label>
                <textarea name="actividad" cols="30" rows="10" placeholder="Ingrese la Actividad"></textarea>
                <br>
                <br>
                <a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 132px; background-color: #36A152; border-radius: 6px;" class="btn_save1" href="listadetallegrupo.php">Regresar</a>
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