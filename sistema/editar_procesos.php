<?php
session_start();
include "../conexion.php";


if (!empty($_POST)) {
    $alert = '';
    $idproceso = $_POST['idproceso'];
    $nombreproceso = $_POST['nombreproceso'];
    $liderproceso = $_POST['liderproceso'];
   
        $query_update = mysqli_query($conection, "UPDATE procesos SET nombreproceso='$nombreproceso', liderproceso='$liderproceso' WHERE idproceso=$idproceso");
        if ($query_update) {
            $alert = '<p class="msg_save">PROCESO Actualizado </p>';
        } else {
            $alert = '<p class="msg_error">Error al Actualizar </p>';
        }
    }



if (empty($_REQUEST['id'])) {
    header('Location: listar_procesos.php');
    mysqli_close($conection);
}

$idproceso = $_REQUEST['id'];
$sql = mysqli_query($conection, "SELECT * FROM procesos WHERE idproceso=$idproceso");

mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header('Location: listar_procesos.php');
} else {
    
    $option = '';
    while ($data = mysqli_fetch_array($sql)) {
        $idproceso = $data['idproceso'];
        $nombreproceso = $data['nombreproceso'];
        $liderproceso = $data['liderproceso'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar Proceso</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <h1 style="text-align: center">Actualizar Proceso</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="POST">
                <input type="hidden" name="idproceso" value="<?php echo $idproceso; ?>">
                <label for="nombreproceso ">Nombre Proceso</label>
                <input type="text" name="nombreproceso" id="nombreproceso" placeholder="Ingrese nombre del Proceso" required value="<?php echo $nombreproceso; ?>">
                <?php
                include "../conexion.php";
                $query_pastel = mysqli_query($conection, "SELECT * FROM usuario WHERE rol=3");
                mysqli_close($conection);
                $result_rol = mysqli_num_rows($query_pastel);
                ?>
                <label for="liderproceso">Lider Proceso</label>
                <select name="liderproceso" id="liderproceso">
                    <?php
                    while ($pastel = mysqli_fetch_array($query_pastel)) {
                    ?>
                        <option value="<?php echo $pastel["id_user"]; ?>"><?php echo $pastel['user']; ?></option>
                    <?php
                    }
                    ?>
                </select>
                <a href="listar_procesos.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Actualizar" class="btn_save">
            </form>
        </div>
    </section>
</body>

</html>