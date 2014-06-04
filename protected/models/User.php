<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property string $email
 * @property string $password
 * @property string $picture_src
 * @property string $lastname
 * @property string $firstname
 * @property string $phone_number
 * @property string $address_1
 * @property string $address_2
 * @property integer $is_doctor
 *
 * The followings are the available model relations:
 * @property Doctor[] $doctors
 * @property Patient[] $patients
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password', 'required'),
            array('email', 'email'),
            array('email', 'unique'),
			array('is_doctor', 'numerical', 'integerOnly'=>true),
			array('email, password, picture_src, lastname, firstname, phone_number, address_1, address_2', 'length', 'max'=>255),
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
			'doctor' => array(self::HAS_ONE, 'Doctor', 'user_id'),
			'patient' => array(self::HAS_ONE, 'Patient', 'user_id'),
            'todos' => array(self::HAS_MANY, 'Todo', 'user_id'),
            'notes' => array(self::HAS_MANY, 'Note', 'user_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'email' => 'Email',
			'password' => 'Password',
			'picture_src' => 'Picture Src',
			'lastname' => 'Lastname',
			'firstname' => 'Firstname',
			'phone_number' => 'Phone Number',
			'address_1' => 'Address 1',
			'address_2' => 'Address 2',
			'is_doctor' => 'Is Doctor',
		);
	}

}