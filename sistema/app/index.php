<?php

require_once('../vendor/autoload.php');

require_once('./plantilla/reporte/index.php');

//codigo css de la plantilla 
$css = file_get_contents('./plantilla/reporte/style.css');



$mpdf = new \Mpdf\Mpdf([]);




//Consultas para extraer los datos para el pdf
session_start();
include "../../conexion.php";
$usu = $_SESSION['id_user'];

if (empty($_REQUEST['id'])) {
    header('Location: lista_auditorarchivadas.php');
    mysqli_close($conection);
}
$iddetalleauditoria = $_REQUEST['id'];

$auditorias= array();
$query = mysqli_query($conection, "SELECT c.clausula,p.nombreproceso,dc.parametroscalificacion,dc.desincumplimiento FROM clausula c, detalleclausula dc, procesos p WHERE dc.idclausula=c.idclausula AND p.idproceso=c.idproceso AND dc.iddetalleauditoria=$iddetalleauditoria");
$result = mysqli_num_rows($query);
if ($result > 0) {
    while ($data = mysqli_fetch_array($query)) {
     $auditorias[]=$data;
    }
}



$detalleauditorias= array();
$query2 = mysqli_query($conection, "SELECT codigoauditoria,nombrenorma,fechaejecucion from norma n, grupoauditor ga, detallegrupo dg, detalleauditoria da WHERE n.idnorma=ga.idnorma and ga.idgrupo=dg.idgrupo AND dg.idgrupo=da.idgrupo AND dg.id_user=$usu AND da.estado=3 AND da.iddetalleauditoria=$iddetalleauditoria;");
$results = mysqli_num_rows($query2);
if ($results > 0) {
    while ($datos = mysqli_fetch_array($query2)) {
        $detalleauditorias[]=$datos;
    }
}
mysqli_close($conection);





$plantilla = getPlantilla($auditorias,$detalleauditorias);






$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output();
