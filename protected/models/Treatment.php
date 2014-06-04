<?php

/**
 * This is the model class for table "treatment".
 *
 * The followings are the available columns in table 'treatment':
 * @property integer $treatment_id
 * @property integer $patient_id
 * @property integer $month
 * @property integer $count
 *
 * The followings are the available model relations:
 * @property Patient $patient
 */
class Treatment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Treatment the static model class
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
		return 'treatment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, month', 'required'),
			array('patient_id, month, count', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('treatment_id, patient_id, month, count', 'safe', 'on'=>'search'),
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
			'treatment_id' => 'Treatment',
			'patient_id' => 'Patient',
			'month' => 'Month',
			'count' => 'Count',
		);
	}

    public static function getMonth($i) {
        switch($i) {
            case 1:
                return 'J';
            case 2:
                return 'F';
            case 3:
                return 'M';
            case 4:
                return 'A';
            case 5:
                return 'M';
            case 6:
                return 'J';
            case 7:
                return 'J';
            case 8:
                return 'A';
            case 9:
                return 'S';
            case 10:
                return 'O';
            case 11:
                return 'N';
            case 12:
                return 'D';
                break;
            default:
                break;
        }
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

		$criteria->compare('treatment_id',$this->treatment_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('month',$this->month);
		$criteria->compare('count',$this->count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}