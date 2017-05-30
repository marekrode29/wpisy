<?php

namespace App\File\Func;

class IsReadable
	extends AbstractFunc
{
	/**
	 * @param string $filename
	 * @return bool
	 */
	protected function perform($filename)
	{
		return is_readable($filename);
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'is_readable';
	}
}