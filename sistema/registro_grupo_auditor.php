<?php
session_start();

include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';

    
    $nombregrupo=$_POST['nombregrupo'];
    $idnorma=$_POST['idnorma'];

    $query_insert = mysqli_query($conection, "INSERT INTO grupoauditor (nombregrupo,idnorma) VALUES 
    ('$nombregrupo','$idnorma')");

    if ($query_insert) {
        $alert = '<p class="msg_save">CREADO CORRECTAMENTE</p>';
    } else {
        
        $alert = '<p class="msg_error">Error al Registra GRUPO</p>' ;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Grupo</title>
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
            <h1 style="text-align: center">Registro de Grupo</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form action="" method="POST">

            <label for="nombregrupo">Nombre Grupo</label>
                <input type="text" name="nombregrupo" id="nombregrupo" placeholder="Ingrese nombre del Grupo" required>


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
                <br>
                <a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 132px; background-color: #36A152; border-radius: 6px;" class="btn_save1" href="lista_grupo_auditor.php">Regresar</a> 
                <input type="submit" value="Registrar" class="btn_save">
            </form>
        </div>
    </section>
    </script>
</body>
</html>