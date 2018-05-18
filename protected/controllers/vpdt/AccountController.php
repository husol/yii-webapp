<?php

class AccountController extends HUS_Controller
{
	public function actionIndex()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		if (is_null($loggedUser)){
			$this->redirect(HUS::getHomeUrl());
		}

		$work = new Works();
		$alertWork = $work->getNewWorks($loggedUser->id);
		$loggedUser = Users::model()->findByPk($loggedUser->id);

		$this->render('index', array('loggedUser' => $loggedUser,
									'alertWork' => $alertWork));
	}

	public function actionEdit()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		$user = Users::model()->findByPk($loggedUser->id);
		$user->name = $_POST['name'];
		$user->sex = $_POST['sex'];
		$user->email = $_POST['email'];
		$user->work_place = $_POST['work_place'];
		$user->position = $_POST['position'];
		$user->phone = $_POST['phone'];
		$user->mobile = $_POST['mobile'];
		$user->address = $_POST['address'];
		$user->save();

		if (!empty($_FILES['avatar']['name']))
		{
			$tmp = explode('.', $_FILES['avatar']['name']);
			$extent = '.'.end($tmp);
			if(!empty($user->urlAvatar)){
				$tmp = explode('/', $user->urlAvatar);
				@unlink(HUS::getParam('imagesPath').DIRECTORY_SEPARATOR.'avatars'.DIRECTORY_SEPARATOR.end($tmp));
			}

			$timeStr = date('YmdHis_');
			$filenametmp = HUS::getParam('imagesPath').DIRECTORY_SEPARATOR.'avatars'.DIRECTORY_SEPARATOR.$timeStr.$user->getPrimaryKey().'-avatar'.$extent;
			$filename = HUS::getParam('imagesPath').DIRECTORY_SEPARATOR.'avatars'.DIRECTORY_SEPARATOR.$timeStr.$user->getPrimaryKey().'-avatar';

			move_uploaded_file($_FILES['avatar']['tmp_name'], $filenametmp);

			// Scale image with new sizes
			$ext = ".".HUS::scaleImage($filename, $filenametmp, 100, 100);

			$user->urlAvatar = Yii::app()->request->baseUrl.'/images/avatars/'.$timeStr.$user->getPrimaryKey().'-avatar'.$ext;
			$user->save();
		}

		$this->redirect('index.php?r=vpdt/account&success=1');
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