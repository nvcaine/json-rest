<?php
// init framework files
require_once("framework/init/AppInit.php");
require_once("framework/init/Autoloader.php");

//$appInit = new AppInit("framework"); // initialize the framework
//$appFacade = new AppFacade(new SettingsManager("settings.json")); // define server settings and sections

//Autoloader::init("app"); // init the server
//DBWrapper::configure("[server]", "[user]", "[password]", "[database]"); // init the database connection

spl_autoload_register(array("Autoloader", "autoload"));