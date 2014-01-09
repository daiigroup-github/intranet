<?php

/**
 * This is the model class for table "calendar".
 *
 * The followings are the available columns in table 'calendar':
 * @property string $calendarId
 * @property integer $status
 * @property string $title
 * @property string $description
 * @property integer $type
 * @property string $date
 * @property string $startTime
 * @property string $endTime
 */
class Report extends Document
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Calendar the static model class
	 */
	public $startDate;
	public $endDate;
	public $companyId;
	public $companyDivisionId;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'document';
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
			'calendarId'=>'Calendar',
			'status'=>'Status',
			'title'=>'Title',
			'description'=>'Description',
			'type'=>'Type',
			'date'=>'Date',
			'startTime'=>'Start Time',
			'endTime'=>'End Time',
		);
	}

}
