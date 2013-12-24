<?php

/**
 * This is the model class for table "process".
 *
 * The followings are the available columns in table 'process':
 * @property string $processId
 * @property integer $status
 * @property string $projectId
 * @property string $processName
 * @property string $processDetail
 * @property string $duration
 * @property string $engineerId
 * @property integer $earningPercent
 * @property string $contracttorCost
 * @property string $paymentNo
 * @property string $parentId
 * @property integer $level
 */
class Process extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Process the static model class
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
		return 'process';
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
				'projectId, processName, processDetail, duration',
				'required'),
			array(
				'status, earningPercent, level',
				'numerical',
				'integerOnly' => true),
			array(
				'projectId, duration, engineerId, parentId',
				'length',
				'max' => 10),
			array(
				'processName',
				'length',
				'max' => 100),
			array(
				'processDetail',
				'length',
				'max' => 120),
			array(
				'contracttorCost',
				'length',
				'max' => 16),
			array(
				'paymentNo',
				'length',
				'max' => 50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'processId, status, projectId, processName, processDetail, duration, engineerId, earningPercent, contracttorCost, paymentNo, parentId, level',
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
			'processImage' => array(
				self::BELONGS_TO,
				'Process',
				array(
					'processId' => 'processId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'processId' => 'Process',
			'status' => 'Status',
			'projectId' => 'Project',
			'processName' => 'Process Name',
			'processDetail' => 'Process Detail',
			'duration' => 'Duration',
			'engineerId' => 'Engineer',
			'earningPercent' => 'Earning Percent',
			'contracttorCost' => 'Contracttor Cost',
			'paymentNo' => 'Payment No',
			'parentId' => 'Parent',
			'level' => 'Level',
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
		$criteria->compare('processName', $this->processName, true);
		$criteria->compare('processDetail', $this->processDetail, true);
		$criteria->compare('duration', $this->duration, true);
		$criteria->compare('engineerId', $this->engineerId, true);
		$criteria->compare('earningPercent', $this->earningPercent);
		$criteria->compare('contracttorCost', $this->contracttorCost, true);
		$criteria->compare('paymentNo', $this->paymentNo, true);
		$criteria->compare('parentId', $this->parentId, true);
		$criteria->compare('level', $this->level);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function getAllSubProcessByProjectIdAndProcessId($projectId, $processId)
	{
		$criteria = new CDbCriteria;

		$criteria->compare('projectId', $projectId);
		$criteria->compare('parentId', $processId);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public $projectName;

	public function getAllProcessByEngineerId()
	{
		$result = array(
			);
		$criteria = new CDbCriteria();
		$criteria->select = "pj.projectId as projectId , pj.projectName as projectName";
		$criteria->join = "LEFT JOIN project pj ON pj.projectId = t.projectId";
		$criteria->condition = "t.engineerId = :engineerId";
		$criteria->params = array(
			":engineerId" => Yii::app()->user->id);
		$criteria->group = "t.projectId";
		$projects = $this->findAll($criteria);
		foreach ($projects as $project)
		{
			$result[$project->projectId]["projectName"] = $project->projectName;
			$processs = $this->findAll("projectId =:projectId AND parentId is null", array(
				":projectId" => $project->projectId));
			$j = 0;
			foreach ($processs as $process)
			{
				$result[$project->projectId]["process"][$j]["processId"] = $process->processId;
				$result[$project->projectId]["process"][$j]["processName"] = $process->processName;
				$subProcesss = $this->findAll("parentId =:parentId", array(
					":parentId" => $process->processId));
				$k = 0;
				foreach ($subProcesss as $subProcess)
				{
					$result[$project->projectId]["process"][$k]["subProcess"]["subProcessId"] = $subProcess->processId;
					$result[$project->projectId]["process"][$k]["subProcess"]["subProcessName"] = $subProcess->processName;
					$k++;
				}
				$j++;
			}
		}
		return $result;
	}

}