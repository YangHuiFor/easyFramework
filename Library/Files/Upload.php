<?php
/**
 *文件上传
 *
 * @author yanghuinobody@qq.com 
 * @createtime 2013-12-4 22:42:19
 * @version 
 */
namespace Library\Files;

class Upload 
{
	//html file input name
	protected $fileField;

	//上传文件的临时名称
	protected $tmpName;

	//上传文件的原名称
	protected $orgiFileName;

	//新的文件名称
	protected $newFileName;

	//上传文件存放路径
	protected $filePath;

	//上传文件最大size, 默认1M
	protected $fileMaxSize = 1000000;

	//上传文件的类别, 待完善
	protected $fileType = array('image', 'text', 'flash');
	//上传文件的有效后缀, 待完善
	protected $fileExt = array('jpg', 'png', 'gif', 'jpeg');

	//错误代码
	protected $errorCode ;

	//错误代码文本
	protected $errorMessage ;

	function __construct()
	{
		# code...
	}

	public function upload($fileField)
	{
		$uploadfile = PATH_DOWN . date("YmdHis") .'.jpg';
		if (is_uploaded_file($_FILES[$fileField]['tmp_name'])) {
	        if (move_uploaded_file($_FILES[$fileField]['tmp_name'], $uploadfile)) {
	            echo "success";
	        } else {
	            echo 'failed';
	        }
    	}
	}
}

?>