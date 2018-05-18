<?php

class WorksController extends HUS_Controller
{
	public function actionIndex()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		if (is_null($loggedUser) || $loggedUser->role != 0){
			$this->redirect(HUS::getHomeUrl());
		}

		$work = new Works();
		$alertWork = $work->getNewWorks($loggedUser->id);
		$allWork = $work->getWorks();
		$this->render('index', array('loggedUser' => $loggedUser,
									'alertWork' => $alertWork,
									'allWork' => $allWork));
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

		$this->redirect('index.php?r=vpdt/works');
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