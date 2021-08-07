<?php
session_start();
 if ($_SESSION['rol'] != 1) {
    header("location: ./");
}

include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';


    $nombreproceso= $_POST['nombreproceso'];
    $liderproceso =$_POST['liderproceso']; //valor del select que trae datos de la tabla usuario

    $query = mysqli_query($conection, "SELECT * FROM procesos WHERE  nombreproceso='$nombreproceso' ");
    $result = mysqli_fetch_array($query);
    
    if ($result > 0) {
        $alert = '<p class="msg_error">Proceso YA existe !Intente de Nuevo con otro Proceso</p>';
    } else {
        $query_insert = mysqli_query($conection, "INSERT INTO procesos (nombreproceso,liderproceso) VALUES 
        ('$nombreproceso','$liderproceso')");
    
        if ($query_insert) {
            $alert = '<p class="msg_save">CREADO CORRECTAMENTE</p>';
        } else {
            
            $alert = '<p class="msg_error">Error al Registra Proceso</p>' ;
        }
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Registro de Procesos</title>
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
            <h1 style="text-align: center">Registro de Procesos</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form action="" method="POST">

            <label for="nombreproceso">Nombre Proceso</label>
                <input type="text" name="nombreproceso" id="nombreproceso" placeholder="Ingrese nombre del Proceso" required>
                <label for="liderproceso">Lider del Proceso</label>
                <?php

                $query_id_user= mysqli_query($conection, "SELECT * FROM usuario WHERE rol=3");
                // mysqli_close($conection);
                $result_id_user = mysqli_num_rows($query_id_user);
                ?>
                <select name="liderproceso" id="liderproceso">
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
                <input type="submit" value="Registrar" class="btn_save">
            </form>
        </div>
    </section>
    <script>
        
        $(document).ready(function() {
            $('#liderproceso').select2();
        });
    </script>

</body>
</html>