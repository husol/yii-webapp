<?php

/**
 * This is the model class for table "chats".
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
class DataObjects_Chats extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DataObjects_Chats the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'chats';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nick', 'required'),
			array('no_order, active', 'numerical', 'integerOnly'=>true),
			array('nick, description, name', 'length', 'max'=>100),
			array('icon', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nick, icon, description, no_order, name, active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nick' => 'Nick',
			'icon' => 'Icon',
			'description' => 'Description',
			'no_order' => 'No Order',
			'name' => 'Name',
			'active' => 'Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nick',$this->nick,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('no_order',$this->no_order);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}