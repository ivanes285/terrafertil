<?php
session_start();

if ($_SESSION['rol'] != 3) {
    header("location: ./");
}
$cadena="";
$idanexopropuesta = $_REQUEST['idx'];
$idaccionpropuesta = $_REQUEST['idap'];
$idplanaccion = $_REQUEST['idpa'];
$iddetalleclausula = $_REQUEST['id'];
$iddetalleauditoria = $_REQUEST['ida'];  
$cadena="lista_anexoauditado.php?idap=".$idaccionpropuesta."&idpa=".$idplanaccion."&id=".$iddetalleclausula."&ida=".$iddetalleauditoria;

include "../conexion.php";
if (!empty($_POST)) {
    $query_delete = mysqli_query($conection, "DELETE FROM anexopropuestas WHERE idanexopropuesta = $idanexopropuesta");

    mysqli_close($conection);
    if ($query_delete) {
        header("location:".$cadena);
    } else {
        echo "Error al eliminar Anexo";
    }
}
if (empty($_REQUEST['idx'])) {
    header("location:".$cadena);
    mysqli_close($conection);
} else {
    $ididanexopropuesta = $_REQUEST['idx'];
    $sql = mysqli_query($conection, "SELECT * from anexopropuestas Where idanexopropuesta = $idanexopropuesta");
    mysqli_close($conection);
    $result = mysqli_num_rows($sql);
    if ($result > 0) {
        while ($data = mysqli_fetch_array($sql)) {
            $idanexopropuesta = $data[0];
            $nombre = $data[2];
            $anexo = $data[3];
        }
   
    } else {
        header("location:".$cadena);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Eliminar Anexo</title>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="data_delete">
            <h2 style="color: #C82333">¿Está seguro de eliminar el anexo?</h2>
            <p>ID Anexo: <span><?php echo $idanexopropuesta; ?></span></p>
            <p>Nombre Anexo: <span><?php echo $nombre; ?></span></p>
            <p>Url Anexo: <span><?php echo $anexo; ?></span></p>
            <form method="POST" action="">
                <input type="hidden" name="idanexo" value="<?php echo  $id_anexo; ?>">
                <center><a style="border: 2px solid #2e518b;  color: #ffffff; background-color: #1883ba;" href="lista_anexoauditado.php?idap=<?php echo $idaccionpropuesta ?>&idpa=<?php echo $idplanaccion ?>&id=<?php echo $iddetalleclausula ?>&ida=<?php echo $iddetalleauditoria ?>" class="btn_cancel">Regresar</a> </center>
                <input type="submit" style="border: 2px solid #2e518b;  color: #ffffff; background-color: #04B404; font-size: 17px;" value="Aceptar" class="btn_ok">
         
            </form>
        </div>
    </section>
</body>
</html>