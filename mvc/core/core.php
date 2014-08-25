<?php
    
    require CORE. 'classes' . DIRECTORY_SEPARATOR . 'autoloader.php';
    
    class_alias('\Core\Classes\Autoloader', 'Autoloader');
    
    $loader = new Autoloader();

    $loader->register();

    $loader->addNamespace('Core\Classes', CORE. 'classes');
    
    Autoloader::setAliases(array(
        'MSSQL'             => 'Core\\Classes\\DB\\MSSQL',
        'Controller'        => 'Core\\Classes\\CoreController',
        'HttpRequest'       => 'Core\\Classes\\HttpRequest',
        'Model'             => 'Core\\Classes\\CoreModel',
        'View'              => 'Core\\Classes\\CoreView',
        'ErrorHandling'     => 'Core\\Classes\\ErrorHandling',
    ));
    
    
    set_exception_handler(array('ErrorHandling', 'handler'));
