<?php

namespace Core;

use Library;
class functions 
{
	public static function uploadFile($fileField)
	{
		$upload = new Library\Files\Upload();

		$upload->upload($fileField);
	}


	#===================if判断区域========================#
	
	public static function ifset($value, $t, $e = '\1')
	{
		return isset($value) ? $t : ('\1' == $e ? $value : $e);
	}
	
	public static function ifunset($value, $t, $e = '\1')
	{
		return !isset($value) ? $t : ('\1' == $e ? $value : $e);
	}
	#===================if判断区域========================#
}




