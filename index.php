<?php

/**
 * @see  \lib\cron\Cron
 */
require_once __DIR__ . '/lib/Cron/Cron.php';

require_once __DIR__ . '/lib/Reporte/ColaTarea.php';

use \lib\cron\Cron as Cron;

use \lib\reporte\ColaTarea as ColaTarea;

$estructuraReporte = array(
  array( "id" => 1, 'url' => "url", 'programacion' => '* * * * *' ),
  array( "id" => 2, 'url' => "url", 'programacion' => '* * * * *' ),
  array( "id" => 3, 'url' => "url", 'programacion' => '* * * * *' ),
);


if(Cron::validacion("* * * * *") && ColaTarea::validacion(2)) {

    $url = __DIR__ . '/archivoColaTarea/2.txt';
    exec("php prueba.php > " . $url . " &");
    echo 'validacion correcta';

} else{
    echo 'Validacion incorrecta';
}

