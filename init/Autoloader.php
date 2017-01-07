<?php
class Autoloader
{
	static private $pathName = "";
	static private $className = "";
	static private $ignore = array('.', '..', 'cgi-bin', '.svn', 'templates', 'compile');

	static public function init($path)
	{
		self::$pathName = $path;
	}

	static public function autoload($className)
	{
		self::loadClass(self::$pathName, $className);
	}

	static public function loadClass($path, $className)
	{
		if(file_exists($path . "/" . $className . ".php"))
		{
			require_once($path . "/" . $className . ".php");
			return;
		}

		self::parseFolder($path, $className);
	}

	static private function parseFolder($path, $className)
	{
		$dirHandler = opendir($path);

		while(false !== ($folderItem = readdir($dirHandler)))
			if(is_dir($path . "/" . $folderItem) && !in_array($folderItem, self::$ignore))
				self::loadClass($path . "/" . $folderItem, $className);
	}
}