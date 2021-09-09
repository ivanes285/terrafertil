<?php
session_start();

if ($_SESSION['rol'] != 1) {
    header("location: ./");
}

include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';

    $codigoauditoria = $_POST['codigoauditoria'];
    $idperiodo = $_POST['tiempoperiodo'];
    $fechaejecucion = $_POST['fechaejecucion'];
    $idgrupode = $_POST['detallegrupo'];

    $query = mysqli_query($conection, "SELECT * FROM detalleauditoria WHERE  codigoauditoria='$codigoauditoria' ");

    $result = mysqli_fetch_array($query);
    if ($result > 0) {
        $alert = '<p class="msg_error">Proceso YA existe !Intente de Nuevo con una nueva Auditoria</p>';
    } else {

        //Consulta para el Registro de la Auditoria
        $query_insert = mysqli_query($conection, "INSERT INTO detalleauditoria (codigoauditoria,idperiodo,fechaejecucion,idgrupo) VALUES 
        ('$codigoauditoria',$idperiodo,'$fechaejecucion', $idgrupode)");


        //Consulta para determinar el ultimoregistro
        $sql = mysqli_query($conection, "SELECT MAX(iddetalleauditoria) FROM detalleauditoria");
        $num = mysqli_num_rows($sql);
        if ($num > 0) {
            while ($po = mysqli_fetch_array($sql)) {
                $fda = $po[0];
            }
        }
        $ultimoregistro = intval($fda); //convierto en entero ya que fda es string


        //consulta para saber que norma es de la auditoria ingresada
        $sqlnorma = mysqli_query($conection, "SELECT n.idnorma,n.nombrenorma from detalleauditoria da, detallegrupo dg, grupoauditor ga, norma n WHERE n.idnorma=ga.idnorma AND ga.idgrupo=dg.idgrupo AND dg.idgrupo=da.idgrupo AND dg.idrolauditor=1 AND da.iddetalleauditoria=$ultimoregistro");
        $numero = mysqli_num_rows($sqlnorma);
        if ($numero > 0) {
            while ($res = mysqli_fetch_array($sqlnorma)) {
                $gg = $res[0];
            }
        }
        $norma = intval($gg);  //convierto en entero ya que fda es string

        //Consulta para recorrer todas las clausulas de la tabla clausulas cuando norma de clausula sea igual a la norma de detalleauditoria
        $clausulas = mysqli_query($conection, "SELECT c.idclausula,c.clausula,c.detalleclausula,c.idnorma,c.idproceso from clausula c , detalleauditoria da, detallegrupo dg, grupoauditor ga, norma n WHERE n.idnorma=ga.idnorma AND ga.idgrupo=dg.idgrupo AND dg.idgrupo=da.idgrupo AND n.idnorma=c.idnorma AND dg.idrolauditor=1 AND c.idnorma=$norma AND da.iddetalleauditoria=$ultimoregistro");
        $numeroclausulas = mysqli_num_rows($clausulas);
        $con = 1;
        $array = array();
        if ($numeroclausulas > 0) {
            while ($pe = mysqli_fetch_array($clausulas)) {
                $array[$con] = $pe[0];
                $con++;
            }
        }
        for ($i = 1; $i <= $numeroclausulas; $i++) {
            $val = $array[$i];
            $sqlinsert = mysqli_query($conection, "INSERT INTO detalleclausula (idclausula,iddetalleauditoria) VALUES  ($val,$ultimoregistro)");
        }

        if ($query_insert) {
            $alert = '<p class="msg_save">CREADO CORRECTAMENTE</p>';
        } else {
            $alert = '<p class="msg_error">Error al Registrar Auditoria </p>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Registro de Auditoria</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <h1 style="text-align: center">Registro de Auditoria</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="POST">
                <label for="codigoauditoria">Código Auditoria</label>
                <input type="text" name="codigoauditoria" id="codigoauditoria" placeholder="Ingrese el código de auditoría" required>
                <label for="tiempoperiodo">Tiempo Periodo</label>
                <?php
                $query_id_user = mysqli_query($conection, "SELECT * FROM periodo");
                $result_id_user = mysqli_num_rows($query_id_user);
                ?>
                <select name="tiempoperiodo" id="tiempoperiodo">
                    <?php
                    if ($result_id_user > 0) {
                        while ($res = mysqli_fetch_array($query_id_user)) {
                    ?>
                            <option value="<?php echo $res["idperiodo"]; ?>"><?php echo $res["tiempoperiodo"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <label for="fechaejecucion">Fecha de Ejecución</label>
                <input type="text" name="fechaejecucion" id="fechaejecucion" autocomplete="off">

                <label for="grupoauditor">Grupo de Auditoria</label>
                <?php
                $query_id_user = mysqli_query($conection, "SELECT nombregrupo,dg.idgrupo,iddetallegrupo FROM grupoauditor ga, detallegrupo dg WHERE dg.idgrupo=ga.idgrupo AND dg.idrolauditor=1 AND dg.activo=1");

                $result_id_user = mysqli_num_rows($query_id_user);

                ?>
                <select name="detallegrupo" id="detallegrupo">
                    <?php
                    if ($result_id_user > 0) {
                        while ($grupo = mysqli_fetch_array($query_id_user)) {
                    ?>
                            <option value="<?php echo $grupo["idgrupo"]; ?>"><?php echo $grupo["nombregrupo"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <br>
        <a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 132px; background-color: #36A152; border-radius: 6px;" class="btn_save1" href="lista_detalleauditoria.php">Regresar</a> 
                <input type="submit" value="Registrar" class="btn_save">
            </form>
        </div>
    </section>
    <script>
        $(function() {
            $("#fechaejecucion").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 0
            });
        });
    </script>
</body>

</html>