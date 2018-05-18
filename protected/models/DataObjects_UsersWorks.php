<?php

/**
 * This is the model class for table "users_works".
 *
 * The followings are the available columns in table 'users_works':
 * @property integer $viewed
 * @property integer $id_user
 * @property integer $id_work
 *
 * The followings are the available model relations:
 * @property Users $idUser
 * @property Works $idWork
 */
class DataObjects_UsersWorks extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DataObjects_UsersWorks the static model class
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
		return 'users_works';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_work', 'required'),
			array('viewed, id_user, id_work', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('viewed, id_user, id_work', 'safe', 'on'=>'search'),
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
			'idWork' => array(self::BELONGS_TO, 'Works', 'id_work'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'viewed' => 'Viewed',
			'id_user' => 'Id User',
			'id_work' => 'Id Work',
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

		$criteria->compare('viewed',$this->viewed);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_work',$this->id_work);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}