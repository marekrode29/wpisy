<?php

namespace App\File\Func;

class StreamResolve
	extends AbstractFunc
{
	/**
	 * @param string $filename
	 * @return bool
	 */
	protected function perform($filename)
	{
		return stream_resolve_include_path($filename);
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'stream_resolve_include_path';
	}
}