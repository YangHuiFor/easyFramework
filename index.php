<?php 

include_once './Library/Pager.php';
$page = new Pager(1,100,10,1);

$d= Pager::show();
?>
<!doctype html> 
<html> 
<head> 
    <meta charset="utf-8"> 
    <title></title> 
</head>
<body>
    <h1></h1>
    <?php echo Pager::show();?>
</body>
</html>
