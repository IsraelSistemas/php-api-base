<?php

    require_once '../vendor/autoload.php';
    require_once '../config/conection.php';
    
    $app = new \Slim\App;
    
    require_once '../routes/routes.php';

    $app -> run();

?>