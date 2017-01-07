<?php
abstract class AbstractView {

	protected $appFacade;
	protected $sectionInfo;
	protected $assignedVariables;

	private $styles = array();

	public function __construct(AppFacade $appFacade, SectionDTO $section) {

		$this->appFacade = $appFacade;
		$this->sectionInfo = $section;
		$this->assignedVariables = new stdClass();
	}

	public function assign($variableName, $value) {

		if(isset($this->assignedVariables->$variableName))
			throw new Exception('The \'' . $variableName . '\' cannot be overwritten.');

		$this->assignedVariables->$variableName = $value;
	}

	public function display($template) {

		$this->appFacade->assignSmartyVariable("title", $this->sectionInfo->title);
		$this->appFacade->assignSmartyVariable('styles', $this->styles);

		$this->appFacade->displayTemplate($template);
	}

	public function addExternalScripts($scripts) {

		$this->appFacade->assignSmartyVariable('scripts', $scripts);
	}

	public function addStyles($styles) {

		if(!is_array($styles))
			$this->styles = array_merge((array) $styles, $this->styles);
		else
			$this->styles = array_merge($styles, $this->styles);
	}
}
