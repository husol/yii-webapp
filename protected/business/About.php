<?php

/**
 * This is the business class for table "about".
 *
 * The followings are the available columns in table 'about':
 * @property string $content
 */
class About extends DataObjects_About
{
	function getAbout(){
		$about = HUS::buildQuery();
		$about->select('content');
		$about->from('about');

		return $about->queryRow();
	}

	function updateAbout($content){
		$sql = "UPDATE about SET `content` = '{$content}'";
		HUS::queryExecute($sql);
	}
}