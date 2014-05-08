<?php
/**
 * Created by PhpStorm.
 * User: rudys
 * Date: 05/06/14
 * Time: 12:44 PM
 */

namespace lib\reporte;


class ColaTarea {

    public static function validacion($idReporte) {

        $urlA = "/var/www/html/reporte-automatizado-script/archivoColaTarea/" . $idReporte . ".txt";

        $fp = fopen($urlA, "r");

         if($fp){
             while (!feof($fp)){
                 $fila[] = fgets($fp,9999);
             }
             fclose($fp);
         }else{
             return true;
         }

         if($fila[count($fila)-1] == "fin") {
             return true;
         }else{
             return false;
         }

    }


} 