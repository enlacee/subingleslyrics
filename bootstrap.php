<?php
/**
* Boostrap for libraryes by (install composer)
* start include your namespace that package
*
**/

include "vendor/autoload.php";

// initialize librarys or Tool
/*use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('log.log', Logger::WARNING));
// add records to the log
$log->addWarning('Foo');
$log->addError('Bar');
/*

// init HASHID
//$hashids = new Hashids\Hashids('this is my salt SubInglesLyrics.com');
/*$hashids = new Hashids\Hashids(
    'this is my salt SubInglesLyrics.com',  4,
    '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
);
$id = $hashids->encode(1);
$numbers = $hashids->decode($id);

var_dump($id, $numbers);
*/