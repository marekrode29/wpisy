<?php

namespace App\File\Func;

class StreamAndFile
	extends AbstractFunc
{
	/**
	 * @param string $filename
	 * @return bool
	 */
	protected function perform($filename)
	{
		return file_exists(
			stream_resolve_include_path($filename)
		);
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'file_exists + stream_resolve_include_path';
	}
}