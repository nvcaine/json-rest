<?php
class SectionDTO
{
	public $name;
	public $title;
	public $menuLabel;

	public function __construct($obj = null)
	{
		if ($obj != null)
			$this->parseObj($obj);
	}

	protected function parseObj($xml)
	{
		$this->name = $xml->sectionName;
		$this->title = $xml->title;

		if(isset($xml->menuLabel))
			$this->menuLabel = $xml->menuLabel;
	}
}

?>