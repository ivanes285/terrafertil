<?php
session_start();
if ($_SESSION['rol'] != 2) {
    header("location: ./");
}

include "../conexion.php";

if (!empty($_POST)) {
    $alert = '';
    $id_pedido = $_POST['id_pedido'];
   
    $id_pastel = $_POST['pastel'];
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombres'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['date'];


    $query = mysqli_query($conection, "SELECT * FROM pedidos WHERE  id_pedido= $id_pedido)");
    $result = mysqli_fetch_array($query);

    if ($result > 0) {
        $alert = '<p class="msg_error">Pedido YA existe !Intente de Nuevo</p>';
    } else {
            $query_update = mysqli_query($conection, "UPDATE pedidos SET id_pastel='$id_pastel', cedula=$cedula, nombre='$nombre', cantidad=$cantidad, fecha= '$fecha' WHERE id_pedido=$id_pedido");

        if ($query_update) {
            $alert = '<p class="msg_save">PEDIDO Actualizado </p>';
        } else {
            $alert = '<p class="msg_error">Error al Actualizar </p>';
        }
    }
}

/*********************************************/

            if (empty($_REQUEST['id'])) {
                header('Location: listar_pedidos.php');
                mysqli_close($conection);
            }
            $id_pedido = $_REQUEST['id'];
            $sql = mysqli_query($conection, "SELECT * FROM pedidos WHERE id_pedido=$id_pedido");

            mysqli_close($conection);
            $result_sql= mysqli_num_rows($sql);
         if($result_sql==0){
                header('Location: listar_pedidos.php');
            }else{
                $option='';
                while($data=mysqli_fetch_array($sql)){
                $id_pedido= $data['id_pedido'];
                $id_pastel=$data['id_pastel'];
                $cedula= $data['cedula'];
                $nombre= $data['nombre'];
                $cantidad= $data['cantidad'];
                $fecha= $data['fecha'];
                
                }
                
           }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar pedido</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">

        <div class="form_register">
            <h1 style="text-align: center">Actualizar pedidos</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form action="" method="POST">

                <input type="hidden" name="id_pedido" value="<?php echo $id_pedido; ?>">
                <?php
                include "../conexion.php";
                $query_pastel= mysqli_query($conection,"SELECT * FROM pastel");
                mysqli_close($conection);
                $result_rol= mysqli_num_rows($query_pastel);
                ?>
                <label for="rol">Pastel</label>

                <select name="pastel" id="pastel">
                <?php

                while($pastel=mysqli_fetch_array($query_pastel)){
                 ?>

                 <option value="<?php echo $pastel["id_pastel"]; ?>"><?php echo $pastel['nombre'];?></option>
                 <?php
                    }
                 
                ?>
                </select>
                <label for="user">Cedula</label>
                <input type="number" name="cedula" id="cedula" placeholder="Ingrese su nombre" required value="<?php echo $cedula; ?>">


                <label for="user">Nombre</label>
                <input type="text" name="nombres" id="nombres" placeholder="Ingrese su nombre" required value="<?php echo $nombre; ?>">

                <label for="user">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" placeholder="Ingrese su nombre" required value="<?php echo $cantidad; ?>">

                <label for="cedula">Fecha</label>

                <input type="text" name="date" id="date" value="<?php echo $fecha;?>">

                <a href="listar_pedidos.php" class="btn_cancel">Cancelar</a>

                <input type="submit" value="Actualizar" class="btn_save">

            </form>
        </div>

    </section>
    <script>
        $(function() {
            $("#date").datepicker({

                dateFormat: "yy-mm-dd"
            });

        });
    </script>

</body>

</html>