<?php
/**
 * User: Rudys Natanael Acosta Crousset
 * Date: 05/01/14
 * Time: 09:53 AM
 */

namespace lib\cron;

/**
 * @see Minuto
 */
require_once 'Minuto.php';
use \lib\cron\Minuto as Minuto;

/**
 * Class Cron
 * @package lib
 * @author Rudys Natanael Acosta Crousset <natanael926@gmail.com>
 */
class Cron {

    /**
     * @var Cron
     */
    private static $_instance = null;

    /**
     * Instancia de la clase.
     *
     * @return Cron
     */
    public static function getInstance() {

        if(self::$_instance == null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * @param $exprecion
     */
    public function getAprobacion($exprecion) {

        $fecha = new \DateTime('now');
//        $fecha = $fecha->format("d/m/y H:i:s");

        $exprecionCron = explode(" ", $exprecion);


        $minuto = Minuto::getInstance()->init($fecha, $exprecionCron[0]);


    }

} 