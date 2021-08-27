<?php
session_start();

if ($_SESSION['rol'] != 3) {
    header("location: ./");
}
$idaccionpropuesta = $_REQUEST['idap'];
$idplanaccion = $_REQUEST['idpa'];
$iddetalleclausula = $_REQUEST['id'];
$iddetalleauditoria = $_REQUEST['ida']; 
$estado= $_REQUEST['es']; 
include "../conexion.php";
if (!empty($_POST)) {
    
    $cadena="lista_accionpropuesta.php?idpa=".$idplanaccion."&id=".$iddetalleclausula."&ida=".$iddetalleauditoria."&es=".$estado;
    $query_delete = mysqli_query($conection, "DELETE FROM accionespropuestas WHERE idaccionpropuesta = $idaccionpropuesta");
    mysqli_close($conection);
    if ($query_delete) {
        header("location:".$cadena);
    } else {
        echo "Error al eliminar la acción propuesta";
    }
}
if (empty($_REQUEST['idap'])) {
    header("location:".$cadena);
    mysqli_close($conection);
} else {
    $idaccionpropuesta = $_REQUEST['idap'];
    $sql = mysqli_query($conection, "SELECT * FROM accionespropuestas WHERE idaccionpropuesta = $idaccionpropuesta");
    mysqli_close($conection);
    $result = mysqli_num_rows($sql);
    if ($result > 0) {
        while ($data = mysqli_fetch_array($sql)) {
            $idaccionpropuesta = $data[0];
            $idplanaccion = $data[1];
            $accionpropuesta = $data[2];
            $responsable  = $data[3];
            $fechapropuesta = $data[4];
            $evidencia=$data[5];

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
    <title>Eliminar Acción propuesta</title>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="data_delete">
            <h2 style="color: #C82333">¿Está seguro de eliminar esta acción?</h2>
            <p>ID acción propuesta: <span><?php echo $idaccionpropuesta; ?></span></p>
            <p>ID plan de acción: <span><?php echo $idplanaccion; ?></span></p>
            <p>Acción Propuesta: <span><?php echo $accionpropuesta; ?></span></p>
            <p>Responsable: <span><?php echo $responsable; ?></span></p>
            <p>Fecha propuesta: <span><?php echo $fechapropuesta; ?></span></p>
            <p>Evidencia: <span><?php echo $evidencia; ?></span></p>
           
            <form method="POST" action="">
            <input type="hidden" name="idaccionpropuesta" value="<?php echo  $idaccionpropuesta; ?>">
                <center><a style="border: 2px solid #2e518b;  color: #ffffff; background-color: #04B404;" href="lista_accionpropuesta.php?idpa=<?php echo $idplanaccion ?>&id=<?php echo $iddetalleclausula ?>&ida=<?php echo $iddetalleauditoria ?>&es=<?php echo $estado; ?>" class="btn_cancel">Regresar</a> </center>
                <input type="submit" style="border: 2px solid #2e518b;  color: #ffffff; background-color:  #1883ba; font-size: 17px;" value="Aceptar" class="btn_ok">
            </form>
        </div>
    </section>
</body>
</html>