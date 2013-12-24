<?php

/**
 * This is the model class for table "qtech_process_sub".
 *
 * The followings are the available columns in table 'qtech_process_sub':
 * @property string $processSubId
 * @property integer $status
 * @property string $qtechProjectId
 * @property string $qtechProcessId
 * @property string $employeeId
 * @property string $processSubName
 * @property string $processSubDetail
 * @property integer $earningPrecent
 * @property double $contractorCost
 * @property integer $duration
 * @property integer $paymentNo
 */
class QtechProcessSub extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QtechProcessSub the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'qtech_process_sub';
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
				'employeeId, processSubName, processSubDetail',
				'required'),
			array(
				'status, earningPrecent, duration, paymentNo',
				'numerical',
				'integerOnly' => true),
			array(
				'contractorCost',
				'numerical'),
			array(
				'qtechProjectId, qtechProcessId, employeeId',
				'length',
				'max' => 10),
			array(
				'processSubName, processSubDetail',
				'length',
				'max' => 100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'processSubId, status, qtechProjectId, qtechProcessId, employeeId, processSubName, processSubDetail, earningPrecent, contractorCost, duration, paymentNo',
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
			'employee' => array(
				self::BELONGS_TO,
				'Employee',
				array(
					'employeeId' => 'employeeId')),
			'project' => array(
				self::BELONGS_TO,
				'QtechProject',
				array(
					'qtechProjectId' => 'qtechProjectId')),
			'process' => array(
				self::BELONGS_TO,
				'QtechProcess',
				array(
					'qtechProcessId' => 'qtechProcessId')),
			'processSubImage' => array(
				self::HAS_MANY,
				'QtechProcessSub',
				array(
					'processSubId' => 'processSubId')),
			'processSubImageCount' => array(
				self::STAT,
				'QtechProcessSubImage',
				'processSubId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'processSubId' => 'Process Sub',
			'status' => 'Status',
			'qtechProjectId' => 'Project',
			'qtechProcessId' => 'Process',
			'employeeId' => 'Employee',
			'processSubName' => 'Process Sub Name',
			'processSubDetail' => 'Process Sub Detail',
			'earningPrecent' => 'Earning Precent',
			'contractorCost' => 'Contractor Cost',
			'duration' => 'Duration',
			'paymentNo' => 'Payment No',
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

		$criteria->compare('processSubId', $this->processSubId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('qtechProjectId', $this->qtechProjectId, true);
		$criteria->compare('qtechProcessId', $this->qtechProcessId, true);
		$criteria->compare('employeeId', $this->employeeId, true);
		$criteria->compare('processSubName', $this->processSubName, true);
		$criteria->compare('processSubDetail', $this->processSubDetail, true);
		$criteria->compare('earningPrecent', $this->earningPrecent);
		$criteria->compare('contractorCost', $this->contractorCost);
		$criteria->compare('duration', $this->duration);
		$criteria->compare('paymentNo', $this->paymentNo);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}