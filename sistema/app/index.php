<?php

require_once('../vendor/autoload.php');

require_once('./plantilla/reporte/index.php');

//codigo css de la plantilla 
$css = file_get_contents('./plantilla/reporte/style.css');



$mpdf = new \Mpdf\Mpdf([
"format"=> "A4"

]);


$mpdf->SetFooter('{PAGENO}');


//Consultas para extraer los datos para el pdf
session_start();
include "../../conexion.php";
$usu = $_SESSION['id_user'];

if (empty($_REQUEST['id'])) {
    header('Location: lista_auditorarchivadas.php');
    mysqli_close($conection);
}
$iddetalleauditoria = $_REQUEST['id'];

$auditorias = array();
$query = mysqli_query($conection, "SELECT c.clausula,p.nombreproceso,dc.parametroscalificacion,dc.desincumplimiento FROM clausula c, detalleclausula dc, procesos p WHERE dc.idclausula=c.idclausula AND p.idproceso=c.idproceso AND dc.iddetalleauditoria=$iddetalleauditoria");
$result = mysqli_num_rows($query);
if ($result > 0) {
    while ($data = mysqli_fetch_array($query)) {
        $auditorias[] = $data;
    }
}



$detalleauditorias = array();
$query2 = mysqli_query($conection, "SELECT codigoauditoria,nombrenorma,fechaejecucion from norma n, grupoauditor ga, detallegrupo dg, detalleauditoria da WHERE n.idnorma=ga.idnorma and ga.idgrupo=dg.idgrupo AND dg.idgrupo=da.idgrupo AND dg.id_user=$usu AND da.estado=3 AND da.iddetalleauditoria=$iddetalleauditoria;");
$results = mysqli_num_rows($query2);
if ($results > 0) {
    while ($datos = mysqli_fetch_array($query2)) {
        $detalleauditorias[] = $datos;
    }
}


$grupoauditor;
$query3 = mysqli_query($conection, "SELECT DISTINCT nombregrupo FROM detalleauditoria da, detallegrupo dg, grupoauditor ga WHERE ga.idgrupo=dg.idgrupo AND dg.idgrupo=da.idgrupo AND da.iddetalleauditoria=$iddetalleauditoria;");
$results1 = mysqli_num_rows($query3);
if ($results1 > 0) {
    while ($grupo = mysqli_fetch_array($query3)) {
        $grupoauditor = $grupo[0];
    }
}

//Contador de Parametros de Calificación

$con = mysqli_query($conection, "SELECT COUNT( dc.parametroscalificacion) as noconmayor FROM clausula c, detalleclausula dc, procesos p WHERE dc.idclausula=c.idclausula AND p.idproceso=c.idproceso AND dc.iddetalleauditoria=$iddetalleauditoria AND dc.parametroscalificacion='No Conformidad Mayor';");
$con1 = mysqli_query($conection, "SELECT COUNT( dc.parametroscalificacion) as noconmenor FROM clausula c, detalleclausula dc, procesos p WHERE dc.idclausula=c.idclausula AND p.idproceso=c.idproceso AND dc.iddetalleauditoria=$iddetalleauditoria AND dc.parametroscalificacion='No Conformidad Menor';");
$con2 = mysqli_query($conection, "SELECT COUNT( dc.parametroscalificacion) as observacion FROM clausula c, detalleclausula dc, procesos p WHERE dc.idclausula=c.idclausula AND p.idproceso=c.idproceso AND dc.iddetalleauditoria=$iddetalleauditoria AND dc.parametroscalificacion='Observación';");
$con3 = mysqli_query($conection, "SELECT COUNT( dc.parametroscalificacion) as oportunidad FROM clausula c, detalleclausula dc, procesos p WHERE dc.idclausula=c.idclausula AND p.idproceso=c.idproceso AND dc.iddetalleauditoria=$iddetalleauditoria AND dc.parametroscalificacion='Oportunidad de Mejora';");

$result1 = mysqli_fetch_array($con);
$result2 = mysqli_fetch_array($con1);
$result3 = mysqli_fetch_array($con2);
$result4 = mysqli_fetch_array($con3);

if (isset($result1)) {
    $noconmayor = $result1['noconmayor'];
}
if (isset($result2)) {
    $noconmenor = $result2['noconmenor'];
}
if (isset($result3)) {
    $observacion = $result3['observacion'];
}
if (isset($result4)) {
    $oportunidad = $result4['oportunidad'];
}


$auditorlider;
$correolider;
$query4 = mysqli_query($conection, "SELECT user,correo FROM detalleauditoria da, detallegrupo dg, usuario u WHERE u.id_user=dg.id_user AND dg.idgrupo=da.idgrupo AND dg.idrolauditor=1 AND da.iddetalleauditoria=$iddetalleauditoria;");
$results2 = mysqli_num_rows($query4);
if ($results2 > 0) {
    while ($audi = mysqli_fetch_array($query4)) {
        $auditorlider = $audi[0];
        $correolider = $audi[1];
    }
}


mysqli_close($conection);

$plantilla = getPlantilla($auditorias, $detalleauditorias, $grupoauditor,$noconmayor,$noconmenor,$observacion,$oportunidad, $auditorlider, $correolider);




$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output("Auditoría ".$detalleauditorias[0][0].".pdf", "I");
