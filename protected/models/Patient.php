<?php

/**
 * This is the model class for table "patient".
 *
 * The followings are the available columns in table 'patient':
 * @property integer $patient_id
 * @property integer $user_id
 * @property integer $doctor_id
 * @property string $birthday
 * @property double $weight
 * @property double $size
 * @property string $intolerances
 *
 * The followings are the available model relations:
 * @property Doctor $doctor
 * @property User $user
 */
class Patient extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Patient the static model class
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
		return 'patient';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id, doctor_id', 'numerical', 'integerOnly'=>true),
			array('weight, size', 'numerical'),
			array('intolerances', 'length', 'max'=>255),
			array('birthday', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('patient_id, user_id, doctor_id, birthday, weight, size, intolerances', 'safe', 'on'=>'search'),
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
            'treatments' => array(self::HAS_MANY, 'Treatment', 'patient_id'),
            'particularities' => array(self::HAS_MANY, 'Particularity', 'patient_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'patient_id' => 'Patient',
			'user_id' => 'User',
			'doctor_id' => 'Doctor',
			'birthday' => 'Birthday',
			'weight' => 'Weight',
			'size' => 'Size',
			'intolerances' => 'Intolerances',
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

		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('doctor_id',$this->doctor_id);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('size',$this->size);
		$criteria->compare('intolerances',$this->intolerances,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}