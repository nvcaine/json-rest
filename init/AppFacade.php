<?php
class AppFacade
{
	protected $settingsManager;

	private $_currentPage = "";

	public function __construct(SettingsManager $settingsManager)
	{
		$this->settingsManager = $settingsManager;
		$this->settingsManager->loadSettings();
	}

	public function getDefaultSection()
	{
		return $this->settingsManager->getDefaultSection();
	}

	public function getCurrentPage()
	{
		return $this->_currentPage;
	}

	public function getAppURL()
	{
		return $this->settingsManager->getAppURL();
	}

	public function getSections()
	{
		return $this->settingsManager->getSections();
	}

	public function handleSectionRequest($section)
	{
		$section = $this->settingsManager->getSectionByName($section);

		$this->runSectionController($section);
	}

	public function getCurrentSection($sectionParamName)
	{
		if (isset($_GET[$sectionParamName]))
			return strtolower($_GET[$sectionParamName]);

		return $this->getDefaultSection();
	}

	protected function runSectionController(SectionDTO $section)
	{
		$controllerClassName = ucfirst($section->name) . "Section";

		$section = new $controllerClassName($this, $view);
		$section->run();
	}
}
?>