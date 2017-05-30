<?php

namespace App\Zephir\Func;

use Ayeo\Price\Price;

class Php
	extends AbstractFunc
{
	protected function perform()
	{
		$price1 = new Price(100, 123, 'PLN');
		$price2 = new Price(10, 12.3, 'PLN');
		$price3 = new Price(20, 24.6, 'PLN');
		$price4 = new Price(50, 61.5, 'PLN');
		
		$price1->add($price2)->subtract($price3)->add($price4)->multiply(2);
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'Php\Price';
	}
}