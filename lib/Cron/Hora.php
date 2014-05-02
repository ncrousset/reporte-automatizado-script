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
require_once 'ParametroInterface.php';

/**
 * Class Hora
 *
 * @package lib\cron
 * @author Rudys Natanael Acosta Crousset <natanael926@gmail.com>
 */
class Hora implements \lib\cron\ParametroInterface {

    /**
     * El limite de repetición es el numeró máximo,
     * para crear una determinada frecuencia.
     */
    const LIMITE_REPETICON  = 24;

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
    private $_dateHora = null;

    /**
     * @var bool
     */
    public $valido = false;

    /**
     * @return Hora|null
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

        $this->_dateHora = $fecha->format("H");
        $this->detalle($expresion);

    }

    /**
     * @return void
     */
    public function detalle($expresion) {

        if($expresion == '*') {
            $this->valido = true;
            return true;
        }

        $expHoras = explode(",", $expresion);

        foreach($expHoras as $exp) {
            $detalleExp = explode("/", $exp);

            // Si la excreción es continua ejp: 1-5
            if(preg_match("/-/", $detalleExp[0])) {
                $horasContinuos = explode("-", $exp);

                if($horasContinuos[0] < $horasContinuos[1]) {
                    while($horasContinuos[0] <= $horasContinuos[1]) {
                        if($horasContinuos[0] == $this->_dateHora) {
                            $this->valido = true;
                            return true;
                        } elseif (isset($detalleExp[1]) == true){
                            if($this->repeticion($horasContinuos[0], $detalleExp[1])){
                                return true;
                            }
                        }

                        $horasContinuos[0]++;
                    }
                }

            } else {

                if($detalleExp[0] == $this->_dateHora) {
                    $this->valido = true;
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
     * @param $expHora
     * @param $expFrecuencia
     * @return bool|string
     */
    public function repeticion($expHora, $expFrecuencia) {

        if($expHora == "*"){
            $expHora = $expFrecuencia;
        }

        /*
         * Si el resido de la división entre el limite repetición y la frecuencia es diferente de 0.
         *  el ciclo es infinito abarcando todas las posibilidades de la frecuencia. lo mismo
         * ocurre cuando la frecuencia es 1.
         */
        if(fmod(self::LIMITE_REPETICON, $expFrecuencia) != 0 || $expFrecuencia == 1) {
            $this->valido = true;
            return true;
        }

        $contadorFrecuencia = self::LIMITE_REPETICON / $expFrecuencia;

        // Buscamo todos los valores arrojado por
        while($contadorFrecuencia > 0) {

            /*
             * x = ex + (c * f);
             */
            $hora = ($expHora + ($contadorFrecuencia * $expFrecuencia));

            if($hora > self::LIMITE_REPETICON)
                $hora = $hora - self::LIMITE_REPETICON;

            if($hora == self::LIMITE_REPETICON)
                $hora = self::VALOR_MINIMO;

            if($this->_dateHora == $hora) {
                $this->valido = true;
                return true;
            }

            $contadorFrecuencia--;
        }

        return false;

    }

    public function __toString() {
        return "Frecuencia hora";
    }

} 