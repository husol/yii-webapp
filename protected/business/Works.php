<?php

/**
 * This is the business class for table "works".
 *
 * The followings are the available columns in table 'works':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $note
 * @property string $last_modified_time
 * @property integer $active
 * @property integer $id_user
 *
 * The followings are the available model relations:
 * @property Files[] $files
 * @property UsersWorks[] $usersWorks
 * @property Users $idUser
 */
class Works extends DataObjects_Works
{
	public function getNewWorks($idUser){
		$newWork = HUS::buildQuery();
		$newWork->select('works.id, works.name work_name, users.name full_name, works.note, works.last_modified_time');
		$newWork->from('works');
		$newWork->join('users_works uw', 'works.id = uw.id_work');
		$newWork->join('users', 'users.id = works.id_user');
		$newWork->where("uw.id_user = {$idUser} AND uw.viewed = 0 AND users.active = 1 AND works.active = 1");
		$newWork->order('works.last_modified_time DESC');

		return $newWork->query();
	}

	public function getReceivedWorks($idUser){
		$receivedWork = HUS::buildQuery();
		$receivedWork->select('works.id, works.name work_name, users.name full_name, works.note, works.last_modified_time');
		$receivedWork->from('works');
		$receivedWork->join('users_works uw', 'works.id = uw.id_work');
		$receivedWork->join('users', 'users.id = works.id_user');
		$receivedWork->where("uw.id_user = {$idUser} AND uw.viewed = 1 AND users.active = 1 AND works.active = 1");
		$receivedWork->order('works.last_modified_time DESC');

		return $receivedWork->query();
	}

	public function getSentWorks(){
		$loggedUser = HUS::loadSession('loggedUser');
		$sentWork = HUS::buildQuery();
		$sentWork->select('id, name, note, last_modified_time');
		$sentWork->from('works');
		$sentWork->where("id_user = {$loggedUser->id} AND active = 1");
		$sentWork->order('last_modified_time DESC');

		return $sentWork->query();
	}

	public function getWorks($idWork=null){
		$work = HUS::buildQuery();
		$work->select('works.id, works.name work_name,
					users.name full_name, works.note,
					works.description, works.last_modified_time');
		$work->from('works');
		$work->join('users', 'users.id = works.id_user');
		$work->where("works.active = 1");
		$work->order('works.last_modified_time DESC');
		if (!is_null($idWork)) {
			$work->andWhere("works.id = $idWork");
			return $work->queryRow();
		}
		return $work->query();
	}

	public function getToUser($idWork){
		$work = HUS::buildQuery();
		$work->select('uw.id_user idToUser');
		$work->from('users_works uw');
		$work->where("uw.id_work = $idWork");

		return $work->queryAll();
	}

	public function getFile($idWork){
		$work = HUS::buildQuery();
		$work->select('id, name');
		$work->from('files');
		$work->where("files.id_work = $idWork AND active = 1");

		return $work->query();
	}

	public function checkUserOfWork($idWork){
		$work = Works::model()->findByPk($idWork);
		$loggedUser = HUS::loadSession('loggedUser');

		if ($work->id_user == $loggedUser->id)
			return true;
		return false;
	}
}