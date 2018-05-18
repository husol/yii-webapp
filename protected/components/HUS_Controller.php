<?php
class HUS_Controller extends Controller {
	function init() {
		// COOKIES
		if(!isset($_COOKIE['lang']) || !in_array($_COOKIE['lang'], unserialize(ARR_LANGUAGE)))
		{
			setcookie('lang', APP_DEFAULT_LANGUAGE, time() + 3600*24*30);
			HUS::register('langType', APP_DEFAULT_LANGUAGE);
		}
		else {
			HUS::register('langType', $_COOKIE['lang']);
		}

		if(file_exists(BASE_DIR."/languages/".HUS::load('langType')."/common.php")) {
			include_once (BASE_DIR."/languages/".HUS::load('langType')."/common.php");
		}
		else {
			include_once (BASE_DIR."/languages/" . APP_DEFAULT_LANGUAGE . "/common.php");
		}
		HUS::register('langContent', $lang);
	}
}
?>
