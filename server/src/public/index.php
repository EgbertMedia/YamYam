<?php

    require '../vendor/autoload.php';

    $app = new \Slim\App;

    $files = scandir('../controller');

	spl_autoload_register(function($class) {
        if (file_exists('../model/'.lcfirst($class).'.php')) {
            require_once '../model/'.lcfirst($class).'.php';
        }

        if ($class === 'RestController' && !class_exists('RestController')) {
            require_once '../controller/rest.php';
        }
	});

    // Load all controllers
    foreach ($files as $key => $value) {
        if (!is_dir($value) && $value != 'rest.php') {
            require '../controller/'.$value;

            $class = ucfirst(explode('.', $value)[0]) . 'Controller';
            $obj = new $class($app);
        }
    }

    $app->run();

?>
