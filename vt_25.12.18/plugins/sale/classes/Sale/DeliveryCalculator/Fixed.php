<?php
namespace Sale\DeliveryCalculator;

class Fixed extends CalculatorAbstract {
	
	public static function getInfo()
	{
		$t = \Cetera\Application::getInstance()->getTranslator();
		
		return array(
			'name'   => $t->_('Фиксированная стоимость'),
			'params' => array(
				array(
					'name'       => 'cost',
					'xtype'      => 'numberfield',
					'fieldLabel' => $t->_('Стоимость доставки'),
					'value'      => 100,
					'step'       => 100,
				)
			)
		);
	}
		
	public function calculate()
	{
		return (float)$this->params['cost'];
	}	
	
}
