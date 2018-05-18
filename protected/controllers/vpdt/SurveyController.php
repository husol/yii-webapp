<?php

class SurveyController extends HUS_Controller
{
	public function actionIndex()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		if (is_null($loggedUser)){
			$this->redirect(HUS::getHomeUrl());
		}

		$work = new Works();
		$alertWork = $work->getNewWorks($loggedUser->id);

		$questions = new Questions();
		$question = $questions->getQuestions();

		$this->render('index', array('loggedUser' => $loggedUser,
									'alertWork' => $alertWork,
									'question' => $question));
	}

	public function actionForm() {
		if (isset($_GET['id'])) {
			$idQuestion = intval($_GET['id']);
			$questions = new Questions();
			$question = $questions->findByPk($idQuestion);

			$answers = new Answers();
			$answer = $answers->getAnswers($question->id);

			$result = array(); $i = 0;
			foreach($answer as $ans) {
				$result[++$i] = $ans['ans_des'];
			}
			$this->render('form',array('question' => $question,
									'result' => $result));
		} else {
			$this->render('form');
		}
	}

	public function actionAddEdit() {
		$loggedUser = HUS::loadSession('loggedUser');

		$question = new Questions();
		if (!empty($_POST['id'])){
			$idQues = $_POST['id'];
			$question = $question->findByPk($idQues);
			$answer = Answers::model()->findAllByAttributes(array('id_question'=>$idQues));
		}
		$question->description = $_POST['question'];
		$question->id_user = $loggedUser->id;
		$question->save();

		if(is_array($answer) && count($answer) > 0){
			$i = 0;
			foreach ($answer as $ans){
				$ans->description = $_POST['answer'.++$i];
				$ans->number_choice = 0;
				$ans->save();
			}
		} else {
			for($i=1; $i<=5; $i++){
				$answer = new Answers();
				$answer->description = $_POST['answer'.$i];
				$answer->id_question = $question->getPrimaryKey();;
				$answer->save();
			}
		}

		$this->redirect('index.php?r=vpdt/survey');
	}

	public function actionDelete() {
		$idQues = $_GET['id'];
		// Delete related answers
		$answer = new Answers();
		$answers = Answers::model()->findAllByAttributes(array('id_question'=>$idQues));
		foreach ($answers as $ans){
			$answer->deleteAnswer($ans->id);
		}
		// Delete question
		$question = new Questions();
		$question->deleteQuestion($idQues);

		$this->redirect('index.php?r=vpdt/survey');
	}

	public function actionSetQuestion() {
		$question = Questions::model()->findByAttributes(array('active'=>1));
		$question->active = 0;
		$question->save();

		$question = Questions::model()->findByPk($_GET['id']);
		$question->active = 1;
		$question->save();

		$this->redirect('index.php?r=vpdt/survey');
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}