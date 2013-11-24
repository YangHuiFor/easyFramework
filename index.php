<?php
//定义根目录
define('PATH_BASE', __DIR__ . DIRECTORY_SEPARATOR );

//加载配置文件
require_once PATH_BASE . 'Config/Config.php';

if (function_exists('spl_autoload_register')) {
    function __autoload($class)
    {   
        
        $classFile = PATH_BASE . $class . '.php';

        if (!file_exists($classFile)){
            $part = explode("\\", $class);
            var_dump($class);
            echo 1;
            $classFile = PATH_BASE . end($part) . '.php';
        }
        require_once $classFile;
    }
    spl_autoload_register('__autoload');
}



 use Library\Files as files;
 use Library\Pager;
 use Library\Test\Test;
 $Pager = new Pager(1,1,1,1);

$test = new Test();
var_dump($test->say());
var_dump(get_included_files());
