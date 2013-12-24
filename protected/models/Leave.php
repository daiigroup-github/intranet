<?php

/**
 * This is the model class for table "leave".
 *
 * The followings are the available columns in table 'leave':
 * @property string $leaveId
 * @property integer $status
 * @property string $documentId
 * @property integer $leaveType
 * @property integer $isLate
 * @property string $filePath
 */
class Leave extends CActiveRecord
{

	const LEAVE_SICK_QUOTA = 30;
	const LEAVE_PERSONAL_QUOTA = 6;
	const LEAVE_TYPE_SICK = 1;
	const LEAVE_TYPE_PERSONAL = 2;
	const LEAVE_TYPE_VOCATION = 3;
	const LEAVE_TYPE_PREGNANCY = 4;
	const LEAVE_TYPE_ORDINATE = 5;
	const LEAVE_TIME_RANGE_NONE = 0;
	const LEAVE_TIME_RANGE_FULLDAY = 1;
	const LEAVE_TIME_RANGE_MORNING = 2;
	const LEAVE_TIME_RANGE_AFTERNOON = 3;
	const LEAVE_TIME_RANGE_13_14 = 6;
	const LEAVE_TIME_RANGE_13_15 = 7;
	const LEAVE_TIME_RANGE_13_16 = 8;
	const LEAVE_TIME_RANGE_13_17 = 9;
	const LEAVE_TIME_RANGE_14_15 = 11;
	const LEAVE_TIME_RANGE_14_16 = 12;
	const LEAVE_TIME_RANGE_14_17 = 13;
	const LEAVE_TIME_RANGE_15_16 = 16;
	const LEAVE_TIME_RANGE_15_17 = 17;
	const LEAVE_TIME_RANGE_16_17 = 21;

	public $leaveTimeRange;
	public $startDate;
	public $endDate;
	public $sumLeaveTime;
	public $companyId;
	public $inAround;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Leave the static model class
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
		return 'leave';
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
				'documentId, leaveType',
				'required'),
			array(
				'status, leaveType',
				'numerical',
				'integerOnly' => true),
			array(
				'documentId',
				'length',
				'max' => 20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'leaveId, status, documentId, leaveType, isLate, filePath, companyId',
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
			'leaveItem' => array(
				self::HAS_MANY,
				'LeaveItem',
				'leaveId'),
			'document' => array(
				self::BELONGS_TO,
				'Document',
				'documentId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'leaveId' => 'Leave',
			'status' => 'Status',
			'documentId' => 'Document',
			'leaveType' => 'Leave Type',
			'isLate' => 'Late',
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

		$criteria->compare('leaveId', $this->leaveId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('documentId', $this->documentId, true);
		$criteria->compare('leaveType', $this->leaveType);
		$criteria->compare('isLate', $this->isLate);
		$criteria->compare('filePath', $this->filePath);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	// Custom
	public function getLeaveTypeArray()
	{
		return array(
			self::LEAVE_TYPE_PREGNANCY => 'ลาคลอด',
			self::LEAVE_TYPE_ORDINATE => 'ลาบวช',
		);
	}

	public function getNormalLeaveTypeArray()
	{
		return array(
			self::LEAVE_TYPE_SICK => 'ลาป่วย',
			self::LEAVE_TYPE_PERSONAL => 'ลากิจ',
			self::LEAVE_TYPE_VOCATION => 'ลาพักร้อน',
		);
	}

	public function leaveTypeText($leaveType)
	{
		try
		{
			if ($leaveType == 4 || $leaveType == 5)
			{
				$lt = $this->leaveTypeArray;
			}
			else if ($leaveType == 1 || $leaveType == 2 || $leaveType == 3)
			{
				$lt = $this->normalLeaveTypeArray;
			}
			else
			{
				$lt = array(
					);
				$lt[$leaveType] = $leaveType;
			}
			return $lt[$leaveType];
		}
		catch (Exception $exc)
		{
			return $leaveType;
		}
	}

	public function sumLeaveDateByLeaveType($leaveType, $employeeId)
	{
		$criteria = new CDbCriteria();
		$criteria->select = 'SUM(li.leaveTime) AS sumLeaveTime';
		$criteria->join = 'LEFT JOIN leave_item li ON t.leaveId=li.leaveId';
		$criteria->join .= ' RIGHT JOIN document d ON t.documentId=d.documentId';
		$criteria->condition = 't.leaveType=:leaveType AND d.employeeId=:employeeId AND t.status=1';
		$criteria->params = array(
			':leaveType' => $leaveType,
			':employeeId' => $employeeId);

		//Controller::writeTofile('/tmp/leave', print_r($criteria, true));

		$model = $this->find($criteria);
		return $model->sumLeaveTime;
	}

	public function sumWaitApproveLeaveDateByLeaveType($leaveType, $employeeId)
	{
		$criteria = new CDbCriteria();
		$criteria->select = 'SUM(li.leaveTime) AS sumLeaveTime';
		$criteria->join = 'LEFT JOIN leave_item li ON t.leaveId=li.leaveId';
		$criteria->join .= ' RIGHT JOIN document d ON t.documentId=d.documentId';
		$criteria->condition = 't.leaveType=:leaveType AND d.employeeId=:employeeId AND t.status=0';
		$criteria->params = array(
			':leaveType' => $leaveType,
			':employeeId' => $employeeId);

		//Controller::writeTofile('/tmp/leave', print_r($criteria, true));

		$model = $this->find($criteria);
		return $model->sumLeaveTime;
	}

	public function remainLeaveDateByLeaveType($leaveType, $employeeId)
	{
		$sumLeaveDate = $this->sumLeaveDateByLeaveType($leaveType, $employeeId);
		$employeeModel = Employee::model()->findByPk($employeeId);

		switch ($leaveType)
		{
			case 1:
				$quota = self::LEAVE_SICK_QUOTA;
				break;

			case 2:
				$quota = self::LEAVE_PERSONAL_QUOTA;
				break;

			case 3:
				return $employeeModel->leaveRemain;
				break;
		}

		return $quota - $sumLeaveDate;
	}

	public function remainWaitApproveLeaveDateByLeaveType($leaveType, $employeeId)
	{
		$sumLeaveDate = $this->sumWaitApproveLeaveDateByLeaveType($leaveType, $employeeId);
		$employeeModel = Employee::model()->findByPk($employeeId);

		return $sumLeaveDate;
	}

	public function remainLeaveText($remainLeave)
	{
		$remainDate = floor($remainLeave);
		$remainHour = $remainLeave - $remainDate;
		return floor($remainDate) . ' วัน ' . ($remainHour / 0.125) . ' ชั่วโมง';
	}

	public function updateLeaveByDocumentIdAndWorkflowStatusId($documentId, $workflowStatusId)
	{
		$model = $this->find('documentId=' . $documentId);

		$model->status = ($workflowStatusId == 4) ? 1 : 2;

		return $model->save();
	}

	public function sumLeaveTimeByLeaveTimeTypeArray($leaveTimeTypeArray)
	{
		$sumLeaveTime = 0;
		foreach ($leaveTimeTypeArray as $leaveTimeType)
		{
			$sumLeaveTime += LeaveItem::model()->genLeaveTime($leaveTimeType);
		}
		return $sumLeaveTime;
	}

}

