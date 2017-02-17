<?php
include_once(__DIR__ . '/autoloader.class.php');
use company\alias\autoloader\Autoloader;

$auto = Autoloader::getInstance();
spl_autoload_register(array($auto,'loadClass'),true,true);
?>
