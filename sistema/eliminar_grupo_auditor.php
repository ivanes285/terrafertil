<?php
session_start();

if ($_SESSION['rol'] != 1) {
    header("location: ./");
}

include "../conexion.php";
if (!empty($_POST)) {
    $idgrupo = $_POST['idgrupo'];
    $query_delete = mysqli_query($conection, "DELETE FROM grupoauditor WHERE idgrupo = $idgrupo");
    mysqli_close($conection);
    if ($query_delete) {
        header("location: lista_grupo_auditor.php");
    } else {
        echo "Error al eliminar Proceso";
    }
}
if (empty($_REQUEST['id'])) {
    header("location: lista_grupo_auditor.php");
    mysqli_close($conection);
} else {
    $idgrupo = $_REQUEST['id'];
    $sql = mysqli_query($conection, "SELECT * FROM grupoauditor WHERE idgrupo= $idgrupo");
    mysqli_close($conection);
    $result = mysqli_num_rows($sql);
    if ($result > 0) {
        while ($data = mysqli_fetch_array($sql)) {
            $idgrupo = $data[0];
            $nombregrupo = $data[1];
        }
    } else {
        header('Location: lista_grupo_auditor.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Eliminar Grupo Auditor</title>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="data_delete">
            <h2 style="color: #C82333">¿Está seguro de eliminar el grupo?</h2>
            <p>ID grupo: <span><?php echo $idgrupo; ?></span></p>
            <p>Nombre grupo: <span><?php echo $nombregrupo; ?></span></p>
            
            <form method="POST" action="">
                <input type="hidden" name="idgrupo" value="<?php echo  $idgrupo; ?>">
                <a href="lista_grupo_auditor.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>
        </div>
    </section>
</body>
</html>