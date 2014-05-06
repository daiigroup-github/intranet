<?php

/**
 * This is the model class for table "theater".
 *
 * The followings are the available columns in table 'theater':
 * @property string $theaterId
 * @property string $branchId
 * @property string $title
 * @property string $description
 * @property integer $seats
 * @property string $staffId
 * @property string $startTime
 * @property string $endTime
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class TheaterMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'theater';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branchId, title, seats, staffId, startTime', 'required'),
			array('seats, status', 'numerical', 'integerOnly'=>true),
			array('branchId, staffId', 'length', 'max'=>20),
			array('title', 'length', 'max'=>200),
			array('startTime, endTime', 'length', 'max'=>10),
			array('description, createDateTime, updateDateTime', 'safe'),
			array('createDateTime, updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'insert'),
			array('updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('theaterId, branchId, title, description, seats, staffId, startTime, endTime, status, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'theaterId' => 'Theater',
			'branchId' => 'Branch',
			'title' => 'Title',
			'description' => 'Description',
			'seats' => 'Seats',
			'staffId' => 'Staff',
			'startTime' => 'Start Time',
			'endTime' => 'End Time',
			'status' => 'Status',
			'createDateTime' => 'Create Date Time',
			'updateDateTime' => 'Update Date Time',
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
		$criteria->compare('LOWER(branchId)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(title)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(description)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('seats',$this->seats);
		$criteria->compare('LOWER(staffId)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(startTime)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(endTime)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('status',$this->status);
		$criteria->compare('LOWER(createDateTime)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(updateDateTime)',strtolower($this->searchText),true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TheaterMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
