<?php

/**
 * This is the model class for table "construction_process".
 *
 * The followings are the available columns in table 'construction_process':
 * @property string $processId
 * @property integer $status
 * @property string $projectId
 * @property string $name
 * @property string $detail
 * @property string $startDate
 * @property string $duration
 * @property string $engineerId
 * @property integer $earningPercent
 * @property string $contractorCost
 * @property string $paymentNo
 * @property string $parentId
 * @property integer $level
 */
class ConstructionProcess extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConstructionProcess the static model class
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
		return 'construction_process';
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
				'projectId, name, detail, startDate, duration',
				'required'),
			array(
				'status, percent, price, level',
				'numerical',
				'integerOnly'=>true),
			array(
				'projectId, duration, engineerId, parentId',
				'length',
				'max'=>10),
			array(
				'name',
				'length',
				'max'=>100),
			array(
				'detail',
				'length',
				'max'=>120),
			array(
				'contractorCost',
				'length',
				'max'=>16),
			array(
				'paymentNo',
				'length',
				'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'processId, status, projectId, name, detail, startDate, duration, engineerId, percent, price, contractorCost, paymentNo, parentId, level',
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
			'project'=>array(
				self::BELONGS_TO,
				'ConstructionProject',
				'projectId'),
			'processSub'=>array(
				self::HAS_MANY,
				'ConstructionProcessSub',
				'processId')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'processId'=>'Process',
			'status'=>'Status',
			'projectId'=>'Project',
			'name'=>'Name',
			'detail'=>'Detail',
			'startDate'=>'Start Date',
			'duration'=>'Duration',
			'engineerId'=>'Engineer',
			'percent'=>'Percent',
			'price'=>'Price',
			'contractorCost'=>'Contractor Cost',
			'paymentNo'=>'Payment No',
			'parentId'=>'Parent',
			'level'=>'Level',
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

		$criteria->compare('processId', $this->processId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('projectId', $this->projectId, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('detail', $this->detail, true);
		$criteria->compare('startDate', $this->startDate, true);
		$criteria->compare('duration', $this->duration, true);
		$criteria->compare('engineerId', $this->engineerId, true);
		$criteria->compare('earningPercent', $this->earningPercent);
		$criteria->compare('contractorCost', $this->contractorCost, true);
		$criteria->compare('paymentNo', $this->paymentNo, true);
		$criteria->compare('parentId', $this->parentId, true);
		$criteria->compare('level', $this->level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
