<?php
error_reporting( E_ALL );

define('APPURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['SCRIPT_NAME'], 0, -strlen('index.php')));
define('APPPATH', __DIR__ . DIRECTORY_SEPARATOR);

// AUTOLOAD ALL THE THINGS!!!
spl_autoload_register(function ($class) {

    $vendor = 'JCC\\';
    // Is the class part of this app?
    $len = strlen($vendor);
    if (strncmp($vendor, $class, $len) !== 0) {
        // If not, move to the next registered autoloader.
        return;
    }

    $nameSegments = explode('\\', str_replace($vendor, '', $class));

    $file = APPPATH . implode('/', $nameSegments) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    } else {
        exit('Could not find file: '.$file);
    }
});

// ROUTE ALL THE REQUESTS!!!
\JCC\Controllers\Route::process();