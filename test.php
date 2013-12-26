<?php

try {
   $obj = new ReflectionClass('Phalcon\Mvc\Application');
} catch (Exception $e) {
    var_dump($e);
    throw new Exception($e->message, 1);
}
