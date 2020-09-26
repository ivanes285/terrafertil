<?php
session_start();

if ($_SESSION['rol'] != 1) {
    header("location: ./");
}
include "../conexion.php";

if (!empty($_POST)) {

    $id_pedido = $_POST['id_pedido'];

    $query_delete = mysqli_query($conection, "DELETE FROM pedidos WHERE id_pedido = $id_pedido");
    mysqli_close($conection);
    if ($query_delete) {
        header("location: listar_pedidos.php");
    } else {
        echo "Error al eliminar Pedido";
    }
}


if (empty($_REQUEST['id'])) {
    header("location: listar_pedidos.php");
    mysqli_close($conection);
} else {

    $id_pedido = $_REQUEST['id'];
    $sql = mysqli_query($conection, "SELECT * FROM pedidos WHERE id_pedido= $id_pedido");
    mysqli_close($conection);
    $result = mysqli_num_rows($sql);

    if ($result > 0) {

        while ($data = mysqli_fetch_array($sql)) {
            $id_pedido = $data['id_pedido'];
            $id_pastel = $data['id_pastel'];
            $nombre = $data['nombre'];
           
        }
    } else {
        header('Location: listar_pedidos.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Eliminar Pasteles</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="data_delete">
            <h2 style="color: #C82333">¿Está seguro de eliminar el pedido?</h2>
            <p>Nombre pastel: <span><?php echo $nombre; ?></span></p>
            
            <form method="POST" action="">
                <input type="hidden" name="id_pedido" value="<?php echo $id_pedido; ?>">
                <a href="listar_pedidos.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>
        </div>
    </section>
    

</body>

</html>