<?php

/**
 * This is the model class for table "works".
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
class DataObjects_Works extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DataObjects_Works the static model class
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
		return 'works';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, id_user', 'required'),
			array('active, id_user', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('description', 'length', 'max'=>1000),
			array('note', 'length', 'max'=>500),
			array('last_modified_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, note, last_modified_time, active, id_user', 'safe', 'on'=>'search'),
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
			'files' => array(self::HAS_MANY, 'Files', 'id_work'),
			'usersWorks' => array(self::HAS_MANY, 'UsersWorks', 'id_work'),
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'note' => 'Note',
			'last_modified_time' => 'Last Modified Time',
			'active' => 'Active',
			'id_user' => 'Id User',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('last_modified_time',$this->last_modified_time,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('id_user',$this->id_user);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}