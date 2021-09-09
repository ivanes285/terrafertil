

<?php

function getPlantilla($auditorias, $detalleauditorias, $grupoauditor,$noconmayor,$noconmenor,$observacion,$oportunidad, $auditorlider, $correolider)
{

  $plantilla = '<body>
    <header class="clearfix">
      <div id="logo" >
        <img src="img/logo.png" style="width:500px; margin-left:100px">
      </div>
      <div id="company">
        <div>Vía a Laguna de Mojanda.</div>
        <div>Telf.: (02) 3614137 - 3614122</div>
        <div>Tabacundo – Ecuador</div>
        <div><a href="https://mx.naturesheart.com/" target="_blank">www.naturesheartterrafertil.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">

        <div id="client">
          <h2 class="name">SOLICITUD DE ACCIONES CORRECTIVAS</h2>
         
          <div class="address">Código de Auditoría:    <span style="font-weight: bold">' . $detalleauditorias[0][0] . '</span></div>
          <div class="address">Nombre Norma:      <span style="font-weight: bold">' . $detalleauditorias[0][1] . '</span> </div>
          <div class="address">Fecha Ejecución:    <span style="font-weight: bold">' . $detalleauditorias[0][2] . '</span></div>
          <div class="address">Fecha Extendida de Auditoría: </div>
        </div>

        <div id="invoice">
          <h1>Grupo Auditor</h1> 
          <div class="date"><span style="font-weight: bold">' . $grupoauditor . '</span></div>
         
        </div>
        <div id="client">                                                       
        <h2 class="name"><span style="font-weight: bold">Resumen de Hallazgos (Incumplimientos)</span></h2>
        <div class="address">No Conformidad Mayor:    <span style="font-weight: bold">' .  $noconmayor . '</span></div>
        <div class="address">No Conformidad Menor:    <span style="font-weight: bold">' . $noconmenor . '</span></div>
        <div class="address">Observación:    <span style="font-weight: bold">' . $observacion. '</span></div>
        <div class="address">Oportunidad de Mejora:    <span style="font-weight: bold">' . $oportunidad . '</span></div>
        </div>

      </div>


      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr >
            <th class="desc"><h3>Clausula</h3></th>
            <th class="unit"><h3>Proceso Auditado</h3></th>
            <th class="desc"><h3>Parámetro Calificación</h3></th>
            <th class="unit"><h3>Descripcion Incumplimiento</h3></th>
          
          </tr>
        </thead>

        <tbody>';

  foreach ($auditorias as $audi) {


    $plantilla .= '<tr>
            <td class="desc">' . $audi[0] . '</td>
            <td class="unit">' . $audi[1] . '</td>
            <td class="desc">' . $audi[2] . '</td>
            <td class="unit">' . $audi[3] . '</td>
          </tr>';
  }
  $plantilla .= '</tbody>

      </table>

      <div id="notices">
        <div>Responsable del Informe:</div>
        <div class="notice"> <span style="font-weight: bold">'. $auditorlider . '</span></div>
        <div class="email"><a href="#">'. $correolider . '</a></div> 
      </div>
    </main>
    <footer>
    <div class="centrar">
     <p>AMEMBER OF TERRAHOLDINGS, LLC
     Terrafertil Ecuador S.A. Principal s/n Vía a Laguna de Mojanda. Telf.: (o2) 3614137 • 3614122 • Tabacundo – Ecuador
     Terrafertil Colombia S.A.S. Lote Terrafertil, Vereda de la granja, Zipaquirá Colombia. Terrafertil México S.A.P.I. de C.V. Prolongación Independencia No.14, Int. 1 Col.
      Barrio Los Reyes Tutiltlán, Tultitlán de Mariano Escobedo
     Edo. De México, C.P. 54915. Terrafertil Perú S.A.C. Calle Los Tulipanes 147 Oficina 304 interior 4 Santiago de Surco. Lima·Perú. Terrafertil Chile SpA. Lo Echevers 550, Bodega 2, 
     Quilicura, Santiago, Región Metropolitana. Terrafertil Brasil Rua Itapura , 249 11° Andar, Conj. 1109 Edificio Etoile Empresarial, Cep: 03310-000 Sao Paulo·SP. Terrafertil UK Limited Floor 6, 13 Dorset Street London, W1U6QT, United Kingdom.</p>
     </div>
     </footer>
  </body>';

  return $plantilla;
}


?>
