<?php
session_start();
if ($_SESSION['rol'] != 2) {
    header("location: ./");
}
include "../conexion.php";

$cadena="";

$iddetalleclausula = $_REQUEST['id'];
$iddetalleauditoria = $_REQUEST['da'];


if (!empty($_POST)) {

    $id_anexo = $_POST['idanexo'];
    $nombre=$_POST['nombre'];
    $anexo=$_POST['anexo'];

        $query_update = mysqli_query($conection, "UPDATE anexo SET nombre='$nombre', anexo='$anexo' WHERE idanexo=$id_anexo");
        if ($query_update) {
            $alert = '<p class="msg_save">Anexo Actualizado </p>';
        } else {
            $alert = '<p class="msg_error">Error al Actualizar </p>';
        }
    }



if (empty($_REQUEST['ida'])) {
    $cadena="lista_anexo.php?id=".$iddetalleclausula."&da=".$iddetalleauditoria;
    header("location:".$cadena);
    mysqli_close($conection);
}

$id_anexo = $_REQUEST['ida'];
$sql = mysqli_query($conection, "SELECT * FROM anexo WHERE idanexo=$id_anexo");

mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    $cadena="lista_anexo.php?id=".$iddetalleclausula."&da=".$iddetalleauditoria;
    header("location:".$cadena);
} else {

    $option = '';
    while ($data = mysqli_fetch_array($sql)) {
        $id_anexo = $data['idanexo'];
        $nombre = $data['nombre'];
        $anexo = $data['anexo'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar Anexo</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <h1 style="text-align: center">Actualizar Anexo</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="POST">
                <input type="hidden" name="idanexo" value="<?php echo $id_anexo; ?>">
                <label for="nombre">Nombre Anexo</label>
                <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre de anexo" required value="<?php echo $nombre; ?>">
                <label for="nombre">URL Anexo</label>
                <input type="text" name="anexo" id="anexo" placeholder="Ingrese url de anexo" required value="<?php echo $anexo; ?>"> 
                <br>
                <a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 132px; background-color: #36A152; border-radius: 6px;" class="btn_save1" href="lista_anexo.php?id=<?php echo $iddetalleclausula ?>&da=<?php echo $iddetalleauditoria ?>">Regresar</a> 
                <input type="submit" value="Actualizar" class="btn_save">
            </form>
        </div>
    </section>
</body>

</html>