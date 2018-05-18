<?php

/**
 * This is the business class for table "actions".
 *
 * The followings are the available columns in table 'actions':
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $urlImage
 * @property string $content
 * @property string $last_modified_time
 * @property integer $reviewed
 * @property integer $id_user
 */
class Actions extends DataObjects_Actions
{
	function getQuickActions(){
		$action = HUS::buildQuery();
		$action->select('id, title, urlImage');
		$action->from('actions');
		$action->where('reviewed = 1');
		$action->order('viewedNumber DESC');
		$action->limit(7);

		return $action->query();
	}

	function getNewActions($img=false){
		$action = HUS::buildQuery();
		$action->select('id, title, summary, urlImage');
		$action->from('actions');
		$action->where('reviewed = 1');
		if ($img) {
			$action->andWhere("urlImage <> ''");
		}
		$action->order('last_modified_time DESC');
		$action->limit(7);

		return $action->query();
	}

	function getActions($id=null){
		$action = HUS::buildQuery('object');
		if (!is_null($id)) $action->where("actions.id = $id");
		$action->select('actions.id, actions.title, actions.urlImage, actions.summary,
						actions.reviewed, actions.viewedNumber, actions.content,
						users.name full_name, actions.last_modified_time');
		$action->from('actions');
		$action->join('users','users.id = actions.id_user');
		$action->order('actions.last_modified_time DESC');

		if (!is_null($id)) return $action->queryRow();
		return $action->query();
	}

	function deleteAction($idAction){
		$action = Actions::model()->findByPk($idAction);
		if(!empty($action->urlImage)){
			$tmp = explode('/', $action->urlImage);
			unlink(HUS::getParam('imagesPath').DIRECTORY_SEPARATOR.'actions'.DIRECTORY_SEPARATOR.end($tmp));
		}
		$action = HUS::buildQuery();
		$action->delete('actions', 'id=:id', array(':id'=>$idAction));
	}
}
