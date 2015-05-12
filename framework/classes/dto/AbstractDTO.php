<?php
class AbstractDTO
{
	public function __construct($data)
	{
		$this->parse($data);
	}

	public function toXML(DOMDocument $dom, $xmlItemName)
	{
		if($xmlItemName == "")
			throw new Exception("No XML item name specified for DTO class " . get_class($this) . " !", 1);
			
		/*$xml = $dom->createElement($xmlItemName);

		foreach ($this->getClassVars() as $key => $value)
		{
			if(is_array($this->$key))
			{
				$rootItemName = substr($key, 0, strlen($key) - 1);
				$root = $dom->createElement($key);

				foreach($this->$key as $item)
					$root->appendChild($dom->createElement($rootItemName, $item->toXML()));

				$xml->appendChild($root);
			}
			else
			{
				$xml->appendChild($dom->createElement($key, $this->$key));
			}
		}*/
		//print_r($this);
		//die;
		$xml = new SimpleXMLElement("<" . $xmlItemName . " />");

		//print_r(get_object_vars($this));
		//die;
		array_walk_recursive(get_object_vars($this), array($xml, 'addChild'));


		return $xml;
	}

	public function toJSON()
	{
		return json_encode($this); 
	}

	protected function parse($data)
	{
		$vars = $this->getClassVars();

		foreach ($vars as $key => $value)
			if(isset($data[$key]))
				$this->$key = $data[$key];
	}

	protected function getClassVars()
	{
		return get_class_vars(get_class($this));
	}
}
?>