<?php

class TopicsController extends HUS_Controller
{
	public function actionIndex()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		if (is_null($loggedUser)){
			$this->redirect(HUS::getHomeUrl());
		}

		$work = new Works();
		$alertWork = $work->getNewWorks($loggedUser->id);

		$topic = new Topics();
		$allTopics = $topic->getAllTopics();
		$this->render('index', array('loggedUser' => $loggedUser,
									'alertWork' => $alertWork,
									'allTopics' => $allTopics));
	}

	public function actionForm() {
		if (isset($_GET['id'])) {
			$idTopic = intval($_GET['id']);
			$topics = new Topics();
			$topic = $topics->findByPk($idTopic);
			$this->render('form',array('topic' => $topic));
		} else {
			$this->render('form');
		}
	}

	public function actionAddEdit() {
		$loggedUser = HUS::loadSession('loggedUser');

		$topic = new Topics();
		if (!empty($_POST['id'])){
			$idTopic = $_POST['id'];
			$topic = $topic->findByPk($idTopic);
		}
		$topic->name = $_POST['name'];
		$topic->id_user = $loggedUser->id;
		$topic->save();

		$this->redirect('index.php?r=vpdt/topics');
	}

	public function actionDelete() {
		$topic = new Topics();
		$topic->deleteTopic($_GET['id']);

		$this->redirect('index.php?r=vpdt/topics');
	}

	public function actionSetTopic() {
		$sql = "UPDATE topics SET active = 0";
		HUS::queryExecute($sql);

		$topic = Topics::model()->findByPk($_GET['id']);
		$topic->active = 1;
		$topic->save();

		$this->redirect('index.php?r=vpdt/topics');
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