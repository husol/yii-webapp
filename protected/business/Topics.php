<?php

/**
 * This is the business class for table "topics".
 *
 * The followings are the available columns in table 'topics':
 * @property integer $id
 * @property string $name
 * @property integer $active
 * @property integer $id_user
 *
 * The followings are the available model relations:
 * @property Users $idUser
 */
class Topics extends DataObjects_Topics
{
	function getActiveTopic(){
		$topic = HUS::buildQuery();
		$topic->select('name');
		$topic->from('topics');
		$topic->where('active = 1');
		$topic->limit(1);

		return $topic->queryRow();
	}

	function getAllTopics(){
		$topic = HUS::buildQuery();
		$topic->select('topics.id, topics.name topic_name, topics.active, users.name full_name');
		$topic->from('topics');
		$topic->join('users','topics.id_user = users.id');
		$topic->order('topics.id DESC');

		return $topic->query();
	}

	function deleteTopic($idTopic){
		$topic = HUS::buildQuery();
		$topic->delete('topics', 'id=:id', array(':id'=>$idTopic));
	}
}