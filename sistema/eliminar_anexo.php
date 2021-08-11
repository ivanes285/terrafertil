<?php
session_start();

if ($_SESSION['rol'] != 2) {
    header("location: ./");
}
$cadena="";

$iddetalleclausula = $_REQUEST['id'];
$iddetalleauditoria = $_REQUEST['da'];

include "../conexion.php";
if (!empty($_POST)) {

    $cadena="lista_anexo.php?id=".$iddetalleclausula."&da=".$iddetalleauditoria;
    $id_anexo = $_POST['idanexo'];

    $query_delete = mysqli_query($conection, "DELETE FROM anexo WHERE idanexo = $id_anexo");
    
    mysqli_close($conection);
    if ($query_delete) {
        header("location:".$cadena);
    } else {
        echo "Error al eliminar Anexo";
    }
}
if (empty($_REQUEST['ida'])) {
    $cadena="lista_anexo.php?id=".$iddetalleclausula."&da=".$iddetalleauditoria;
    
    header("location:".$cadena);
    mysqli_close($conection);
} else {
    $id_anexo = $_REQUEST['ida'];
    $sql = mysqli_query($conection, "SELECT * from anexo Where idanexo = $id_anexo");
    mysqli_close($conection);
    $result = mysqli_num_rows($sql);
    if ($result > 0) {
        while ($data = mysqli_fetch_array($sql)) {
            $id_anexo = $data[0];
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
            <p>ID Anexo: <span><?php echo $id_anexo; ?></span></p>
            <p>Nombre Anexo: <span><?php echo $nombre; ?></span></p>
            <p>Url Anexo: <span><?php echo $anexo; ?></span></p>
            <form method="POST" action="">
                <input type="hidden" name="idanexo" value="<?php echo  $id_anexo; ?>">
                <a style="border: 2px solid #2e518b; padding: 10px 132px; color: #ffffff; background-color: #1883ba; border-radius: 6px;" href=" lista_anexo.php?id=<?php echo $iddetalleclausula ?>&da=<?php echo $iddetalleauditoria ?>" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
         
            </form>
        </div>
    </section>
</body>
</html>