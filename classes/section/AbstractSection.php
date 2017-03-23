<?php
abstract class AbstractSection
{
	protected $appFacade;

	public function __construct(AppFacade $facade) {

		$this->appFacade = $facade;
	}

	public function run() {

		$this->setHeader();

		if(!isset($_SERVER["REQUEST_METHOD"]))
			return;

		$requestParams = array();
		parse_str(file_get_contents("php://input"), $requestParams);

		switch($_SERVER["REQUEST_METHOD"])
		{
			case "GET": $this->runGetMethod($_GET); break;
			case "POST": $this->runPostMethod($_POST); break;
			case "PUT": $this->runPutMethod($requestParams); break;
			case "DELETE": $this->runDeleteMethod($requestParams); break;
		}
	}

	public function runGetMethod($params) {}

	public function runPostMethod($params) {}

	public function runPutMethod($params) {}

	public function runDeleteMethod($params) {}

	protected function setHeader() {
		header("Content-type: application/json");
	}
}