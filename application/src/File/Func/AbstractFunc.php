<?php

namespace App\File\Func;

abstract class AbstractFunc
{
	/**
	 * @param string $filename
	 * @return bool
	 */
	abstract protected function perform($filename);
	
	/**
	 * @return string
	 */
	abstract public function getName();
	
	/**
	 * @param string $filename
	 * @return float|int
	 */
	public function run($filename)
	{
		$start = microtime(true);
		
		$this->perform($filename);
		
		clearstatcache();
		
		return microtime(true) - $start;
	}
}