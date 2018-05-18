<?php

/**
 * This is the business class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $urlAvatar
 * @property string $email
 * @property string $position
 * @property string $work_place
 * @property string $address
 * @property string $phone
 * @property string $mobile
 * @property integer $role
 * @property string $note
 * @property integer $sex
 * @property string $last_login
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Chats[] $chats
 * @property Files[] $files
 * @property Links[] $links
 * @property Questions[] $questions
 * @property Topics[] $topics
 * @property UsersWorks[] $usersWorks
 * @property Works[] $works
 */
class Users extends DataObjects_Users
{
	function getAllUser(){
		$loggedUser = HUS::loadSession('loggedUser');

		$user = HUS::buildQuery();
		$user->select('id, name, urlAvatar, email, position, work_place, username, active, last_login');
		$user->from('users');
		$user->order('name');
		$user->where("id <> $loggedUser->id AND active <> -1");

		return $user->query();
	}

	function getListUser($idUser=null){
		$user = HUS::buildQuery();
		$user->select('id, name, urlAvatar, position, work_place, username, active, last_login');
		$user->from('users');
		$user->where('active = 1');
		$user->order('name');
		if (!is_null($idUser))
			$user->andwhere("id <> $idUser");

		return $user->query();
	}

	function checkUsername($id, $username)
	{
		if (!preg_match('/^(?=[a-z]{2})(?=.{4,26})(?=[^.]*\.?[^.]*$)(?=[^_]*_?[^_]*$)[\w.]+$/iD', $username))
		{
			return json_encode("Yes");
		}

		$users = new Users();
		if (!is_null($id)){
			$user = $users->findAllByAttributes(array('username' => $username), "id != $id AND active != -1");
		} else
			$user = $users->findAllByAttributes(array('username' => $username),'active != -1');

		if (count($user) > 0)
			return json_encode("Yes");
		else
			return json_encode("No");
	}

	function checkEmail($id, $email)
	{
		$users = new Users();

		if (!is_null($id)){
			$user = $users->findAllByAttributes(array('email' => $email), "id != $id AND active != -1");
		} else
			$user = $users->findAllByAttributes(array('email' => $email),'active != -1');

		if (count($user) > 0)
			return json_encode("Yes");
		else
			return json_encode("No");
	}
}