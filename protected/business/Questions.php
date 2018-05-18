<?php

/**
 * This is the business class for table "questions".
 *
 * The followings are the available columns in table 'questions':
 * @property integer $id
 * @property string $description
 * @property integer $active
 * @property integer $id_user
 *
 * The followings are the available model relations:
 * @property Answers[] $answers
 * @property Users $idUser
 */
class Questions extends DataObjects_Questions
{
	function getActiveQuestion(){
		$activeQues = HUS::buildQuery();
		$activeQues->select('id, description');
		$activeQues->from('questions');
		$activeQues->where('active = 1');
		$activeQues->order('id DESC');
		$activeQues->limit(1);

		return $activeQues->queryRow();
	}

	function getQuestions(){
		$activeQues = HUS::buildQuery();
		$activeQues->select('questions.id, questions.description, questions.active, users.name full_name');
		$activeQues->from('questions');
		$activeQues->join('users','users.id = questions.id_user');
		$activeQues->order('questions.id DESC');

		return $activeQues->query();
	}

	function deleteQuestion($idQues){
		$question = HUS::buildQuery();
		$question->delete('questions', 'id=:id', array(':id'=>$idQues));
	}
}