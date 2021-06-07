<?php
session_start();
// if ($_SESSION['rol'] != 1) {
//     header("location: ./");
// }
include "../conexion.php";

if (!empty($_POST)) {
    $alert = '';

    $id_user = $_SESSION['id_user'];

    $id_pastel = $_POST['pastel'];
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombres'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['date'];

    $query_insert = mysqli_query($conection, "INSERT INTO pedidos (id_user,id_pastel,cedula,nombre,cantidad,fecha) VALUES 
    ($id_user,$id_pastel,'$cedula','$nombre',$cantidad,'$fecha')");

    if ($query_insert) {
        $alert = '<p class="msg_save">CREADO CORRECTAMENTE</p>';
    } else {
        echo $fecha;
        
        $alert = '<p class="msg_error">Error al registrar pedido</p>' ;
    }
}
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Registro de pedidos</title>
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
            <h1 style="text-align: center">Registro de Pedidos</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form action="" method="POST">

                <label for="rol">Pastel</label>

                <?php

                $query_id_pastel = mysqli_query($conection, "SELECT * FROM pastel ");
                // mysqli_close($conection);
                $result_id_pastel = mysqli_num_rows($query_id_pastel);
                ?>

                <select name="pastel" id="pastel">
                    <?php
                    if ($result_id_pastel > 0) {
                        while ($pastel = mysqli_fetch_array($query_id_pastel)) {
                    ?>
                            <option value="<?php echo $pastel["id_pastel"]; ?>"><?php echo $pastel["nombre"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>

                <label for="cedula">Cedula</label>
                <input type="number" name="cedula" id="cedula" placeholder="cedula cliente " required>

                <label for="cedula">Nombres</label>
                <input type="text" name="nombres" id="nombres" placeholder="Nombres del  cliente " required>

                <label for="cedula">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" placeholder="cedula cliente " required>

                <label for="cedula">Fecha</label>

                <input type="text" name="date" id="date">


                <input type="submit" value="Registrar" class="btn_save">
            </form>
        </div>

    </section>

    <script>
        $(function() {
            $("#date").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 0 
            });
        });

$(document).ready(function(){
$('#pastel').select2();
});

    </script>
    
</body>
</html>