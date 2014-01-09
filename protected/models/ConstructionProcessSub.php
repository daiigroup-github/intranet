<?php

/**
 * This is the model class for table "construction_process_sub".
 *
 * The followings are the available columns in table 'construction_process_sub':
 * @property string $processSubId
 * @property integer $status
 * @property string $projectId
 * @property string $processId
 * @property string $engineerId
 * @property string $name
 * @property string $detail
 * @property integer $earningPrecent
 * @property double $contractorCost
 * @property string $startDate
 * @property integer $duration
 * @property integer $paymentNo
 */
class ConstructionProcessSub extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConstructionProcessSub the static model class
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
		return 'construction_process_sub';
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
				'projectId, processId, engineerId, name, detail, earningPrecent, startDate',
				'required'),
			array(
				'status, earningPrecent, duration, paymentNo',
				'numerical',
				'integerOnly'=>true),
			array(
				'contractorCost',
				'numerical'),
			array(
				'projectId, processId, engineerId',
				'length',
				'max'=>10),
			array(
				'name, detail',
				'length',
				'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'processSubId, status, projectId, processId, engineerId, name, detail, earningPrecent, contractorCost, startDate, duration, paymentNo',
				'safe',
				'on'=>'search'),
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
			'process'=>array(
				self::BELONGS_TO,
				'ConstructionProcess',
				'processId'),
			'processSubImage'=>array(
				self::HAS_MANY,
				'ConstructionProcessSubImage',
				'processSubId'),
			'processSubImageCount'=>array(
				self::STAT,
				'ConstructionProcessSubImage',
				'processSubId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'processSubId'=>'Process Sub',
			'status'=>'Status',
			'projectId'=>'Project',
			'processId'=>'Process',
			'engineerId'=>'Engineer',
			'name'=>'Name',
			'detail'=>'Detail',
			'earningPrecent'=>'Earning Precent',
			'contractorCost'=>'Contractor Cost',
			'startDate'=>'Start Date',
			'duration'=>'Duration',
			'paymentNo'=>'Payment No',
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
		$criteria->compare('projectId', $this->projectId, true);
		$criteria->compare('processId', $this->processId, true);
		$criteria->compare('engineerId', $this->engineerId, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('detail', $this->detail, true);
		$criteria->compare('earningPrecent', $this->earningPrecent);
		$criteria->compare('contractorCost', $this->contractorCost);
		$criteria->compare('startDate', $this->startDate, true);
		$criteria->compare('duration', $this->duration);
		$criteria->compare('paymentNo', $this->paymentNo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
