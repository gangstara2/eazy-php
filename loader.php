<?php

if (PHP_VERSION < 5.3) {
    exit('Please update your PHP before use (PHP > 5.3)');
}

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName = '';
    $namespace = '';
    if ($lastNsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    require str_replace('index.php', $fileName, $_SERVER['SCRIPT_FILENAME']);
}

spl_autoload_register('autoload');
$Settings = new Library\Configs\Settings();
$Settings->getVariables();
$connection = new Library\Core\Connection();
$connection->connectDb();
if ($_GET['end'] == 'admin') {
    $AdminRouter = new Controllers\Admin\Router\AdminRouter();
    $AdminRouter->dispatchPage($url);
} elseif ($_GET['end'] == 'api') {
    $ApiRouter = new Controllers\Api\Router\ApiRouter();
    $ApiRouter->dispatchPage($url);
} else {
    $AppRouter = new Controllers\Application\Router\AppRouter();
    $AppRouter->dispatchPage($url);
}