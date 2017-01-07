<?php
abstract class AbstractView
{
	protected $appFacade;
	protected $sectionInfo;

	public function __construct(AppFacade $appFacade, SectionDTO $section)
	{
		$this->appFacade = $appFacade;
		$this->sectionInfo = $section;
	}

	public function assign($variableName, $value)
	{
		$this->appFacade->assignSmartyVariable($variableName, $value);
	}

	public function setTemplate()
	{
		// figure out how not to hard-code the param
		$this->appFacade->assignSmartyVariable("page", $this->sectionInfo->templateName);
		$this->appFacade->assignSmartyVariable("pageTitle", $this->sectionInfo->title);
	}
}
