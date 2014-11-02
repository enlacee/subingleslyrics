<?php
/**
* Boostrap for libraryes by (install composer)
* start include your namespace that package
*
**/

include "vendor/autoload.php";

// initialize librarys or Tool
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('log.log', Logger::WARNING));
// add records to the log
$log->addWarning('Foo');
$log->addError('Bar');