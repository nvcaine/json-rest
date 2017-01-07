<?php
class AbstractProxy
{
	protected $db;

	public function __construct(DBWrapper $dbInstance = null)
	{
		$this->db = $dbInstance;
	}

	/*protected function parseRecords($records, $dtoClass)
	{
		$result = array();
		
		foreach ($records as $value)
			$result[] = new $dtoClass($value);

		return $result;
	}

	protected function addDataXML($rows, DOMDocument $dom, $xmlItemName)
	{
		$items = $dom->createElement("items");

		foreach ($rows as $value)
		{
			// needs custom xml parser due to photos array
			$item = $value->toXML($dom, $xmlItemName);
			//print_r($item);
			//die;
			$items->appendChild(dom_import_simplexml($item));
		}

		$dom->appendChild($items);
	}

	protected function outputData($items, $targetClassName, DOMDocument $dom, $xmlItemName)
	{
		$data = $this->parseRecords($items, $targetClassName);

		$this->addDataXML($data, $dom, $xmlItemName);

		return $dom->saveXML();
	}

	protected function outputDataJSON($items, $targetClassName)
	{
		$data = $this->parseRecords($items, $targetClassName);

		return $this->getDataJSON($data);
	}

	protected function getDataJSON($rows)
	{
		$result = array();

		foreach($rows as $value)
			$result[] = $value->toJSON();

		return json_encode($result);
	}*/
}
?>