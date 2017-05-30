<?php

namespace App\File;

use App\File\Func\AbstractFunc;
use App\File\Func\FileExists;
use App\File\Func\IsFile;
use App\File\Func\IsLink;
use App\File\Func\IsReadable;
use App\File\Func\IsWritable;
use App\File\Func\StreamAndFile;
use App\File\Func\StreamResolve;
use App\Test\TestInterface;

class Exists
	implements TestInterface
{
	/** @var array */
	private $files = [];
	
	/** @var array */
	private $functions = [];
	
	/** @var int */
	private $times;
	
	/**
	 * @param $times
	 */
	public function __construct($times = 20000)
	{
		$this->times = $times;
	}
	
	private function init()
	{
		$this->files = array_values(include_once '/Users/mrode/Documents/workspace/51015kids/application/tmp/var/class_map.php');
		$this->files = array_merge($this->files, array_values(include_once '/Users/mrode/Documents/workspace/51015kids/vendor/composer/autoload_classmap.php'));
		
		$this->files = array_merge($this->files, array_values(include_once '/Users/mrode/Documents/workspace/fabrykacen/application/tmp/var/class_map.php'));
		$this->files = array_merge($this->files, array_values(include_once '/Users/mrode/Documents/workspace/fabrykacen/vendor/composer/autoload_classmap.php'));
		
		$this->functions = [new IsFile(), new IsLink(), new FileExists(), new IsReadable(), new IsWritable(), new StreamResolve()];
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function run()
	{
		$this->init();
		
		$tests = [];
		
		$tests[] = sprintf('<h2>Existing Files x %d</h2>', $this->times);
		$tests[] = $this->test1();
		
		$tests[] = '<br />';
		
		$tests[] = sprintf('<h2>Non Existing Files x %d</h2>', $this->times);
		$tests[] = $this->test2();
		
		return implode('', $tests);
	}
	
	private function test1()
	{
		$scores = [];
		
		$counter = 1;
		
		/** @var AbstractFunc $function */
		foreach ($this->functions as $function)
		{
			$time = $this->performExistingFile($function);
			$scores[$time] = $this->buildDescription($function, $time, $counter++);
		}
		
		$min = min(array_keys($scores));
		$scores[$min] = sprintf('<span style="background-color: darkkhaki;">%s</span>', $scores[$min]);
		
		return implode('<br />', $scores);
	}
	
	private function test2()
	{
		$scores = [];
		
		$counter = 1;
		
		/** @var AbstractFunc $function */
		foreach ($this->functions as $function)
		{
			$time = $this->performNonExistingFile($function);
			$scores[$time] = $this->buildDescription($function, $time, $counter++);
		}
		
		$min = min(array_keys($scores));
		$scores[$min] = sprintf('<span style="background-color: darkkhaki;">%s</span>', $scores[$min]);
		
		return implode('<br />', $scores);
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
	 * @return string
	 */
	private function getFile()
	{
		$key = array_rand($this->files, 1);
		return $this->files[$key];
	}
	
	/**
	 * @param AbstractFunc $func
	 * @return string
	 */
	public function performExistingFile(AbstractFunc $func)
	{
		$timers = [];
		$times = $this->times;
		
		while ($times-- >= 0)
		{
			$time = $func->run($this->getFile());
			array_push($timers, $time);
		}
		$average = array_sum($timers)/count($timers);
		return number_format($average, 8, ',', ' ');
	}
	
	/**
	 * @param AbstractFunc $func
	 * @return string
	 */
	public function performNonExistingFile(AbstractFunc $func)
	{
		$timers = [];
		$times = $this->times;
		
		while ($times-- >= 0)
		{
			$file = $this->getFile() . time();
			$time = $func->run($file);
			array_push($timers, $time);
		}
		$average = array_sum($timers)/count($timers);
		return number_format($average, 8, ',', ' ');
	}
}