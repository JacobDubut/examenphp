<?php

/**
 * This is the model class for table "particularity".
 *
 * The followings are the available columns in table 'particularity':
 * @property integer $particularity_id
 * @property integer $patient_id
 * @property integer $is_particularity
 * @property string $header
 * @property string $content
 *
 * The followings are the available model relations:
 * @property Patient $patient
 */
class Particularity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Particularity the static model class
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
		return 'particularity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, is_particularity, header, content', 'required'),
			array('patient_id, is_particularity', 'numerical', 'integerOnly'=>true),
			array('header', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('particularity_id, patient_id, is_particularity, header, content', 'safe', 'on'=>'search'),
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
			'patient' => array(self::BELONGS_TO, 'Patient', 'patient_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'particularity_id' => 'Particularity',
			'patient_id' => 'Patient',
			'is_particularity' => 'Is Particularity',
			'header' => 'Header',
			'content' => 'Content',
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

		$criteria->compare('particularity_id',$this->particularity_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('is_particularity',$this->is_particularity);
		$criteria->compare('header',$this->header,true);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}