<?php

    require '../vendor/autoload.php';

    $app = new \Slim\App;

    $files = scandir('../controller');

    // Load all controllers
    foreach ($files as $key => $value) {
        if (!is_dir($value)) {
            require '../controller/'.$value;

            $class = ucfirst(explode('.', $value)[0]) . 'Controller';
            $obj = new $class($app);
        }
    }

    $app->run();

?>
