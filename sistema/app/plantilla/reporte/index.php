

<?php

function getPlantilla($auditorias,$detalleauditorias)
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
         
          <div class="address">Código de Auditoría:    <span style="font-weight: bold">'.$detalleauditorias[0][0].'</span></div>
          <div class="address">Nombre Norma:      <span style="font-weight: bold">'.$detalleauditorias[0][1].'</span> </div>
          <div class="address">Fecha Ejecución:    <span style="font-weight: bold">'.$detalleauditorias[0][2].'</span></div>
          <div class="address">Fecha Extendida de Auditoría: </div>
        </div>

        <div id="invoice">
          <h1>Grupo Auditor</h1>
          <div class="date">Date of Invoice: 01/06/2014</div>
          <div class="date">Due Date: 30/06/2014</div>
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

        foreach ($auditorias as $audi){


  $plantilla .= '<tr>
            <td class="desc">'.$audi[0].'</td>
            <td class="unit">'.$audi[1].'</td>
            <td class="desc">'.$audi[2].'</td>
            <td class="unit">'.$audi[3].'</td>
          </tr>';
        }
  $plantilla .= '</tbody>



     

      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        <div class="email"><a href="mailto:john@example.com">john@example.com</a></div> 
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
      
    </footer>
  </body>';

  return $plantilla;
}


?>
