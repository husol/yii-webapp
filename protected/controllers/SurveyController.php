<?php

class SurveyController extends HUS_Controller
{
	public function actionIndex()
	{
		$answers = new Answers();
		$answer = $answers->getAnswers();

		$result = array();
		$total = 0;	$i = 0;
		foreach ($answer as $ans) {
			$result[++$i]['des'] = $ans['ans_des'];
			$result[$i]['no']= $ans['number_choice'];
			$total += $ans['number_choice'];
		}

		$this->render('index',array('result' => $result,
									'total' => $total));
	}

	public function actionVote()
	{
		$idAnswer = $_POST['answer'];
		$answer = new Answers();
		$answer->increaseNumberChoice($idAnswer);

		$this->redirect('index.php?r=survey/alert');
	}

	public function actionAlert()
	{
		$this->render('alert');
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