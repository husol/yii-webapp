<?php

/**
 * This is the business class for table "answers".
 *
 * The followings are the available columns in table 'answers':
 * @property integer $id
 * @property string $description
 * @property integer $number_choice
 * @property integer $id_question
 *
 * The followings are the available model relations:
 * @property Questions $idQuestion
 */
class Answers extends DataObjects_Answers
{
	function getAnswers($idQues=null){
		$ques = new Questions();
		$answers = HUS::buildQuery();
		$answers->select('answers.id, answers.description ans_des, number_choice');
		$answers->from('answers');
		if (is_null($idQues)) {
			$activeQues = $ques->getActiveQuestion();
			$answers->where("answers.id_question = {$activeQues['id']}");
		} else {
			$answers->where("answers.id_question = {$idQues}");
		}

		return $answers->query();
	}

	function increaseNumberChoice($idAnswer){
		$answers = new Answers();
		$answer = $answers->findByPk($idAnswer);
		$answer->number_choice += 1;
		$answer->save();
	}

	function deleteAnswer($idAns){
		$answer = HUS::buildQuery();
		$answer->delete('answers', 'id=:id', array(':id'=>$idAns));
	}
}