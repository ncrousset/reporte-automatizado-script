<?php
/**
 * Rudys Natanael Acosta Crousset.
 * User: rudys
 * Date: 05/02/14
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
 * Class DiaDeSemana
 *
 * @package lib\cron
 * @author Rudys Natanael Acosta Crousset <natanael926@gmail.com>
 */
class DiaDeSemana extends \lib\cron\CronParametro implements \lib\cron\CronInterface {

    /**
     * El limite de repetición es el numeró máximo,
     * para crear una determinada frecuencia.
     */
    const LIMITE_REPETICON  = 7;

    /**
     * El valor minimo de los dia de semana
     */
    const VALOR_MINIMO = 0;

    /**
     * @param DateTime $fecha
     */
    public function __construct($fecha) {
        parent::__construct($fecha->format("w"), self::LIMITE_REPETICON, self::VALOR_MINIMO);
    }

    /**
     * @param string $expresion
     * @return bool|void
     */
    public function validacion($expresion) {

        $diaDeSemanaNumerica = array(0, 1, 2, 3, 4, 5, 6);
        $diaDeSemanaAlfabetica = array('sun','mon','tue','wed','thu','fri','sat');

        $expresion = strtolower($expresion);
        $expresion= str_replace($diaDeSemanaAlfabetica, $diaDeSemanaNumerica, $expresion);

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
        return "Frecuencia hora";
    }

} 