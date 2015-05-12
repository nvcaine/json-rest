<?php
class SettingsManager
{
	protected $settingsFileName = "";
	protected $settings;

	private $sectionsInfo = array();
	private $defaultSection = "";
	private $mainTemplateName = "";
	//	private $sectionsFolder = "";
	private $appURL = "";

	public function __construct($settingsFileName)
	{
		$this->settingsFileName = $settingsFileName;
	}

	public function loadSettings()
	{
		$json = json_decode(file_get_contents($this->settingsFileName));

		$this->parseSettings($json);
	}

	public function getSections()
	{
		return $this->sectionsInfo;
	}

	public function getSectionByName($sectionName)
	{
		foreach ($this->sectionsInfo as $sectionInfo)
			if ($sectionInfo->name == $sectionName)
				return $sectionInfo;

		//return null;
		throw new Exception("Unknown section name: " . $sectionName, 1);
	}

	public function getDefaultSection()
	{
		return $this->defaultSection;
	}

	/*public function getMainTemplateName()
	{
		return $this->mainTemplateName;
	}*/

	/*public function getSectionsFolder()
	{
		return $this->sectionsFolder;
	}*/

	public function getAppURL()
	{
		return $this->appURL;
	}

	protected function parseSettings($xml)
	{
		$this->parseSections($xml);
		$this->parseGlobalSettings($xml);
	}

	protected function parseSections($xml)
	{
		foreach($xml->sections as $section)
		//foreach ($xml->sections->section as $section)
			$this->sectionsInfo[] = new SectionDTO($section);
	}

	protected function parseGlobalSettings($xml)
	{
		$this->defaultSection = (string)$xml->defaultSection;
		//$this->sectionsFolder = (string)$xml->sectionsFolder;
		//$this->mainTemplateName = (string)$xml->mainTemplateName;

		$this->appURL = (string)$xml->appURL;
	}
}

?>