<?php

/**
 * This is the model class for table "users".
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
class DataObjects_Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DataObjects_Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, username, password, email, position', 'required'),
			array('role, sex, active', 'numerical', 'integerOnly'=>true),
			array('name, password, email', 'length', 'max'=>200),
			array('username, position', 'length', 'max'=>100),
			array('urlAvatar, work_place', 'length', 'max'=>255),
			array('address', 'length', 'max'=>300),
			array('phone, mobile', 'length', 'max'=>20),
			array('note', 'length', 'max'=>500),
			array('last_login', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, username, password, urlAvatar, email, position, work_place, address, phone, mobile, role, note, sex, last_login, active', 'safe', 'on'=>'search'),
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
			'chats' => array(self::HAS_MANY, 'Chats', 'id_user'),
			'files' => array(self::HAS_MANY, 'Files', 'id_user'),
			'links' => array(self::HAS_MANY, 'Links', 'id_user'),
			'questions' => array(self::HAS_MANY, 'Questions', 'id_user'),
			'topics' => array(self::HAS_MANY, 'Topics', 'id_user'),
			'usersWorks' => array(self::HAS_MANY, 'UsersWorks', 'id_user'),
			'works' => array(self::HAS_MANY, 'Works', 'id_user'),
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
			'username' => 'Username',
			'password' => 'Password',
			'urlAvatar' => 'Url Avatar',
			'email' => 'Email',
			'position' => 'Position',
			'work_place' => 'Work Place',
			'address' => 'Address',
			'phone' => 'Phone',
			'mobile' => 'Mobile',
			'role' => 'Role',
			'note' => 'Note',
			'sex' => 'Sex',
			'last_login' => 'Last Login',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('urlAvatar',$this->urlAvatar,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('work_place',$this->work_place,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}