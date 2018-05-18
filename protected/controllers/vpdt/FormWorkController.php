<?php

class FormWorkController extends HUS_Controller
{
	public function actionIndex()
	{
		$loggedUser = HUS::loadSession('loggedUser');
		if (is_null($loggedUser)){
			$this->redirect('index.php?r=login');
		}

		$work = new Works();
		$alertWork = $work->getNewWorks($loggedUser->id);

		$user = new Users();
		$listUser = $user->getListUser($loggedUser->id);
		if (isset($_GET['id'])) {
			$idWork = $_GET['id'];
			$formWork = array();
			$formWork['work'] = $work->getWorks($idWork);

			// Get ToUser
			$ToUser = $work->getToUser($idWork);
			foreach($ToUser as $u) {
				$formWork['ToUser'][] = $u['idToUser']; 
			}
			$formWork['file'] = $work->getFile($idWork);

			if ($work->checkUserOfWork($idWork) || $loggedUser->role == 0) {
				if (!$work->checkUserOfWork($idWork)) {
					$w = Works::model()->findByPk($idWork);
					$listUser = $user->getListUser($w->id_user);
					$sql = "UPDATE users_works SET `viewed` = 1 WHERE id_user = $loggedUser->id AND id_work = $idWork";
					HUS::queryExecute($sql);
				}
		
				$this->render('index',array('loggedUser'=>$loggedUser,
											'alertWork'=>$alertWork,
											'listUser'=>$listUser,
											'formWork'=>$formWork));
			} else {
				$sql = "UPDATE users_works SET `viewed` = 1 WHERE id_user = $loggedUser->id AND id_work = $idWork";
				HUS::queryExecute($sql);
				$this->render('index',array('loggedUser'=>$loggedUser,
											'alertWork'=>$alertWork,
											'formWork'=>$formWork,
											'view'=>1));
			}
		} else
			$this->render('index',array('loggedUser'=>$loggedUser,
										'alertWork'=>$alertWork,
										'listUser'=>$listUser));
	}

	public function actionAddEdit()
	{
		$loggedUser = HUS::loadSession('loggedUser');
		$arrFileName = array(); $arrFileTmpName = array();

		for ($i=0; $i<3; $i++) {
			if (@!empty($_FILES['files']['name'][$i])){
					$arrFileName[] = $_FILES['files']['name'][$i];
					$arrFileTmpName[] = $_FILES['files']['tmp_name'][$i];
			}
		}
		$work = new Works();
		if (!empty($_POST['id'])){
			$idWork = $_POST['id'];
			$work = $work->findByPk($idWork);
			// Delete old users_works
			$temp = HUS::buildQuery();
			$temp->delete('users_works', 'id_work=:id_work', array(':id_work'=>$idWork));
			// Delete old files
			if (count($arrFileName) > 0){
				$files = Files::model()->findAllByAttributes(array('id_work'=>$idWork));
				foreach ($files as $file) {
					if(!empty($file->urlFile)){
						unlink($file->urlFile);
					}
				}
				$temp = HUS::buildQuery();
				$temp->delete('files', 'id_work=:id_work', array(':id_work'=>$idWork));
			}
		}

		$work->name = $_POST['name'];
		$work->note = $_POST['note'];
		$work->description = $_POST['contentWork'];
		$work->last_modified_time = date('Y-m-d H:i:s');
		$work->id_user = $loggedUser->id;
		$work->save();

		$toUsers = $_POST['toUsers'];
		foreach ($toUsers as $idToUser){
			$Uw = new Users_works();
			$Uw->id_work = $work->getPrimaryKey();
			$Uw->id_user = $idToUser;
			$Uw->save();
		}

		if (count($arrFileName) > 0){
			foreach($arrFileName as $key => $f){
				$file = new Files();
				$file->name = $f;
				$file->id_user = $loggedUser->id;
				$file->id_work = $work->getPrimaryKey();
				$tmp = explode('.', $f);
				$extent = '.'.end($tmp);
				move_uploaded_file($arrFileTmpName[$key], HUS::getParam('filesPath').DIRECTORY_SEPARATOR.'works'.DIRECTORY_SEPARATOR.date('YmdHis_').$work->getPrimaryKey().'_'.($key+1).'-work'.$extent);
				$file->urlFile = HUS::getParam('filesPath').DIRECTORY_SEPARATOR.'works'.DIRECTORY_SEPARATOR.date('YmdHis_').$work->getPrimaryKey().'_'.($key+1).'-work'.$extent;
				$file->save();
			}
		}

		$this->redirect('index.php?r=vpdt/sentWorks');
	}

	public function actionDownload(){
		$idFile = $_GET['id'];
		$file = Files::model()->findByPk($idFile);
		if(file_exists($file->urlFile))	{
			$output = file_get_contents($file->urlFile);
		} else {
			$output = '';
		}
		header("Cache-Control:  ");
		header("Pragma: ");
		header('Content-Type: application/download; charset=windows-1252');
		header('Content-Length: '.strlen($output));
		header('Content-disposition: inline; filename="'.$file->name.'"');
		echo $output;
		flush();
		exit();
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