<?php
class AppFacade
{
	protected $smarty;
	protected $settingsManager;

	private $_currentPage = "";

	public function __construct(SettingsManager $settingsManager)
	{
		$this->settingsManager = $settingsManager;
		$this->settingsManager->loadSettings();
		$this->initSmarty();
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

	public function assignSmartyVariable($variableName, $value)
	{
		$this->smarty->assign($variableName, $value);
	}

	public function displayTemplate($templateName)
	{
		$this->smarty->display($templateName . ".tpl");
	}

	protected function runSectionController(SectionDTO $section)
	{
		$controllerClassName = ucfirst($section->name) . "Section";
		$viewClassName = ucfirst($section->name) . "View";

		$view = new $viewClassName($this, $section);

		$section = new $controllerClassName($this, $view);
		$section->run();
	}

	protected function initSmarty()
	{
		$this->smarty = $this->getSmartyInstance();
		$this->assignSmartyVariable("appURL", $this->getAppURL()); // global Smarty variable - accessible from every template
	}

	protected function getSmartyInstance()
	{
		$smarty = new Smarty();

		$smarty->template_dir = "app/views/templates";
		$smarty->compile_dir = "app/views/templates/compile";
		$smarty->cache_dir = "libs/smarty/cache";
		$smarty->config_dir = "libs/smarty/configs";

		return $smarty;
	}
}

?>