<?php

class ChangePassController extends HUS_Controller
{
	public function actionIndex()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		if (is_null($loggedUser)){
			$this->redirect(HUS::getHomeUrl());
		}

		$work = new Works();
		$alertWork = $work->getNewWorks($loggedUser->id);

		$this->render('index', array('loggedUser' => $loggedUser,
									'alertWork' => $alertWork));
	}

	public function actionEdit(){
		$loggedUser = HUS::loadSession('loggedUser');
		$success = 0;
		$user = Users::model()->findByPk($loggedUser->id);
		if ($user->password == $_POST['old_password']) {
			$user->password = $_POST['new_password'];
			$user->save();
			$success = 1;
		}

		$this->redirect('index.php?r=vpdt/changePass&success='.$success);
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