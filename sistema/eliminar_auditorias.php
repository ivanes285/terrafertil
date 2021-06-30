<?php
session_start();

if ($_SESSION['rol'] != 1) {
    header("location: ./");
}

include "../conexion.php";
if (!empty($_POST)) {
    $codigoauditoria = $_POST['codigoauditoria'];
    $query_delete = mysqli_query($conection, "DELETE FROM detalleauditoria WHERE codigoauditoria = $codigoauditoria");
    mysqli_close($conection);
    if ($query_delete) {
        header("location: lista_detalleauditoria.php");
    } else {
        echo "Error al eliminar Proceso";
    }
}
if (empty($_REQUEST['id'])) {
    header("location: lista_detalleauditoria.php");
    mysqli_close($conection);
} else {
    $codigoauditoria = $_REQUEST['id'];
    $sql = mysqli_query($conection, "SELECT * FROM detalleauditoria WHERE codigoauditoria= $codigoauditoria");
    mysqli_close($conection);
    $result = mysqli_num_rows($sql);
    if ($result > 0) {
        while ($data = mysqli_fetch_array($sql)) {
            $iddetalleauditoria = $data[0];
            $codigoauditoria = $data[1];
            $idperiodo = $data[2];
            $fechacreacion  = $data[3];
            $fechaejecucion = $data[4];
            $codigoauditoria = $data[5];
        }
    } else {
        header('Location: lista_detalleauditoria.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Eliminar Auditorias</title>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="data_delete">
            <h2 style="color: #C82333">¿Está seguro de eliminar la auditoria?</h2>
            <p>ID grupo: <span><?php echo $iddetalleauditoria; ?></span></p>
            <p>ID grupo: <span><?php echo $codigoauditoria; ?></span></p>
            <p>ID grupo: <span><?php echo $idperiodo; ?></span></p>
            <p>ID grupo: <span><?php echo $fechacreacion; ?></span></p>
            <p>ID grupo: <span><?php echo $fechaejecucion; ?></span></p>
            <p>ID grupo: <span><?php echo $codigoauditoria; ?></span></p>
           
            <form method="POST" action="">
                <input type="hidden" name="codigoauditoria" value="<?php echo  $codigoauditoria; ?>">
                <a href="lista_detalleauditoria.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>
        </div>
    </section>
</body>
</html>