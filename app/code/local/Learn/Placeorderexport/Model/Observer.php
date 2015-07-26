<?php
class Learn_Placeorderexport_Model_Observer extends Varien_Event_Observer
{
	public function exportOrder($observer)
	{
		$order = $observer->getEvent()->getOrder();
		$orderIncrementId = $order->getIncrementId();
		$orderData = Mage::getModel('sales/order')->loadByIncrementId($orderIncrementId)->getData();

		/*- Storing Folder -*/
		$helper = Mage::helper('placeorderexport');
		if(!$helper->placeorderexport_enable()) {
			return false;
		}
		$saveDirectory =  $helper->placeorderexport_path();
		$filename = $helper->placeorderexport_pname();
		$type = $helper->placeorderexport_type();		
		
		$filename = $baseDirectory.$saveDirectory."/".$filename;
		
		/* $saveDirectory = "/var/export/cron_export/"; */
		$baseDirectory = Mage::getBaseDir()."/";
		$saveDirectory = trim($saveDirectory, '/');
		$newDirectory = "";
		foreach(explode('/',$saveDirectory) as $val) {
			if(!is_dir($baseDirectory.$newDirectory.$val)){
				mkdir($baseDirectory.$newDirectory.$val, 0755);
				chmod($baseDirectory.$newDirectory.$val, 0755);
			}
			$newDirectory .= $val."/";
		}
		if($type == "csv") {
			$this->CsvExport($filename, $orderData);
		} else if($type == "txt") {
			$this->txtExport($filename, $orderData);
		}
		
	}
	
	public function txtExport($filename, $orderData) {
		$filename .= "_".date('dmY-His').".txt";
		$data = "";
		foreach($orderData as $key => $value ) {
			$data .= $key." = ".$value."\n";		
		}
		if($data != "") {
			file_put_contents($filename, $data, FILE_APPEND | LOCK_EX);
		}
	}
	
	public function CsvExport($filename, $orderData) {
		$filename .= "_".date('dmY-His').".csv";
		foreach($orderData as $key => $value ) {
			$labelArray .= $key.",";
			$valueArray .= $value.",";		
		}
		$labelArray = substr($labelArray, 0, -1);
		$valueArray = substr($valueArray, 0, -1);
		$data[] = array_combine(explode(",", $labelArray), explode(",", $labelArray));
		$data[] = array_combine(explode(",", $labelArray), explode(",", $valueArray));
		
		if(count($data) > 0 ) {
			$fp = fopen($filename, 'w');
			foreach ($data as $product) {
				fputcsv($fp, $product);
			}
			fclose($fp);
		}
	}
}