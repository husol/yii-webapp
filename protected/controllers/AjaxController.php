<?php

class AjaxController extends HUS_Controller
{
	public function actionIndex()
	{
		$business	= $_REQUEST['business'];
		$function 	= $_REQUEST['func'];
		$params		= $_REQUEST['parameters'];

		$agrs = array();
		foreach($params as $param){
			switch($param){
				case 'null':
					$agrs[] = NULL;
					break;
				case 'true':
					$agrs[] = TRUE;
					break;
				case 'false':
					$agrs[] = FALSE;
					break;
				default:
					$agrs[] = $param;
			}
		}

		$val = new JqueryAjax();
		echo $val->callFunction($business, $function, $agrs);
		die();
	}
}