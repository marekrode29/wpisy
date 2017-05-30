<?php

namespace App\Zephir;

use App\Test\TestInterface;
use App\Zephir\Func\AbstractFunc;
use App\Zephir\Func\Php;
use App\Zephir\Func\Zephir;
use App\Zephir\Slug\Generator;

class Slug
	implements TestInterface
{
	/** @var array */
	private $functions = [];
	
	/** @var int */
	private $times;
	
	/**
	 * @param $times
	 */
	public function __construct($times = 10000)
	{
		$this->times = $times;
	}
	
	private function init()
	{
		$this->functions = [new Php(), new Zephir()];
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function run()
	{
		$this->init();
		
		$scores = [];
		
		$counter = 1;
		
		/** @var AbstractFunc $function */
		foreach ($this->functions as $function)
		{
			$time = $this->perform($function);
			$scores[$time] = $this->buildDescription($function, $time, $counter++);
		}
		
		$min = min(array_keys($scores));
		$scores[$min] = sprintf('<span style="background-color: darkkhaki;">%s</span>', $scores[$min]);
		
		return sprintf('<h2>Calculations x %d</h2>', $this->times) . implode('<br />', $scores);
	}
	
	/**
	 * @param AbstractFunc $func
	 * @param $time
	 * @param $counter
	 * @return string
	 */
	private function buildDescription(AbstractFunc $func, $time, $counter)
	{
		return sprintf(
			"%d. <b>%s</b> &nbsp;&nbsp;&raquo;&nbsp;&nbsp; <i>%s</i> s.",
			$counter, $func->getName(),
			$time
		);
	}
	
	/**
	 * @param AbstractFunc $func
	 * @return string
	 */
	public function perform(AbstractFunc $func)
	{
		$timers = [];
		$times = $this->times;
		
		while ($times-- >= 0)
		{
			$time = $func->run();
			array_push($timers, $time);
		}
		$average = array_sum($timers)/count($timers);
		return number_format($average, 8, ',', ' ');
	}
}