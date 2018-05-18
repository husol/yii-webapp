<?php

/**
 * This is the business class for table "files".
 *
 * The followings are the available columns in table 'files':
 * @property integer $id
 * @property string $name
 * @property string $urlFile
 * @property integer $active
 * @property integer $id_user
 * @property integer $id_work
 *
 * The followings are the available model relations:
 * @property Users $idUser
 * @property Works $idWork
 */
class Files extends DataObjects_Files
{
	function runCleaner($dateCleaner){
		ini_set('max_execution_time', 600);
		ini_set('memory_limit','1024M');
		$date = explode("/", $dateCleaner);
		$month = $date[0]; $year = $date[1];
		$backup_dir = HUS::getParam("backupPath").DIR_SEP."backup_".$year."_".$month;
		$logFile = HUS::getParam("backupPath").DIR_SEP."backup_log.html";
		$backupFile = $backup_dir.DIR_SEP."backup_".$year."_".$month.".sql";
		$actions_dir = $backup_dir.DIR_SEP."images".DIR_SEP."actions";
		$works_dir = $backup_dir.DIR_SEP."files".DIR_SEP."works";
		if (!is_dir($actions_dir)) {
			if (!mkdir($actions_dir, 0777, true)) {
				file_put_contents($logFile, '[ERROR] Failed to create backup_'.$year.'_'.$month.DIR_SEP.'images'.DIR_SEP.'actions directory<br>',FILE_APPEND | LOCK_EX);
				return json_encode('NO');
			}
		}
		if (!is_dir($works_dir)) {
			if (!mkdir($works_dir, 0777, true)) {
				file_put_contents($logFile, '[ERROR] Failed to create backup_'.$year.'_'.$month.DIR_SEP.'files'.DIR_SEP.'works directory<br>',FILE_APPEND | LOCK_EX);
				return json_encode('NO');
			}
		}
		$backup_flag = false;

		// Work with actions data
		$action = HUS::buildQuery();
		$action->select('*');
		$action->from('actions');
		$action->where("last_modified_time <= LAST_DAY('".$year."-".$month."-01')");
		$listActions = $action->queryAll();

		if (!empty($listActions)) {
			$actions = new Actions();
			$fields = array_keys($actions->attributes);
			// Backup actions data
			HUS::backupRecords($listActions,"actions",$fields,$backupFile);
			// Backup images of actions data and delete records
			foreach ($listActions as $act){
				if (!empty($act['urlImage']) &&
					!(file_exists(APP_DIR.DIR_SEP.$act['urlImage']) && copy(APP_DIR.DIR_SEP.$act['urlImage'], $actions_dir.DIR_SEP.end(explode("/", $act['urlImage']))))) {
					file_put_contents($logFile, '[WARN] Failed to copy '.$act['urlImage'].'<br>',FILE_APPEND | LOCK_EX);
				}
				$actions->deleteAction($act['id']);
			}
			$backup_flag = true;
		}

		// Clean images of actions not in database
		foreach (glob(HUS::getParam('imagesPath').DIR_SEP.'actions'.DIR_SEP."*-action.*") as $imagename) {
			$tmp  = explode(DIR_SEP,$imagename);
			$temp = end($tmp);
			if (intval(substr($temp,0,6)) <= intval($year.$month)) {
				unlink($imagename);
			}
		}

		// Work with works data
		$work = HUS::buildQuery();
		$work->select('*');
		$work->from('works');
		$work->where("last_modified_time <= LAST_DAY('".$year."-".$month."-01')");
		$listWorks = $work->queryAll();

		if (!empty($listWorks)) {
			$arr_idWork = array();
			foreach($listWorks as $row) {
				array_push($arr_idWork, $row['id']); 
			}
			$str_idWork = implode(",", $arr_idWork);

			// Work with users_works data
			$user_work = HUS::buildQuery();
			$user_work->select('*');
			$user_work->from('users_works');
			$user_work->where("id_work IN ($str_idWork)");
			$listUserWorks = $user_work->queryAll();

			$users_works = new Users_works();
			$fields = array_keys($users_works->attributes);
			// Backup users_works data
			HUS::backupRecords($listUserWorks,"users_works",$fields,$backupFile);
			// Delete users_works records
			foreach ($listUserWorks as $user_work){
				$users_works->deleteAll("id_work = ".$user_work['id_work']);
			}

			// Work with files data
			$file = HUS::buildQuery();
			$file->select('*');
			$file->from('files');
			$file->where("id_work IN ($str_idWork)");
			$listFiles = $file->queryAll();

			if (!empty($listFiles)) {
				$files = new Files();
				$fields = array_keys($files->attributes);
				// Backup files data
				HUS::backupRecords($listFiles,"files",$fields,$backupFile);
				// Backup files of works data and delete records
				foreach ($listFiles as $file){
                    $tmp = explode(DIR_SEP, $file['urlFile']);
					if (!(file_exists($file['urlFile']) && rename($file['urlFile'], $works_dir.DIR_SEP.end($tmp)))) {
						file_put_contents($logFile, '[WARN] Failed to copy '.end($tmp).'<br>',FILE_APPEND | LOCK_EX);
					}
					$files->deleteByPk($file['id']);
				}
			}

			$works = new Works();
			$fields = array_keys($works->attributes);
			// Backup works data
			HUS::backupRecords($listWorks,"works",$fields,$backupFile);
			// Delete works records
			foreach ($listWorks as $work){
				$works->deleteByPk($work['id']);
			}
			$backup_flag = true;
		}

		// Clean files of works not in database
		foreach (glob(HUS::getParam('filesPath').DIR_SEP.'works'.DIR_SEP."*-work.*") as $filename) {
			$tmp  = explode(DIR_SEP,$filename);
			$temp = end($tmp);
			if (intval(substr($temp,0,6)) <= intval($year.$month)) {
				unlink($filename);
			}
		}

		// Zip backup_dir
		$zipFileName = HUS::getParam("backupPath").DIR_SEP."backup_".$year."_".$month.".zip";
		$Hus = new HUS();
		if ($Hus->zipDir($backup_dir,$zipFileName)) {
			file_put_contents($logFile, '[INFO] Zip file backup_'.$year.'_'.$month.'.zip successfully.<br>',FILE_APPEND | LOCK_EX);
		} else {
			file_put_contents($logFile, '[ERROR] Unable to zip file backup_'.$year.'_'.$month.'.zip: '.$temp,FILE_APPEND | LOCK_EX);
			return json_encode('NO');
		}

		if ($backup_flag) {
			file_put_contents($logFile, '[INFO] Run cleaner successfully.',FILE_APPEND | LOCK_EX);
			return json_encode("SUCCEED");
		} else {
			file_put_contents($logFile, '[INFO] No data for cleaner.',FILE_APPEND | LOCK_EX);
		}
		return json_encode('YES');
	}
}
