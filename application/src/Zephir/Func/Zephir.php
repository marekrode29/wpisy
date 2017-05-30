<?php

namespace App\Zephir\Func;

class Zephir
	extends AbstractFunc
{
	protected function perform()
	{
		$price1 = new \ISystems\Price\Container(100, 123, 'PLN');
		$price2 = new \ISystems\Price\Container(10, 12.3, 'PLN');
		$price3 = new \ISystems\Price\Container(20, 24.6, 'PLN');
		$price4 = new \ISystems\Price\Container(50, 61.5, 'PLN');
		
		$price1->add($price2)->subtract($price3)->add($price4)->multiply(2);
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'Zephir\Price';
	}
}