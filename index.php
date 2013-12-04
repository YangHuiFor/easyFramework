<?php
//定义根目录
define('PATH_BASE', __DIR__ . DIRECTORY_SEPARATOR );
date_default_timezone_set('Asia/shanghai');
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



 use Library\Files as files;
 use Library\Pager;
 use Library\Test\Test;
 use Core\functions;
 //分页
 // $Pager = new Pager(1,1,1,1);

// $test = new Test();
// var_dump($test->say());
if (isset($_POST['form_submit'])) {
    var_dump($_POST);
    functions::uploadFile('userfile');
}

var_dump(get_included_files());
?>
<!doctype html> 
<html> 
<head> 
    <meta charset="utf-8"> 
    <title></title> 
</head>
<body>
    <form enctype="multipart/form-data" action="" method="POST">
    <!-- maximum size for userfile1 is 30000 bytes -->
    <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> -->
    Send this file: <input name="userfile" type="file" />
    <input type="hidden" name="form_submit" value="1" />
    <input type="submit" value="Send File" />
</form>

</body>
</html>
