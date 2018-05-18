<?php

class HomeController extends HUS_Controller
{
	public function actionIndex()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		if (is_null($loggedUser)){
			$this->redirect(HUS::getHomeUrl().'?error=1');
		}

		$work = new Works();
		$alertWork = $work->getNewWorks($loggedUser->id);
		$newWork = $work->getNewWorks($loggedUser->id);
		$receivedWork = $work->getReceivedWorks($loggedUser->id);
		$this->render('index', array('loggedUser' => $loggedUser,
					'alertWork' => $alertWork,
					'newWork'=> $newWork,
					'receivedWork' => $receivedWork));
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