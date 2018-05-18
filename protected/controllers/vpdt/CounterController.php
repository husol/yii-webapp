<?php

class CounterController extends HUS_Controller
{
	public function actionIndex()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		if (is_null($loggedUser)){
			$this->redirect(HUS::getHomeUrl());
		}

		$work = new Works();
		$alertWork = $work->getNewWorks($loggedUser->id);

		$counters = new Counter();
		$counter = $counters->getCounter();
		$this->render('index', array('loggedUser' => $loggedUser,
									'alertWork' => $alertWork,
									'counter' => $counter));
	}

	public function actionEdit(){
		$counter = new Counter();
		$counter->updateCounter($_POST['counter']);

		$this->redirect('index.php?r=vpdt/counter&success=1');
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