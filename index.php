<?php

require_once __DIR__ . '/lib/Cron/Cron.php';
use \lib\cron\Cron as Cron;

Cron::getInstance()->getAprobacion("4-8/5 25/6 25/2 5/6 7");

//var_dump(preg_match("/,/", "h5,/5,"));

