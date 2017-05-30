<?php

namespace App\File\Func;

class IsLink
	extends AbstractFunc
{
	/**
	 * @param string $filename
	 * @return bool
	 */
	protected function perform($filename)
	{
		return is_link($filename);
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'is_link';
	}
}