<?php
define('PATH_BASE', __DIR__ . DIRECTORY_SEPARATOR );
require_once PATH_BASE . 'Config/Config.php';

use Core\functions;
var_dump(get_included_files());
$functions = new functions();
// functions::uploadFile(1);
$functions->uploadFile(1);
if (isset($_POST['form_submit'])) {

    // $tempfile = get_cfg_var('upload_tmp_dir');
    // var_dump($_FILES);
    // // $uploadfile = PATH_DOWN . md5($_FILES['userfile']['name']) .'.jpg';
    // $uploadfile = PATH_DOWN . date("YmdHis") .'.jpg';
    // if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {

    //     if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    //         echo "success";
    //     } else {
    //         echo 'failed';
    //     }
    //     exit();
    // } else {
    
    // }
    
}
 
?>

<!doctype html> 
<html> 
<head> 
    <meta charset="utf-8"> 
    <title></title> 
</head>
<body>
	<form enctype="multipart/form-data" action="http://www.yanghui.me/upload.php" method="POST">
    <!-- maximum size for userfile1 is 30000 bytes -->
    <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> -->
    Send this file: <input name="userfile" type="file" />
    <input type="hidden" name="form_submit" value="1" />
    <input type="submit" value="Send File" />
</form>

</body>
</html>