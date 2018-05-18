<?php

/**
 * This is the business class for table "counter".
 *
 * The followings are the available columns in table 'counter':
 * @property integer $count
 */
class Counter extends DataObjects_Counter
{
	function getCounter(){
		$counter = HUS::buildQuery();
		$counter->select('count');
		$counter->from('counter');

		return $counter->queryRow();
	}

	function increaseCounter(){
		$sql = "UPDATE counter SET `count` = `count` + 1";
		HUS::queryExecute($sql);
	}

	function updateCounter($count){
		$sql = "UPDATE counter SET `count` = {$count}";
		HUS::queryExecute($sql);
	}
}