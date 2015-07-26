<?php
class Learn_Placeorderexport_Model_Dropdown_Type extends Mage_Core_Model_Abstract
{
	public function toOptionArray()
	{
		return array(
			array(
				'value' => 'csv',
				'label' => 'CSV',
			),
			array(
				'value' => 'txt',
				'label' => 'Text',
			),
		);
	}
}