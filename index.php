<?php
//定义根目录
define('PATH_BASE', __DIR__ . DIRECTORY_SEPARATOR );
date_default_timezone_set('Asia/shanghai');
header("Content-type: text/html; charset=utf-8");
//加载配置文件
require_once PATH_BASE . 'Config/Config.php';

if (function_exists('spl_autoload_register')) {
    function __autoload($class)
    {   
        
        $classFile = PATH_BASE . $class . '.php';

        if (!file_exists($classFile)){
            $part = explode("\\", $class);
            $classFile = PATH_BASE . end($part) . '.php';
        }
        require_once $classFile;
    }
    spl_autoload_register('__autoload');
}

use Core\Router;
Router::route();


// var_dump($_SERVER);
// 
$includeFile = get_included_files();
var_dump($includeFile);
?>

