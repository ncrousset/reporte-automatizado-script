<?php
/**
 * Rudys Natanael Acosta Crousset.
 * User: rudys
 * Date: 04/28/14
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
 * Class DiaDelMes
 *
 * @package lib\cron
 * @author Rudys Natanael Acosta Crousset <natanael926@gmail.com>
 */
class DiaDelMes extends \lib\cron\CronParametro implements \lib\cron\CronInterface {

    /**
     * El limite de repetición es el numeró máximo,
     * para crear una determinada frecuencia.
     */
    const LIMITE_REPETICON  = 32; // este valor no es correcto pero es un parche hasta nueva modificacion.

    /**
     * El valor minimo de los dia de semana
     */
    const VALOR_MINIMO = 1;

    /**
     * @param DateTime $fecha
     */
    public function __construct($fecha) {
        parent::__construct($fecha->format("d"), self::LIMITE_REPETICON, self::VALOR_MINIMO);
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

    /**
     * @return string
     */
    public function __toString() {
        return "Frecuencia DiaDelMes";
    }

} 