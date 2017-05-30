<?php

namespace App\File\Func;

class FileExists
	extends AbstractFunc
{
	/**
	 * @param string $filename
	 * @return bool
	 */
	protected function perform($filename)
	{
		return file_exists($filename);
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'file_exists';
	}
}