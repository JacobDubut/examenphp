<?php

/**
 * This is the model class for table "note".
 *
 * The followings are the available columns in table 'note':
 * @property integer $note_id
 * @property integer $user_id
 * @property integer $doctor_id
 * @property string $content
 * @property string $date
 * @property string $type
 * @property integer $is_checked
 *
 * The followings are the available model relations:
 * @property Doctor $doctor
 * @property User $user
 */
class Note extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Note the static model class
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
		return 'note';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, content, date, type', 'required'),
			array('user_id, doctor_id', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('note_id, user_id, doctor_id, content, date, type', 'safe', 'on'=>'search'),
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
			'doctor' => array(self::BELONGS_TO, 'Doctor', 'doctor_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'note_id' => 'Note',
			'user_id' => 'User',
			'doctor_id' => 'Doctor',
			'content' => 'Content',
			'date' => 'Date',
			'type' => 'Type',
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

		$criteria->compare('note_id',$this->note_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('doctor_id',$this->doctor_id);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}