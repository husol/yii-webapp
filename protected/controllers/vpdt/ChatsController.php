<?php

class ChatsController extends HUS_Controller
{
	public function actionIndex()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		if (is_null($loggedUser)){
			$this->redirect(HUS::getHomeUrl());
		}

		$work = new Works();
		$alertWork = $work->getNewWorks($loggedUser->id);

		$chats = new Chats();
		$chat = $chats->getChats();

		$this->render('index', array('loggedUser' => $loggedUser,
									'alertWork' => $alertWork,
									'chat' => $chat));
	}

	public function actionForm() {
		if (isset($_GET['id'])) {
			$idChat = intval($_GET['id']);
			$chats = new Chats();
			$chat = $chats->findByPk($idChat);
			$this->render('form',array('chat' => $chat));
		} else {
			$this->render('form');
		}
	}

	public function actionAddEdit() {
		$loggedUser = HUS::loadSession('loggedUser');

		$chat = new Chats();
		if (!empty($_POST['id'])){
			$idChat = $_POST['id'];
			$chat = $chat->findByPk($idChat);
		}
		$chat->name = $_POST['name'];
		$chat->nick = $_POST['nick'];
		$chat->description = $_POST['description'];
		$chat->no_order = $_POST['order'];
		$chat->active = 1;
		$chat->save();

		$this->redirect('index.php?r=vpdt/chats');
	}

	public function actionDelete() {
		$chat = Chats::model()->findbyPk($_GET['id']);
		$chat->active = 0;
		$chat->save();

		$this->redirect('index.php?r=vpdt/chats');
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