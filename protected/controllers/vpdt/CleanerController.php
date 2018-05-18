<?php

class CleanerController extends HUS_Controller
{
	public function actionIndex()
	{
		$loggedUser = HUS::loadSession('loggedUser');

		if (is_null($loggedUser) || $loggedUser->role != 0){
			$this->redirect(HUS::getHomeUrl());
		}

		// Make sure backup directory empty
		$dataBackup = glob(HUS::getParam('backupPath').DIR_SEP.'backup*');
		if (!empty($dataBackup)){
			foreach ($dataBackup as $dataname) {
				if(is_dir($dataname)){
					HUS::removeDir($dataname);
				} else {
					unlink($dataname);
				}
			}
		}

		$work = new Works();
		$alertWork = $work->getNewWorks($loggedUser->id);

		$contentOfSpaceStatus = HUS::getSpaceHostingStatus("huyendoantrangbang.org.vn","huyendoa","trangbangtayninh");
		$this->render('index', array('loggedUser' => $loggedUser,
						'alertWork' => $alertWork,
						'contentOfSpaceStatus' => $contentOfSpaceStatus));
	}

	public function actionBox(){
		$dateCleaner = explode("/",strval($_GET['dateCleaner']));
		$month = $dateCleaner[0]; $year = $dateCleaner[1];

		$this->render('box',array('year' => $year, 'month' => $month));
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