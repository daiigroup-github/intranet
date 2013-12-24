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
class Calendar extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Calendar the static model class
	 */
	public $saralyDay;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'calendar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(
				'title, date',
				'required'),
			array(
				'status, type',
				'numerical',
				'integerOnly' => true),
			array(
				'title',
				'length',
				'max' => 80),
			array(
				'date',
				'length',
				'max' => 45),
			array(
				'description, startTime, endTime',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'calendarId, status, title, description, type, date, startTime, endTime',
				'safe',
				'on' => 'search'),
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
			'calendarId' => 'Calendar',
			'status' => 'Status',
			'title' => 'Title',
			'description' => 'Description',
			'type' => 'Type',
			'date' => 'Date',
			'startTime' => 'Start Time',
			'endTime' => 'End Time',
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

		$criteria = new CDbCriteria;

		$criteria->compare('calendarId', $this->calendarId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('type', $this->type);
		$criteria->compare('date', $this->date, true);
		$criteria->compare('startTime', $this->startTime, true);
		$criteria->compare('endTime', $this->endTime, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function findLastSalaryDate()
	{
		$date = date('Y-m-d');
		$criteria = new CDbCriteria();
		$criteria->condition = 'date < :date AND type=5';
		$criteria->params = array(
			':date' => $date);
		$criteria->limit = 1;
		$criteria->order = 'date DESC';

		return $this->find($criteria);
	}

	public function findNextSalaryDate()
	{
		$date = date('Y-m-d');
		$criteria = new CDbCriteria();
		$criteria->condition = 'date > :date AND type=5';
		$criteria->params = array(
			':date' => $date);
		$criteria->limit = 1;

		return $this->find($criteria);
	}

	public function getSalaryDateOfNow()
	{
		$criteria = new CDbCriteria();
		$criteria->select = "*, DAY(t.date) as saralyDay ";
		$criteria->condition = "MONTH(NOW()) = MONTH(t.date)";

		return $this->find($criteria);
	}

}

