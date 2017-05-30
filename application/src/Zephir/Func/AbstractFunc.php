<?php

namespace App\Zephir\Func;

abstract class AbstractFunc
{
	abstract protected function perform();
	
	/**
	 * @return string
	 */
	abstract public function getName();
	
	/**
	 * @return float|int
	 */
	public function run()
	{
		$start = microtime(true);
		
		$this->perform();
		
		clearstatcache();
		
		return microtime(true) - $start;
	}
}