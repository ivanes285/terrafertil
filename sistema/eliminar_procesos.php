<?php
session_start();

if ($_SESSION['rol'] != 1) {
    header("location: ./");
}

include "../conexion.php";
if (!empty($_POST)) {
    $id_pedido = $_POST['idproceso'];
    $query_delete = mysqli_query($conection, "DELETE FROM procesos WHERE idproceso = $id_pedido");
    mysqli_close($conection);
    if ($query_delete) {
        header("location: listar_procesos.php");
    } else {
        echo "Error al eliminar Proceso";
    }
}
if (empty($_REQUEST['id'])) {
    header("location: listar_procesos.php");
    mysqli_close($conection);
} else {
    $idproceso = $_REQUEST['id'];
    $sql = mysqli_query($conection, "SELECT * FROM procesos WHERE idproceso=  $idproceso");
    mysqli_close($conection);
    $result = mysqli_num_rows($sql);
    if ($result > 0) {
        while ($data = mysqli_fetch_array($sql)) {
            $idproceso = $data[0];
            $nombreproceso = $data[1];
            $liderproceso = $data[2];
        }
    } else {
        header('Location: listar_procesos.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Eliminar Procesos</title>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="data_delete">
            <h2 style="color: #C82333">¿Está seguro de eliminar el proceso?</h2>
            <p>ID proceso: <span><?php echo $idproceso; ?></span></p>
            <p>Nombre proceso: <span><?php echo $nombreproceso; ?></span></p>
            <p>Lider Proceso: <span><?php echo $nombreproceso; ?></span></p>
            <form method="POST" action="">
                <input type="hidden" name="idproceso" value="<?php echo  $idproceso; ?>">
                <a href="listar_procesos.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>
        </div>
    </section>
</body>
</html>