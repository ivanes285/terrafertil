
<?php

function validarCedula($cedula) {
          
    $Provincia = substr($cedula, 0, 2);
    if ($Provincia < 0 OR $Provincia > 24) {
        return 0;
    }

    $arrayCoeficientes = array(2, 1, 2, 1, 2, 1, 2, 1, 2);

    $digitoVerificador = (int) $cedula[9];
    $digitosIniciales = str_split(substr($cedula, 0, 9));

    $total = 0;
    foreach ($digitosIniciales as $key => $value) {

        $valorPosicion = ( (int) $value * $arrayCoeficientes[$key] );

        if ($valorPosicion >= 10) {
            $valorPosicion = str_split($valorPosicion);
            $valorPosicion = array_sum($valorPosicion);
            $valorPosicion = (int) $valorPosicion;
        }

        $total = $total + $valorPosicion;
    }

    $residuo = $total % 10;

    if ($residuo == 0) {
        $resultado = 0;
    } else {
        $resultado = 10 - $residuo;
    }

    if ($resultado != $digitoVerificador) {
        return 0;
    }

    return true;
}


      
      ?>