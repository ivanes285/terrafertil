<?php
session_start();
if ($_SESSION['rol'] != 3) {
    header("location: ./");
}
include "../conexion.php";

$idaccionpropuesta = $_REQUEST['idap'];
$idplanaccion = $_REQUEST['idpa'];
$iddetalleclausula = $_REQUEST['id'];
$iddetalleauditoria = $_REQUEST['ida'];
$estado = $_REQUEST['es'];

if (!empty($_POST)) {
    $idaccionpropuesta = $_POST['idaccionpropuesta'];
    $nombre = $_POST['nombre'];
    $anexo = $_POST['anexo'];
    $query_insert = mysqli_query($conection, "INSERT INTO anexopropuestas (idaccionpropuesta,nombre,anexo) VALUES ('$idaccionpropuesta','$nombre','$anexo')");
    if ($query_insert) {
        $alert = '<p class="msg_save">Anexo Guardado Correctamente</p>';
    } else {
        $alert = '<p class="msg_error">Error al Guardar el Anexo</p>';
    }
}

if (empty($_REQUEST['idap'])) {
    header('Location: formulario_clausulas.php');
    mysqli_close($conection);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Registro de Anexos</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">

        <div class="form_register">
            <h1 style="text-align: center">Registro de Anexos</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form action="" method="POST">
                <input type="hidden" name="idaccionpropuesta" value="<?php echo $idaccionpropuesta; ?>">
                <label for="user">Nombre Anexo</label>
                <input type="text" name="nombre" placeholder="Ingrese el nombre del anexo" required>

                <label for="user">Anexo URL</label>
                <input type="text" name="anexo" placeholder="Ingrese la dirección del anexo (Debe incluir: https://)" required>

                <br />
                <br />
                <a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 132px; background-color: #36A152; border-radius: 6px;" class="btn_save1" href="lista_anexoauditado.php?idap=<?php echo $idaccionpropuesta ?>&idpa=<?php echo $idplanaccion ?>&id=<?php echo $iddetalleclausula ?>&ida=<?php echo $iddetalleauditoria ?>&es=<?php echo $estado?>">Regresar</a>
                <input type="submit" value="Guardar Anexo" class="btn_save">
            </form>
        </div>

    </section>

</body>

</html>