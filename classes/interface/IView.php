<?php
interface IView
{
	public function assign($variableName, $value);
	public function setTemplate();
}

?>