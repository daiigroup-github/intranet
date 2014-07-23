<?php

/**
 * This is the model class for table "fitfast".
 *
 * The followings are the available columns in table 'fitfast':
 * @property string $fitfastId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $fitfastEmployeeId
 * @property string $employeeId
 * @property string $title
 * @property string $description
 * @property integer $type
 * @property double $sumS
 * @property double $sumF
 * @property string $forYear
 */
class FitfastMaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fitfast';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createDateTime, updateDateTime, fitfastEmployeeId, employeeId, title, type, forYear', 'required'),
			array('status, type', 'numerical', 'integerOnly'=>true),
			array('sumS, sumF', 'numerical'),
			array('fitfastEmployeeId, employeeId', 'length', 'max'=>10),
			array('forYear', 'length', 'max'=>4),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fitfastId, status, createDateTime, updateDateTime, fitfastEmployeeId, employeeId, title, description, type, sumS, sumF, forYear', 'safe', 'on'=>'search'),
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
			'fitfastId' => 'Fitfast',
			'status' => 'Status',
			'createDateTime' => 'Create Date Time',
			'updateDateTime' => 'Update Date Time',
			'fitfastEmployeeId' => 'Fitfast Employee',
			'employeeId' => 'Employee',
			'title' => 'Title',
			'description' => 'Description',
			'type' => 'Type',
			'sumS' => 'Sum S',
			'sumF' => 'Sum F',
			'forYear' => 'For Year',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('fitfastId',$this->fitfastId,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true);
		$criteria->compare('updateDateTime',$this->updateDateTime,true);
		$criteria->compare('fitfastEmployeeId',$this->fitfastEmployeeId,true);
		$criteria->compare('employeeId',$this->employeeId,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('sumS',$this->sumS);
		$criteria->compare('sumF',$this->sumF);
		$criteria->compare('forYear',$this->forYear,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FitfastMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
