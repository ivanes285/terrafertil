<?php
session_start();
include "../conexion.php";


if (!empty($_POST)) {
    $alert = '';
    $idgrupo = $_POST['idgrupo'];
    $nombregrupo = $_POST['nombregrupo'];
 
    $query = mysqli_query($conection, "SELECT * FROM grupoauditor WHERE  nombregrupo='$nombregrupo' ");
    $result = mysqli_fetch_array($query);
    if ($result > 0) {
        $alert = '<p class="msg_error">Proceso YA existe !Intente de Nuevo con otro Proceso</p>';
    } else {
        $query_update = mysqli_query($conection, "UPDATE grupoauditor SET nombregrupo='$nombregrupo' WHERE idgrupo=$idgrupo");
        if ($query_update) {
            $alert = '<p class="msg_save">Grupo Actualizado </p>';
        } else {
            $alert = '<p class="msg_error">Error al Actualizar </p>';
        }
    }
}


if (empty($_REQUEST['id'])) {
    header('Location: lista_grupo_auditor.php');
    mysqli_close($conection);
}

$idgrupo = $_REQUEST['id'];
$sql = mysqli_query($conection, "SELECT * FROM grupoauditor WHERE idgrupo=$idgrupo");

mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header('Location: lista_grupo_auditor.php');
} else {
    
    $option = '';
    while ($data = mysqli_fetch_array($sql)) {
        $idgrupo = $data['idgrupo'];
        $nombregrupo = $data['nombregrupo'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar Grupo Auditor</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <h1 style="text-align: center">Actualizar Grupo Auditor</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="POST">
                <input type="hidden" name="idgrupo" value="<?php echo $idgrupo; ?>">
                <label for="nombregrupo ">Nombre Grupo</label>
                <input type="text" name="nombregrupo" id="nombregrupo" placeholder="Ingrese nombre del Grupo" required value="<?php echo $nombregrupo; ?>">
                <a href="lista_grupo_auditor.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Actualizar" class="btn_save">   
            </form>
        </div>
    </section>
</body>

</html>