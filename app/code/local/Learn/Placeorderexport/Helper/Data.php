<?php
class Learn_Placeorderexport_Helper_Data extends Mage_Core_Helper_Abstract 
{
	const XML_PATH_POE_ENABLE   = 'placeorderexport_tab/placeorderexport_setting/placeorderexport_active';
	const XML_PATH_POE_PATH		= 'placeorderexport_tab/placeorderexport_setting/placeorderexport_path';
	const XML_PATH_POE_TYPE		= 'placeorderexport_tab/placeorderexport_setting/placeorderexport_type';
	const XML_PATH_POE_PNAME		= 'placeorderexport_tab/placeorderexport_setting/placeorderexport_pname';
	
	public function conf($code, $store = null) {
        return Mage::getStoreConfig($code, $store);
    }
	
	public function placeorderexport_enable() {
		return $this->conf(self::XML_PATH_POE_ENABLE, $store);
	}
	
	public function placeorderexport_path() {
		return $this->conf(self::XML_PATH_POE_PATH, $store);
	}
	
	public function placeorderexport_type() {
		return $this->conf(self::XML_PATH_POE_TYPE, $store);
	}
	
	public function placeorderexport_pname() {
		return $this->conf(self::XML_PATH_POE_PNAME, $store);
	}
}
