<?php

class ActionsController extends HUS_Controller
{
	public function actionIndex()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		if (is_null($loggedUser)){
			$this->redirect(HUS::getHomeUrl());
		}

		$work = new Works();
		$alertWork = $work->getNewWorks($loggedUser->id);
		$actions = new Actions();
		$action = $actions->getActions();

		$this->render('index', array('loggedUser' => $loggedUser,
									'alertWork' => $alertWork,
									'action' => $action));
	}

	public function actionForm()
	{
		$idAction = isset($_GET['id']) ? intval($_GET['id']) : null;
		if (is_null($idAction)) {
			$this->render('form');
		} else {
			$action = Actions::model()->findByPk($idAction);
			$this->render('form', array('action' => $action));
		}
	}

	public function actionAddEdit()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		$action = new Actions();
		if (!empty($_POST['id'])){
			$idAction = $_POST['id'];
			$action = $action->findByPk($idAction);
		}
		$action->title = $_POST['name'];
		$action->summary = $_POST['summary'];
		$action->content = $_POST['contentAction'];
		$action->last_modified_time = date('Y-m-d H:i:s');
		$action->reviewed = $_POST['reviewed'];
		$action->id_user = $loggedUser->id;
		$action->save();

		if (@!empty($_FILES['image']['name']))
		{
			$tmp = explode('.', $_FILES['image']['name']);
			$extent = '.'.end($tmp);
			if(!empty($action->urlImage)){
				$tmp = explode('/', $action->urlImage);
                $file = HUS::getParam('imagesPath').DIRECTORY_SEPARATOR.'actions'.DIRECTORY_SEPARATOR.end($tmp);
				if(file_exists($file)) unlink($file);
			}

			$timeStr = date('YmdHis_');
			$filenametmp = HUS::getParam('imagesPath').DIRECTORY_SEPARATOR.'actions'.DIRECTORY_SEPARATOR.$timeStr.$action->getPrimaryKey().$extent;
			$filename = HUS::getParam('imagesPath').DIRECTORY_SEPARATOR.'actions'.DIRECTORY_SEPARATOR.$timeStr.$action->getPrimaryKey().'-action';
			move_uploaded_file($_FILES['image']['tmp_name'], $filenametmp);

			// Scale image with new sizes
			$ext = ".".HUS::scaleImage($filename, $filenametmp, 620, 270);

			$action->urlImage = 'images/actions/'.$timeStr.$action->getPrimaryKey().'-action'.$ext;
			$action->save();
		}

		$this->redirect('index.php?r=vpdt/actions');
	}

	public function actionDelete() {
		$action = new Actions();
		$action->deleteAction($_GET['id']);

		$this->redirect('index.php?r=vpdt/actions');
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