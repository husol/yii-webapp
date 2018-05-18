<?php

/**
 * This is the model class for table "actions".
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
class DataObjects_Actions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DataObjects_Actions the static model class
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
		return 'actions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, id_user', 'required'),
			array('reviewed, id_user', 'numerical', 'integerOnly'=>true),
			array('title, urlImage', 'length', 'max'=>255),
			array('summary', 'length', 'max'=>1000),
			array('content, last_modified_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, summary, urlImage, content, last_modified_time, reviewed, id_user', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'summary' => 'Summary',
			'urlImage' => 'Url Image',
			'content' => 'Content',
			'last_modified_time' => 'Last Modified Time',
			'reviewed' => 'Reviewed',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('urlImage',$this->urlImage,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('last_modified_time',$this->last_modified_time,true);
		$criteria->compare('reviewed',$this->reviewed);
		$criteria->compare('id_user',$this->id_user);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}