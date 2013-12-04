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
}




