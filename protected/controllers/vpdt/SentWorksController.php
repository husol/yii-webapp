<?php

class SentWorksController extends HUS_Controller
{
	public function actionIndex()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		if (is_null($loggedUser)){
			$this->redirect(HUS::getHomeUrl());
		}

		$work = new Works();
		$alertWork = $work->getNewWorks($loggedUser->id);
		$sentWork = $work->getSentWorks();

		$this->render('index', array('loggedUser' => $loggedUser,
									'alertWork' => $alertWork,
									'sentWork' => $sentWork));
	}

	public function actionDelete() {
		$idWork = $_GET['id'];
		$files = Files::model()->findAllByAttributes(array('id_work'=>$idWork));
		foreach($files as $file) {
			$file->active = 0;
			$file->save();
		}

		$work = Works::model()->findByPk($idWork);
		$work->active = 0;
		$work->save();

		$this->redirect('index.php?r=vpdt/sentWorks');
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