<?php

namespace App\File\Func;

class IsFile
	extends AbstractFunc
{
	/**
	 * @param string $filename
	 * @return bool
	 */
	protected function perform($filename)
	{
		return is_file($filename);
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'is_file';
	}
}