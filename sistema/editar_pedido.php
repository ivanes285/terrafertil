<?php
session_start();
if ($_SESSION['rol'] != 2) {
    header("location: ./");
}

include "../conexion.php";

if (!empty($_POST)) {
    $alert = '';
    $id_pedido = $_POST['id'];
   
    $id_pastel = $_POST['pastel'];
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombres'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['date'];


    $query = mysqli_query($conection, "SELECT * FROM pedidos WHERE  id_pedido)");
    $result = mysqli_fetch_array($query);

    if ($result > 0) {
        $alert = '<p class="msg_error">usuario YA existe !Intente de Nuevo</p>';
    } else {
        if (empty($_POST['password'])) {
            $query_update = mysqli_query($conection, "UPDATE usuario SET user='$usuario', rol='$rol' WHERE id_user=$idusuario");
        } else {

            $query_update = mysqli_query($conection, "UPDATE usuario SET user='$usuario', password='$clave', rol='$rol' 
              WHERE id_user= $idusuario");
        }

        if ($query_update) {
            $alert = '<p class="msg_save">PEDIDO Actualizado </p>';
        } else {
            $alert = '<p class="msg_error">Error al Actualizar </p>';
        }
    }
}

/*********************************************/

            // if (empty($_REQUEST['id'])) {
            //     header('Location: listar_pedidos.php');
            //     mysqli_close($conection);
            // }
            // $iduser = $_REQUEST['id'];
            // $sql = mysqli_query($conection, "SELECT u.id_user,u.user,(u.rol) AS idrol,
            //         (r.rol) AS rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE id_user= $iduser AND estatus=1");
            // mysqli_close($conection);
            // $result_sql = mysqli_num_rows($sql);
            // if ($result_sql == 0) {
            //     header('Location: lista_usuario.php');
            // } else {
            //     $option = '';
            //     while ($data = mysqli_fetch_array($sql)) {
            //         $idusuario = $data['id_user'];
            //         $usuario = $data['user'];
            //         $idrol = $data['idrol'];
            //         $rol = $data['rol'];

            //         if ($idrol == 1) {
            //             $option = '<option value="' . $idrol . '" select>' . $rol . '</option>';
            //         } else if ($idrol == 2) {
            //             $option = '<option value="' . $idrol . '" select >' . $rol . '</option>';
            //         }
            //     }
            // }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar pedido</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">

        <div class="form_register">
            <h1 style="text-align: center">Actualizar pedidos</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form action="" method="POST">

                <input type="hidden" name="id" value="<?php echo $idusuario; ?>">

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

                <label for="user">Cedula</label>
                <input type="number" name="user" id="user" placeholder="Ingrese su nombre" required value="<?php echo $cedula; ?>">


                <label for="user">Nombre</label>
                <input type="text" name="user" id="user" placeholder="Ingrese su nombre" required value="<?php echo $usuario; ?>">

                <label for="user">Cantidad</label>
                <input type="number" name="user" id="user" placeholder="Ingrese su nombre" required value="<?php echo $cantidad; ?>">

                <label for="cedula">Fecha</label>

                <input type="text" name="date" id="date" value="<?php echo $fecha;?>">


                <?php
                include "../conexion.php";
                $query_rol = mysqli_query($conection, "SELECT * FROM rol");
                mysqli_close($conection);
                $result_rol = mysqli_num_rows($query_rol);
                ?>

                <label for="rol">Rol</label>
                <select name="rol" id="rol" class="noItemOne">
                    <?php
                    echo $option;
                    if ($result_rol > 0) {
                        while ($rol = mysqli_fetch_array($query_rol)) {
                    ?>
                            <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?></option>
                    <?php
                        }
                    }
                    ?>

                </select>
                <input type="submit" value="Actualizar Usuario" class="btn_save">

            </form>
        </div>

    </section>

</body>

</html>