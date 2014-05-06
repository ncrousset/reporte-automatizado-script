<?php
/**
 * Rudys Natanael Acosta Crousset.
 * User: rudys
 * Date: 04/29/14
 * Time: 10:35 AM
 */

namespace lib\cron;

/**
 * @see Minuto
 */
require_once 'Minuto.php';

/**
 * @see Hora
 */
require_once 'Hora.php';

/**
 * @see DiaDelMes
 */
require_once 'DiaDelMes.php';

/**
 * @see DiaDeSemana
 */
require_once 'DiaDeSemana.php';

/**
 * Mes
 */
require_once 'Mes.php';

use \lib\cron\Minuto as Minuto;
use \lib\cron\Hora as Hora;
use \lib\cron\DiaDelMes as DiaDelMes;
use \lib\cron\DiaDeSemana as DiaDeSemana;
use \lib\cron\Mes as Mes;

/**
 * Class Cron
 * @package lib\cron
 */
class Cron {

    /**
     * @var DateTime|null
     */
    private static $_dateTime = null;

    /**
     * Crea el objeto de parametro a validar
     *
     * @param $tipo
     * @return DiaDelMes|DiaDeSemana|Hora|Mes|Minuto
     */
    private static function parametro($tipo) {
        switch ($tipo) {
            case 'i':
                return new Minuto(self::$_dateTime);
                break;
            case 'h':
                return new Hora(self::$_dateTime);
                break;
            case 'd':
                return new DiaDelMes(self::$_dateTime);
                break;
            case 'm':
                return new Mes(self::$_dateTime);
                break;
            case 'w':
                return new DiaDeSemana(self::$_dateTime);
                break;

        }
    }

    /**
     * @param string $expresion
     * @return bool
     */
    public static function validacion($expresion) {

        self::$_dateTime = new \DateTime('now');

        $exprecionCron = explode(" ", $expresion);

        $minuto = self::parametro('i');
        $minuto->validacion($exprecionCron[0]);

        $hora = self::parametro('h');
        $hora->validacion($exprecionCron[1]);

        $diaMes = self::parametro('d');
        $diaMes->validacion($exprecionCron[2]);

        $mes = self::parametro('m');
        $mes->validacion($exprecionCron[3]);

        $diaSemana = self::parametro('w');
        $diaSemana->validacion($exprecionCron[4]);

        if($minuto->getValidacion() == true && $hora->getValidacion() == true
        && $diaMes->getValidacion() == true && $mes->getValidacion() == true
        && $diaSemana->getValidacion() == true ) {

            return true;

        }else{
            return false;
        }

    }

}