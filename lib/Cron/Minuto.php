<?php
/**
 * Rudys Natanael Acosta Crousset.
 * User: rudys
 * Date: 05/01/14
 * Time: 10:35 AM
 */

namespace lib\cron;

/**
 * @see ParametroInterface
 */
require_once 'ParametroInterface.php';

/**
 * Class Minuto
 *
 * @package lib\cron
 * @author Rudys Natanael Acosta Crousset <natanael926@gmail.com>
 */
class Minuto implements \lib\cron\ParametroInterface {

    /**
     * El limite de repetición es el numeró máximo,
     * para crear una determinada frecuencia.
     */
    const LIMITE_REPETICON  = 59;

    /**
     * @var null
     */
    private static $_instance = null;

    /**
     * @var null
     */
    private $_dateMinuto = null;

    /**
     * @var bool
     */
    private $_valido = false;

    /**
     * @return Minuto|null
     */
    public static function getInstance() {

        if(self::$_instance == null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     *
     * @param $fecha -- fecha acomparar con la expresion
     * @param $expresion
     * @return boolean
     */
    public function init($fecha, $expresion) {

        $this->_dateMinuto = $fecha->format("m");

        echo $this->_dateMinuto . '<br/>';
        echo $expresion . '<br/>';

        echo($this->detalle($expresion)) ? 'OK' : 'NO';

        // Si esta definido larepeticiónn llama al método.
        if(count($expresion) > 1 && !$this->_valido ) {
            $this->repeticion($expresion[1]);
        }

    }

    /**
     * @return void
     */
    public function detalle($expresion) {

        if($expresion == '*') {
            $this->_valido = true;
            return true;
        }


        if(preg_match("/,/", $expresion)) {
            $expMinustos = explode(",", $expresion);

            foreach($expMinustos as $exp) {
                $detalleExp = explode("/", $exp);

                // Si la excreción es continua ejp: 1-5
                if(preg_match("/-/", $detalleExp[0])) {
                    $minutosContinuos = explode("-", $exp);

                    if($minutosContinuos[0] < $minutosContinuos[1]) {
                        while($minutosContinuos[0] <= $minutosContinuos[1]) {
                            if($minutosContinuos[0] == $this->_dateMinuto) {
                                $this->_valido = true;
                                return true;
                            }

                            $minutosContinuos[0]++;
                        }
                    }
                }else {
                    if($detalleExp[0] == $this->_dateMinuto) {
                        $this->_valido = true;
                        return true;
                    }
                }
            }

        } else {
            if($expresion == $this->_dateMinuto) {
                $this->_valido = true;
                return true;
            }
        }


//        if(!$this->_valido) {
//
//        }

    }

    /**
     * @return void
     */
    public function repeticion($expresion) {

    }

    public function __toString() {
        return "Frecuencia minuto";
    }

} 