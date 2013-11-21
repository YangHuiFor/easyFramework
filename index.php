<?php 

include_once './Library/Pager.php';
$p = isset($_GET['p']) ? $_GET['p'] : 1;
$page = new Pager($p,100,5,1);


?>
<!doctype html> 
<html> 
<head> 
    <meta charset="utf-8"> 
    <title></title> 
</head>
<body>
	<style type="text/css">
		.page{padding: 5px;border: 1px dashed  #000;}
		.page label{margin: 3px;width:20px;display: inline-block;}
		a {text-decoration: none;}
	</style>
    <h1></h1>
    <?php echo Pager::show();?>

    <br/>
    <?php 
    $page2 = new Pager($p,100,5,2);
    echo Pager::show();
    ?>

</body>
</html>
