<?php
session_start();
if ($_SESSION['rol'] != 2) {
    header("location: ./");
}
include "../conexion.php";

if (!empty($_POST)) {

    $iddetalleclausula = $_POST['iddetalleclausula'];
    $nombre = $_POST['nombre'];
    $anexo = $_POST['anexo'];
    $query_insert = mysqli_query($conection, "INSERT INTO anexo (iddetalleclausula,nombre,anexo) VALUES ('$iddetalleclausula','$nombre','$anexo')");
    if ($query_insert) {
        $alert = '<p class="msg_save">Anexo Guardado Correctamente</p>';
    } else {
        $alert = '<p class="msg_error">Error al Guardar el Anexo</p>';
    }
}

if (empty($_REQUEST['id'])) {
    header('Location: formulario_clausulas.php');
    mysqli_close($conection);
}

$iddetalleclausula = $_REQUEST['id'];
$iddetalleauditoria = $_REQUEST['da'];

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
               <input type="hidden" name="iddetalleclausula" value="<?php echo $iddetalleclausula;?>"> 
                <label for="user">Nombre Anexo</label>
                <input type="text" name="nombre"  placeholder="Ingrese el nombre del anexo" required>

                <label for="user">Anexo URL</label>
                <input type="text" name="anexo"  placeholder="Ingrese la dirección del anexo" required>
                
                <br>
                <a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 132px; background-color: #36A152; border-radius: 6px;" class="btn_save1" href="lista_anexo.php?id=<?php echo $iddetalleclausula ?>&da=<?php echo $iddetalleauditoria?>">Regresar</a> 
                  <input type="submit" value="Guardar Anexo" class="btn_save">

            </form>
        </div>

    </section>

</body>

</html>