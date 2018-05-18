<?php

/**
 * This is the model class for table "links".
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
class DataObjects_Links extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DataObjects_Links the static model class
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
		return 'links';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user', 'required'),
			array('no_order, active, id_user', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('url', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, url, no_order, active, id_user', 'safe', 'on'=>'search'),
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
			'url' => 'Url',
			'no_order' => 'No Order',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('no_order',$this->no_order);
		$criteria->compare('active',$this->active);
		$criteria->compare('id_user',$this->id_user);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}