#!/usr/bin/php
<?php

require_once("register.php.inc");

$register = new registerdb();
$register->registerUser('test4','123456','bobby','bob','test@test.com');
 //echo $register->getClientId('test3').PHP_EOL;
?>