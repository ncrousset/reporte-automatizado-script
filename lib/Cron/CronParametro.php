<?php
/**
 * Created by PhpStorm.
 * User: rudys
 * Date: 05/04/14
 * Time: 06:28 PM
 */

namespace lib\cron;

require_once 'CronInterface.php';

class CronParametro implements \lib\cron\CronInterface {

    /**
     * @var int
     */
    private $_dateTime = null;

    /**
     * @var int
     */
    protected $_limiteRepeticion = null;

    /**
     * @var int
     */
    protected $_valorMinimo = null;

    /**
     * @var bool
     */
    public $validacion = false;

    /**
     * @param int $dateTime
     * @param int $limiteRepeticion
     * @param int $valorMinimo
     */
    public function __construct($dateTime, $limiteRepeticion, $valorMinimo = 0) {
        $this->_dateTime = $dateTime;
        $this->_limiteRepeticion = $limiteRepeticion;
        $this->_valorMinimo = $valorMinimo;
    }

    /**
     * @param string $expresion
     * @return bool
     */
    public function validacion($expresion) {

        if($expresion == '*') {
            $this->validacion = true;
            return true;
        }

        $expParametro = explode(",", $expresion);

        foreach($expParametro as $exp) {
            $detalleExp = explode("/", $exp);

            // Si la excreción es continua ejp: 1-5
            if(preg_match("/-/", $detalleExp[0])) {
                $expContinua = explode("-", $exp);

                if($expContinua[0] < $expContinua[1]) {
                    while($expContinua[0] <= $expContinua[1]) {
                        if($expContinua[0] == $this->_dateTime) {
                            $this->validacion = true;
                            return true;
                        } elseif (isset($detalleExp[1]) == true){
                            if($this->frecuencia($expContinua[0], $detalleExp[1])){
                                $this->validacion = true;
                                return true;
                            }
                        }
                        $expContinua[0]++;
                    }
                }

            } else {
                if($detalleExp[0] == $this->_dateTime) {
                    $this->validacion = true;
                    return true;
                } elseif (isset($detalleExp[1]) == true) {
                    if($this->frecuencia($detalleExp[0], $detalleExp[1])){
                        $this->validacion = true;
                        return true;
                    }
                }
            }
        }
    }

    /**
     * @param int $expValor
     * @param int $expFrecuencia
     * @return bool
     */
    private function frecuencia($expValor, $expFrecuencia) {

        // Si el valor es igual (*), el valor sera igual a la frecuencia, ejemplo  */10 => 10/10
        if($expValor == "*"){
            $expValor = $expFrecuencia;
        }

        /*
         * Si el resido de la división entre el limite repetición y la frecuencia es diferente de 0.
         * el ciclo es infinito abarcando todas las posibilidades de la frecuencia. lo mismo
         * ocurre cuando la frecuencia es 1.
         */

        if(fmod($this->_limiteRepeticion, $expFrecuencia) != 0 || $expFrecuencia == 1) {
            $this->valido = true;
            return true;
        }

        $contadorFrecuencia = $this->_limiteRepeticion / $expFrecuencia;

        // Buscamo todos los valores arrojado por
        while($contadorFrecuencia > 0) {

            /*
             * v = ev + (c * f);
             */
            $valor = ($expValor + ($contadorFrecuencia * $expFrecuencia));

            if($valor > $this->_limiteRepeticion)
                $valor = $valor - $this->_limiteRepeticion;

            //En el caso de minuto seria cuando valor es igual a 60 valor reinicia a valor mínimo que es 0
            if($valor == $this->_limiteRepeticion)
                $valor = $this->_valorMinimo;

            if($this->_dateTime == $valor) {
                $this->valido = true;
                return true;
            }

            $contadorFrecuencia--;
        }

        return false;
    }

} 