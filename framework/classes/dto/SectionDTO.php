<?php
class SectionDTO
{
	public $name;
	//public $templateName;
	//public $title;

	public function __construct($obj = null)
	{
		if ($obj != null)
			$this->parseObj($obj);
	}

	protected function parseObj($xml)
	{
		$this->name = $xml->sectionName;
		//$this->templateName = $xml->templateName;
		//$this->title = $xml->title;
	}
}

?>