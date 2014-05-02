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
    const LIMITE_REPETICON  = 60;

    /**
     * El valor minimo de los minuto
     */
    const VALOR_MINIMO = 0;

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

        $this->_dateMinuto = $fecha->format("i");
        $this->detalle($expresion);

    }

    /**
     * @return void
     */
    public function detalle($expresion) {

        if($expresion == '*') {
            $this->_valido = true;
            return true;
        }

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
                        } elseif (isset($detalleExp[1]) == true){
                            if($this->repeticion($minutosContinuos[0], $detalleExp[1])){
                                return true;
                            }
                        }

                        $minutosContinuos[0]++;
                    }
                }

            } else {

                if($detalleExp[0] == $this->_dateMinuto) {
                    $this->_valido = true;
                    return true;
                } elseif (isset($detalleExp[1]) == true) {

                    if($this->repeticion($detalleExp[0], $detalleExp[1])){
                        return true;
                    }
                }
            }
        }

    }

    /**
     * @param $expMinuto
     * @param $expFrecuencia
     * @return bool|string
     */
    public function repeticion($expMinuto, $expFrecuencia) {

        $resurtado = array();

        if($expMinuto == "*"){
            $expMinuto = $expFrecuencia;
        }

        /*
         * Si el resido de la división entre el limite repetición y la frecuencia es diferente de 0.
         *  el ciclo es infinito abarcando todas las posibilidades de la frecuencia. lo mismo
         * ocurre cuando la frecuencia es 1.
         */
        if(fmod(self::LIMITE_REPETICON, $expFrecuencia) != 0 || $expFrecuencia == 1) {
            $this->_valido = true;
            return true;
        }

        $contadorFrecuencia = self::LIMITE_REPETICON / $expFrecuencia;

        // Buscamo todos los valores arrojado por
        while($contadorFrecuencia > 0) {

            /*
             * m = em + (c * f);
             */
            $minuto = ($expMinuto + ($contadorFrecuencia * $expFrecuencia));

            if($minuto > self::LIMITE_REPETICON)
                $minuto = $minuto - self::LIMITE_REPETICON;

            if($minuto == self::LIMITE_REPETICON)
                $minuto = self::VALOR_MINIMO;


            if($this->_dateMinuto == $minuto) {
                $this->_valido = true;
                return true;
            }

            $contadorFrecuencia--;
        }

        return false;

    }

    public function __toString() {
        return "Frecuencia minuto";
    }

} 