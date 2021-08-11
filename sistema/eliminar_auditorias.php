<?php
session_start();

if ($_SESSION['rol'] != 1) {
    header("location: ./");
}

include "../conexion.php";
if (!empty($_POST)) {
    $codigo = $_POST['iddetalleauditoria'];
    $query_delete = mysqli_query($conection, "DELETE FROM detalleauditoria WHERE iddetalleauditoria = $codigo");
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
    $codigo = $_REQUEST['id'];
    $sql = mysqli_query($conection, "SELECT * FROM detalleauditoria WHERE iddetalleauditoria= $codigo");
    mysqli_close($conection);
    $result = mysqli_num_rows($sql);
    if ($result > 0) {
        while ($data = mysqli_fetch_array($sql)) {
            $iddetalleauditoria = $data[0];
            $codigoauditoria = $data[1];
            $idperiodo = $data[2];
            $fechaejecucion    = $data[3];
            $idgrupo  = $data[4];
            $fechacreacion = $data[5];
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
            <p>ID detalle auditoria: <span><?php echo $iddetalleauditoria; ?></span></p>
            <p>Código de auditoria: <span><?php echo $codigoauditoria; ?></span></p>
            <?php if ($idperiodo==1){?>
            <p>Periodo: <span><?php echo '4 meses'; ?></span></p>
            <?php } else if ($idperiodo==2) { ?>
            <p>Periodo: <span><?php echo '6 meses'; ?></span></p>
            <?php } else  if ($idperiodo==3) { ?>
            <p>Periodo: <span><?php echo '12 meses'; ?></span></p>
            <?php }?>
            <p>Fecha de creación: <span><?php echo $fechacreacion; ?></span></p>
            <p>Fecha de ejecucipon: <span><?php echo $fechaejecucion; ?></span></p>
            <p>ID grupo: <span><?php echo $idgrupo; ?></span></p>
           
            <form method="POST" action="">
                <input type="hidden" name="iddetalleauditoria" value="<?php echo  $codigo; ?>">
                <a style="border: 2px solid #2e518b; padding: 10px 132px; color: #ffffff; background-color: #1883ba; border-radius: 6px;" href="lista_detalleauditoria.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>
        </div>
    </section>
</body>
</html>