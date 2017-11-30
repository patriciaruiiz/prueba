<?php

$Entrada = $_POST['valor'];

$linea = preg_split("/[\s,]+/", strtoupper($Entrada));
$Cantidad = array();
$valido = true;
$Resultado = "";

for($x = 0; $x<count($linea); $x++){

    $fila = array_shift($linea);
    $columna = array_shift($linea);

    $matriz = array();

    for ($i=1; $i <= $fila; $i++) {
        array_push($matriz, str_split(array_shift($linea)));
    }

    $Resultado = BuscarPalabra($matriz, $fila, $columna, "Horizontal") + BuscarPalabra($matriz, $columna, $fila, "Vertical") + 
                 BuscarPalabra($matriz, $fila, $columna, "DiagonalP") + BuscarPalabra($matriz, $fila, $columna, "DiagonalS");
   
    array_push($Cantidad, $Resultado);
    
 };

 function BuscarPalabra($matriz, $indice1, $indice2, $orientacion)
 {
    $palabraBuscar = "OIE";
    $aparece = 0;

    switch ($orientacion) {
        case 'Horizontal':
            for ($i=0; $i < $indice1; $i++) {
                $Orient = '';
                for ($j=0; $j < $indice2; $j++) {
                    $Orient = $Orient . $matriz[$i][$j];
                } 
                $aparece = $aparece + substr_count($Orient, $palabraBuscar) + substr_count(strrev($Orient), $palabraBuscar); 
            } 
            break;

        case 'Vertical':
            for ($i=0; $i < $indice1; $i++) {
                $Orient = '';
                for ($j=0; $j < $indice2; $j++) {
                    $Orient = $Orient . $matriz[$j][$i];
                }   
                $aparece = $aparece + substr_count($Orient, $palabraBuscar) + substr_count(strrev($Orient), $palabraBuscar);
            }
            break;
        case 'DiagonalP':
            $diagonalP = "";
            for ($i=0; $i < $indice1; $i++) {
                for ($j=0; $j < $indice2; $j++) {
                    if($i == $j){
                        $diagonalP = $diagonalP . $matriz[$i][$j];  
                    }
                }
            }

            $aparece = $aparece + substr_count($diagonalP, $palabraBuscar) + substr_count(strrev($diagonalP), $palabraBuscar);
            break;

        case 'DiagonalS':
            $diagonalS = "";
            for ($i=0; $i < $indice1; $i++) {
                for ($j=0; $j < $indice2; $j++) {
                    if((($indice2-1) - $i) == $j){
                        $diagonalS = $diagonalS . $matriz[$i][$j];  
                    }
                }
             }

            $aparece = $aparece + substr_count($diagonalS, $palabraBuscar) + substr_count(strrev($diagonalS), $palabraBuscar);
            break;
    }
    return $aparece;
}

 echo json_encode($Cantidad);

?>

