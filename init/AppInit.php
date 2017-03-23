<?php
class AppInit
{
	public function __construct($appFolder)
	{
		/*$this->importClass("framework/init/SettingsManager.php");
		$this->importClass("framework/init/AppFacade.php");
		$this->importClass("framework/init/DBWrapper.php");

		$this->loadFromFolder("framework/classes/interface");
		$this->loadFromFolder("framework/classes/dto");
		$this->loadFromFolder("framework/classes/proxy");
		$this->loadFromFolder("framework/classes/section");*/

		$this->loadFromFolder($appFolder);
	}

	public function loadFromFolder($appFolder)
	{
		//echo "----".$appFolder."<br />";
		$ignore = array('cgi-bin',
						'.svn',
						'templates',
						'compile',
						'.',
						'..',
						'.git',
						'README.md');

		$this->parseFolderItems($appFolder, $ignore);

	}

	protected function importClass($pathToFile)
	{
		//echo $pathToFile."<br />";
		return require_once($pathToFile);
	}

	protected function parseFolderItems($appFolder, $ignoredItems)
	{
		$dirHandler = @opendir($appFolder);

		while (false !== ($file = readdir($dirHandler)))
		{
			$this->parseFileItem($file, $appFolder, $ignoredItems);
		}

		closedir($dirHandler);
	}

	private function parseFileItem($file, $appFolder, $ignoredItems)
	{
		if (!in_array($file, $ignoredItems))
		{
			if (is_dir("$appFolder/$file"))
				$this->loadFromFolder("$appFolder/$file");
			else
				$this->importClass("$appFolder/$file");
		}
	}
}

?>