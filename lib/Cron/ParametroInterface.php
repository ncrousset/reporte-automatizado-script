<?php
/**
 * User: Rudys Natanael Acosta Crousset
 * Date: 05/01/14
 * Time: 10:22 AM
 */

namespace lib\cron;

/**
 * Interface ParametroInterface
 *
 * Implementa los diferentes parametros en una excepción Cron,
 * defino como parametros minuto, hora, día del mes, día de la semana
 *
 * @package lib\cron
 * @author Rudys Natanael Acosta Crousset <natanael926@gmail.com>
 */
interface ParametroInterface {

    public function init($fecha, $expresion);

    public function detalle($expresion);

    public function repeticion($expMinuto, $expFrecuencia);

} 