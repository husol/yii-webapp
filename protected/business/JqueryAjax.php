<?php

class JqueryAjax
{
	var $objIncorrect = false;
	var $classDoesNotExist = false;
	var $methodDoseNotExist = false;

	function checkValidate($class_name, $function_name)
	{
		//check does the object and function posted by client is in correct form
		if(!preg_match('/^[0-9A-Za-z_]+$/', $class_name) || !preg_match('/^[0-9A-Za-z_]+$/', $function_name))
		{
			$this->objIncorrect = true;
			return false;
		}

		if( !class_exists($class_name) )
		{
				$this->classDoesNotExist = true;
				return false;
		}

		$object = new $class_name();

		if( !method_exists($object, $function_name))
		{
				$this->methodDoseNotExist = true;
				return false;
		}

		return array("object"  => $object, "functionname" => $function_name);
	}

	function callFunction($object, $function, $agrs)
	{
		$result = $this->checkValidate($object, $function);
		if( !$result )	return false;
		return call_user_func_array(array($result['object'], $result['functionname']), $agrs);
	}
}
