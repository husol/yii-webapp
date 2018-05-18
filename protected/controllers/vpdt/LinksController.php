<?php

class LinksController extends HUS_Controller
{
	public function actionIndex()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		if (is_null($loggedUser)){
			$this->redirect(HUS::getHomeUrl());
		}

		$work = new Works();
		$alertWork = $work->getNewWorks($loggedUser->id);

		$links = new Links();
		$link = $links->getLinks();

		$this->render('index', array('loggedUser' => $loggedUser,
									'alertWork' => $alertWork,
									'link' => $link));
	}

	public function actionForm() {
		if (isset($_GET['id'])) {
			$idLink = intval($_GET['id']);
			$links = new Links();
			$link = $links->findByPk($idLink);
			$this->render('form',array('link' => $link));
		} else {
			$this->render('form');
		}
	}

	public function actionAddEdit() {
		$loggedUser = HUS::loadSession('loggedUser');

		$link = new Links();
		if (!empty($_POST['id'])){
			$idLink = $_POST['id'];
			$link = $link->findByPk($idLink);
		}
		$link->name = $_POST['name'];
		$link->url = $_POST['url'];
		$link->no_order = $_POST['order'];
		$link->active = 1;
		$link->id_user = $loggedUser->id;
		$link->save();

		$this->redirect('index.php?r=vpdt/links');
	}

	public function actionDelete() {
		$link = Links::model()->findbyPk($_GET['id']);
		$link->active = 0;
		$link->save();

		$this->redirect('index.php?r=vpdt/links');
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