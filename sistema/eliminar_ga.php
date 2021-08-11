<?php
session_start();

if ($_SESSION['rol'] != 1) {
    header("location: ./");
}

include "../conexion.php";
if (!empty($_POST)) {
    $codigo = $_POST['iddetallegrupo'];
    $query_delete = mysqli_query($conection, "DELETE FROM detallegrupo WHERE iddetallegrupo = $codigo");
    mysqli_close($conection);
    if ($query_delete) {
        header("location: listadetallegrupo.php");
    } else {
        echo "Error al eliminar Proceso";
    }
}
if (empty($_REQUEST['id'])) {
    header("location: listadetallegrupo.php");
    mysqli_close($conection);
} else {
    $codigo = $_REQUEST['id'];
    $sql = mysqli_query($conection, "SELECT * FROM detallegrupo WHERE iddetallegrupo= $codigo");
    mysqli_close($conection);
    $result = mysqli_num_rows($sql);
    if ($result > 0) {
        while ($data = mysqli_fetch_array($sql)) {
            $id_user = $data[0];
            $id_grupo = $data[1];
            $actividadrealizada = $data[3];
            $codigo  = $data[4];
           
        }
    } else {
        header('Location: listadetallegrupo.php');
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
            <p>ID Usuario: <span><?php echo $id_user; ?></span></p>
            <p>ID grupo: <span><?php echo $id_grupo; ?></span></p>
            <p>Actividad Realizada: <span><?php echo $actividadrealizada; ?></span></p>
            <p>Id detalle auditoria: <span><?php echo $codigo; ?></span></p>
          
           
            <form method="POST" action="">
                <input type="hidden" name="iddetallegrupo" value="<?php echo  $codigo; ?>">
                <a style="border: 2px solid #2e518b; padding: 10px 132px; color: #ffffff; background-color: #1883ba; border-radius: 6px;" href="listadetallegrupo.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>
        </div>
    </section>
</body>
</html>