<?php

/**
 * This is the business class for table "links".
 *
 * The followings are the available columns in table 'links':
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property integer $no_order
 * @property integer $active
 * @property integer $id_user
 *
 * The followings are the available model relations:
 * @property Users $idUser
 */
class Links extends DataObjects_Links
{
	function getLinks(){
		$links = HUS::buildQuery();
		$links->select('links.id, no_order, links.name, url, users.name full_name');
		$links->from('links');
		$links->join('users','users.id = links.id_user');
		$links->where('links.active = 1');
		$links->order('no_order');

		return $links->query();
	}
}