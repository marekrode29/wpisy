<?php

namespace App\File\Func;

class IsWritable
	extends AbstractFunc
{
	/**
	 * @param string $filename
	 * @return bool
	 */
	protected function perform($filename)
	{
		return is_writable($filename);
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'is_writable';
	}
}