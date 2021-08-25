<?php
session_start();
if ($_SESSION['rol'] != 3) {
    header("location: ./");
}
include "../conexion.php";
$cadena="";
$idaccionpropuesta = $_REQUEST['idap'];
$idplanaccion = $_REQUEST['idpa'];
$iddetalleclausula = $_REQUEST['id'];
$iddetalleauditoria = $_REQUEST['ida'];  
$cadena="lista_anexoauditado.php?idap=".$idaccionpropuesta."&idpa=".$idplanaccion."&id=".$iddetalleclausula."&ida=".$iddetalleauditoria;

if (!empty($_POST)) {

    $idanexopropuesta = $_POST['idanexopropuesta'];
    $nombre=$_POST['nombre'];
    $anexo=$_POST['anexo'];

        $query_update = mysqli_query($conection, "UPDATE anexopropuestas SET nombre='$nombre', anexo='$anexo' WHERE idanexopropuesta=$idanexopropuesta");
        if ($query_update) {
            $alert = '<p class="msg_save">Anexo Actualizado </p>';
        } else {
            $alert = '<p class="msg_error">Error al Actualizar </p>';
        }
    }



if (empty($_REQUEST['idx'])) {
    $cadena="lista_anexoauditado.php?idap=".$idaccionpropuesta."&idpa=".$idplanaccion."&id=".$iddetalleclausula."&ida=".$iddetalleauditoria;
    header("location:".$cadena);
    mysqli_close($conection);
}

$idanexopropuesta = $_REQUEST['idx'];
$sql = mysqli_query($conection, "SELECT * FROM anexopropuestas  WHERE idanexopropuesta=$idanexopropuesta");

mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    $cadena="lista_anexoauditado.php?idap=".$idaccionpropuesta."&idpa=".$idplanaccion."&id=".$iddetalleclausula."&ida=".$iddetalleauditoria;
    header("location:".$cadena);
} else {

    $option = '';
    while ($data = mysqli_fetch_array($sql)) {
        $idanexopropuesta = $data[0];
        $nombre = $data[2];
        $anexo = $data[3];
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
                <input type="hidden" name="idanexopropuesta" value="<?php echo $idanexopropuesta; ?>">
                <label for="nombre">Nombre Anexo</label>
                <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre de anexo" required value="<?php echo $nombre; ?>">
                <label for="nombre">URL Anexo</label>
                <input type="text" name="anexo" id="anexo" placeholder="Ingrese url de anexo" required value="<?php echo $anexo; ?>">
                
                <center><a style="border: 2px solid #2e518b;  color: #ffffff; background-color: #1883ba;" href="lista_anexoauditado.php?idap=<?php echo $idaccionpropuesta ?>&idpa=<?php echo $idplanaccion ?>&id=<?php echo $iddetalleclausula ?>&ida=<?php echo $iddetalleauditoria ?>" class="btn_cancel">Regresar</a> </center>
                <input type="submit" value="Actualizar" class="btn_save">
            </form>
        </div>
    </section>
</body>

</html>