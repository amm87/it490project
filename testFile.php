#!/usr/bin/php
<?php

require_once("login.php.inc");
$login = new logindb();
$output = $login->validateLogin("test", "abc");
if ($output)
{
	echo "login successful".PHP_EOL;
}
else
{
	echo "login failed".PHP_EOL;
}
?>
