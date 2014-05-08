<?php

$date = new DateTime('now');
echo $date->format('d/m/y H:i:s');

for($i = 0; $i < 10 ; $i ++){
    echo "\n" . 'sobreescritura' . $i;
    sleep(5);
}

echo "\n" . 'fin';