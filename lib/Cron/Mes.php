<?php
/**
 * Rudys Natanael Acosta Crousset.
 * User: rudys
 * Date: 04/30/14
 * Time: 10:35 AM
 */

namespace lib\cron;

/**
 * @see ParametroInterface
 */
require_once 'CronInterface.php';

require_once 'CronParametro.php';

/**
 * Class Mes
 *
 * @package lib\cron
 * @author Rudys Natanael Acosta Crousset <natanael926@gmail.com>
 */
class Mes extends \lib\cron\CronParametro implements \lib\cron\CronInterface {

    /**
     * El limite de repetición es el numeró máximo,
     * para crear una determinada frecuencia.
     */
    const LIMITE_REPETICON  = 13;

    /**
     * El valor minimo de los dia de semana
     */
    const VALOR_MINIMO = 1;

    /**
     * @param DateTime $fecha
     */
    public function __construct($fecha) {
        parent::__construct($fecha->format("m"), self::LIMITE_REPETICON, self::VALOR_MINIMO);
    }

    /**
     * @param string $expresion
     * @return bool|void
     */
    public function validacion($expresion) {

        $mesNumerica = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
        $mesAlfabetica = array('jan','feb','mar','apr','may','jun','jul', 'aug', 'sep', 'oct', 'nov', 'dec');

        $expresion = strtolower($expresion);
        $expresion= str_replace($mesAlfabetica, $mesNumerica, $expresion);

        parent::validacion($expresion);
    }

    /**
     * @return bool
     */
    public function getValidacion() {
        return $this->validacion;
    }

    public function __toString() {
        return "Frecuencia hora";
    }

} 