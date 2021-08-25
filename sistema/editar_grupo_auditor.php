<?php
session_start();
include "../conexion.php";

$idgrupo = $_REQUEST['id'];
if (!empty($_POST)) {
    $alert = '';
    
    $nombregrupo = $_POST['nombregrupo'];
    $idnorma = $_POST['idnorma'];
 
    $query = mysqli_query($conection, "SELECT * FROM grupoauditor WHERE  idgrupo='$nombregrupo' ");
    $result = mysqli_fetch_array($query);
    if ($result > 0) {
        $alert = '<p class="msg_error">Proceso YA existe !Intente de Nuevo con otro Proceso</p>';
    } else {
        $query_update = mysqli_query($conection, "UPDATE grupoauditor SET nombregrupo='$nombregrupo',idnorma='$idnorma' WHERE idgrupo=$idgrupo");
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
        $idgrupo = $data[0];
        $nombregrupo = $data[1];
        $idnorma = $data[2];
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
                <label for="nombregrupo ">Nombre Grupo</label>
                <input type="text" name="nombregrupo" id="nombregrupo" placeholder="Ingrese nombre del Grupo" required value="<?php echo $nombregrupo; ?>">
                <label for="idnorma">Norma</label>
                <?php
                include "../conexion.php";
                $query_id_user = mysqli_query($conection, "SELECT * FROM norma");
                mysqli_close($conection);
                $result_id_user = mysqli_num_rows($query_id_user);
                ?>
                <select name="idnorma" id="idnorma">
                    <?php
                    if ($result_id_user > 0) {
                        while ($periodo = mysqli_fetch_array($query_id_user)) {
                    ?>
                            <option value="<?php echo $periodo["idnorma"]; ?>"><?php echo $periodo["nombrenorma"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>




                <center><a style="border: 2px solid #2e518b;  color: #ffffff; background-color: #1883ba;" href="lista_grupo_auditor.php" class="btn_cancel">Regresar</a> </center>
                <input type="submit" style="border: 2px solid #2e518b;  color: #ffffff; background-color: #04B404; font-size: 17px;" value="Actualizar" class="btn_save">   
            </form>
        </div>
    </section>
</body>

</html>