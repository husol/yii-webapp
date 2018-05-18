<?php

class UsersController extends HUS_Controller
{
	public function actionIndex()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		if (is_null($loggedUser)){
			$this->redirect(HUS::getHomeUrl());
		}
		$work = new Works();
		$alertWork = $work->getNewWorks($loggedUser->id);

		$users = new Users();
		$user = $users->getAllUser();

		$this->render('index', array('loggedUser' => $loggedUser,
									'alertWork' => $alertWork,
									'user' => $user));
	}

	public function actionForm()
	{
		if (isset($_GET['id'])) {
			$idUser = intval($_GET['id']);
			$users = new Users();
			$user = $users->findByPk($idUser);
			$this->render('form',array('user' => $user));
		} else {
			$this->render('form');
		}
	}

	public function actionAddEdit()
	{
		$user = new Users();
		if (!empty($_POST['id'])){
			$idUser = $_POST['id'];
			$user = $user->findByPk($idUser);
		}
		$user->name = $_POST['name'];
		$user->username = $_POST['username'];
		if ($_POST['password'] != '')
			$user->password = $_POST['password'];
		$user->sex = $_POST['sex'];
		$user->email = $_POST['email'];
		$user->work_place = $_POST['work_place'];
		$user->position = $_POST['position'];
		$user->phone = $_POST['phone'];
		$user->mobile = $_POST['mobile'];
		$user->address = $_POST['address'];
		$user->role = $_POST['role'];
		$user->active = $_POST['active'];
		$user->note = $_POST['note'];
		$user->save();

		$this->redirect('index.php?r=vpdt/users');
	}

	public function actionDelete()
	{
		$user = Users::model()->findbyPk($_GET['id']);
		$user->active = -1;
		$user->save();

		$this->redirect('index.php?r=vpdt/users');
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