<?php

/**
 * This is the model class for table "answers".
 *
 * The followings are the available columns in table 'answers':
 * @property integer $id
 * @property string $description
 * @property integer $number_choice
 * @property integer $id_question
 *
 * The followings are the available model relations:
 * @property Questions $idQuestion
 */
class DataObjects_Answers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DataObjects_Answers the static model class
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
		return 'answers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_question', 'required'),
			array('number_choice, id_question', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, description, number_choice, id_question', 'safe', 'on'=>'search'),
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
			'idQuestion' => array(self::BELONGS_TO, 'Questions', 'id_question'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'description' => 'Description',
			'number_choice' => 'Number Choice',
			'id_question' => 'Id Question',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('number_choice',$this->number_choice);
		$criteria->compare('id_question',$this->id_question);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}