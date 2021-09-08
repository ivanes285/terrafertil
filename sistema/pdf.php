
<?php
 require_once('./app/lib/pdf/mpdf.php');


 $mpdf= new mPDF('c','A4');
 $mpdf->WriteHTML('<div>Hola...fadfad.......fdasdv</div>');
 $mpdf->Output('auditoria.pdf','I')

?>