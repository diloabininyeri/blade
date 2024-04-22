<?php


use Zeus\Blade\Blade;

require_once 'vendor/autoload.php';



echo Blade::in(__DIR__.'/blade')
    ->renderFile('test.blade.php');







