<?php

/**
 * This is the business class for table "chats".
 *
 * The followings are the available columns in table 'chats':
 * @property integer $id
 * @property string $nick
 * @property string $icon
 * @property string $description
 * @property integer $no_order
 * @property string $name
 * @property integer $active
 */
class Chats extends DataObjects_Chats
{
	function getChats(){
		$chats = HUS::buildQuery();
		$chats->select('id, no_order, nick, description, name');
		$chats->from('chats');
		$chats->where('chats.active = 1');
		$chats->order('no_order');

		return $chats->query();
	}
}