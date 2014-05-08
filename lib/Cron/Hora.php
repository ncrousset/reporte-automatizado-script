<?php
/**
 * Rudys Natanael Acosta Crousset.
 * User: rudys
 * Date: 04/29/14
 * Time: 10:35 AM
 */

namespace lib\cron;

/**
 * @see ParametroInterface
 */
require_once 'CronInterface.php';

/**
 * @see CronParametro
 */
require_once 'CronParametro.php';

/**
 * Class Hora
 *
 * @package lib\cron
 * @author Rudys Natanael Acosta Crousset <natanael926@gmail.com>
 */
class Hora extends \lib\cron\CronParametro implements \lib\cron\CronInterface {

    /**
     * El limite de repetición es el numeró máximo,
     * para crear una determinada frecuencia.
     */
    const LIMITE_REPETICON  = 24;

    /**
     * El valor minimo de los dia de semana
     */
    const VALOR_MINIMO = 0;

    /**
     * @param DateTime $fecha
     */
    public function __construct($fecha) {
        parent::__construct($fecha->format("H"), self::LIMITE_REPETICON, self::VALOR_MINIMO);
    }

    /**
     * @param string $expresion
     * @return bool|void
     */
    public function validacion($expresion) {
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