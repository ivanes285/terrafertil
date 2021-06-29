<?php
session_start();

include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';

    
    $nombregrupo=$_POST['nombregrupo'];
    $idusuario=$_POST['idusuario'];
    $idnorma=$_POST['idnorma'];

    $query_insert = mysqli_query($conection, "INSERT INTO grupoauditor (nombregrupo,idusuario,idnorma) VALUES 
    ('$nombregrupo','$idusuario','$idnorma')");

    if ($query_insert) {
        $alert = '<p class="msg_save">CREADO CORRECTAMENTE</p>';
    } else {
        
        $alert = '<p class="msg_error">Error al Registra Proceso</p>' ;
    }
}
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Grupo Auditor</title>
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
            <h1 style="text-align: center">Registro de Grupo de Auditores</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form action="" method="POST">

            <label for="nombregrupo">Nombre Grupo de Auditores</label>
                <input type="text" name="nombregrupo" id="nombregrupo" placeholder="Ingrese nombre del Grupo" required>
                <label for="idusuario">Auditor lider del Grupo</label>
                <?php

                $query_id_user= mysqli_query($conection, "SELECT * FROM usuario  WHERE rol=2");
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

                <label for="idnorma">Escoja la Norma</label>
                <?php

                $query_idnorm= mysqli_query($conection, "SELECT * FROM norma");
                // mysqli_close($conection);
                $result_id_user = mysqli_num_rows( $query_idnorm);
                ?>
                <select name="idnorma" id="idnorma">
                    <?php
                    if ($result_id_user > 0) {
                        while ($user = mysqli_fetch_array( $query_idnorm)) {
                    ?>
                            <option value="<?php echo $user["idnorma"]; ?>"><?php echo $user["nombrenorma"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <input type="submit" value="Registrar" class="btn_save">
            </form>
        </div>
    </section>
    </script>
</body>
</html>