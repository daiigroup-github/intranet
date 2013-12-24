<?php

/**
 * This is the model class for table "leave_item".
 *
 * The followings are the available columns in table 'leave_item':
 * @property string $leaveItemId
 * @property string $leaveId
 * @property integer $status
 * @property string $leaveDate
 * @property double $leaveTime
 * @property integer $leaveTimeType
 */
class LeaveItem extends CActiveRecord
{

	const LEAVE_TIME_RANGE_NONE = 0;
	const LEAVE_TIME_RANGE_FULLDAY = 1;
	const LEAVE_TIME_RANGE_MORNING = 2;
	const LEAVE_TIME_RANGE_AFTERNOON = 3;
	const LEAVE_TIME_RANGE_13_14 = 10;
	const LEAVE_TIME_RANGE_13_15 = 11;
	const LEAVE_TIME_RANGE_13_16 = 12;
	const LEAVE_TIME_RANGE_13_17 = 13;
	const LEAVE_TIME_RANGE_13_18 = 14;
	const LEAVE_TIME_RANGE_14_15 = 19;
	const LEAVE_TIME_RANGE_14_16 = 20;
	const LEAVE_TIME_RANGE_14_17 = 21;
	const LEAVE_TIME_RANGE_14_18 = 22;
	const LEAVE_TIME_RANGE_15_16 = 28;
	const LEAVE_TIME_RANGE_15_17 = 29;
	const LEAVE_TIME_RANGE_15_18 = 30;
	const LEAVE_TIME_RANGE_15_19 = 31;
	const LEAVE_TIME_RANGE_15_20 = 32;
	const LEAVE_TIME_RANGE_16_17 = 37;
	const LEAVE_TIME_RANGE_16_18 = 38;
	const LEAVE_TIME_RANGE_16_19 = 39;
	const LEAVE_TIME_RANGE_16_20 = 40;
	const LEAVE_TIME_RANGE_17_18 = 46;
	const LEAVE_TIME_RANGE_17_19 = 47;
	const LEAVE_TIME_RANGE_17_20 = 48;
	const LEAVE_TIME_RANGE_18_19 = 55;
	const LEAVE_TIME_RANGE_18_20 = 56;
	const LEAVE_TIME_RANGE_18_21 = 57;
	const LEAVE_TIME_RANGE_19_20 = 64;
	const LEAVE_TIME_RANGE_19_21 = 65;
	const LEAVE_TIME_RANGE_20_21 = 73;

	public $sumLeaveTime;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LeaveItem the static model class
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
		return 'leave_item';
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
				'leaveTime, leaveTimeType',
				'required'),
			array(
				'status, leaveTimeType',
				'numerical',
				'integerOnly' => true),
			array(
				'leaveTime',
				'numerical'),
			array(
				'leaveId',
				'length',
				'max' => 45),
			array(
				'leaveDate',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'leaveItemId, leaveId, status, leaveDate, leaveTime, leaveTimeType',
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
			'leave' => array(
				self::BELONGS_TO,
				'Leave',
				'leaveId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'leaveItemId' => 'Leave Item',
			'leaveId' => 'Leave',
			'status' => 'Status',
			'leaveDate' => 'Leave Date',
			'leaveTime' => 'Leave Time',
			'leaveTimeType' => 'Leave Time Type',
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

		$criteria->compare('leaveItemId', $this->leaveItemId, true);
		$criteria->compare('leaveId', $this->leaveId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('leaveDate', $this->leaveDate, true);
		$criteria->compare('leaveTime', $this->leaveTime);
		$criteria->compare('leaveTimeType', $this->leaveTimeType);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	//custom
	public function getLeaveItemTimeTypeArray($type = null)
	{
		$emp = Employee::model()->findByPk(Yii::app()->user->id);

		if ($type != 3)
		{
			if ($emp->branchId == 1)
			{
				$result = array(
					self::LEAVE_TIME_RANGE_NONE => 'ไม่ลา',
					self::LEAVE_TIME_RANGE_FULLDAY => 'เต็มวัน',
					self::LEAVE_TIME_RANGE_MORNING => 'ครึ่งวันเช้า',
					self::LEAVE_TIME_RANGE_AFTERNOON => 'ครึ่งวันบ่าย',
					self::LEAVE_TIME_RANGE_13_14 => '1 ชั่วโมง เวลา 13.00-14.00',
					self::LEAVE_TIME_RANGE_14_15 => '1 ชั่วโมง เวลา 14.00-15.00',
					self::LEAVE_TIME_RANGE_15_16 => '1 ชั่วโมง เวลา 15.00-16.00',
					self::LEAVE_TIME_RANGE_16_17 => '1 ชั่วโมง เวลา 16.00-17.00',
					self::LEAVE_TIME_RANGE_13_15 => '2 ชั่วโมง เวลา 13.00-15.00',
					self::LEAVE_TIME_RANGE_14_16 => '2 ชั่วโมง เวลา 14.00-16.00',
					self::LEAVE_TIME_RANGE_15_17 => '2 ชั่วโมง เวลา 15.00-17.00',
					self::LEAVE_TIME_RANGE_13_16 => '3 ชั่วโมง เวลา 13.00-16.00',
					self::LEAVE_TIME_RANGE_14_17 => '3 ชั่วโมง เวลา 14.00-17.00',
					self::LEAVE_TIME_RANGE_13_17 => '4 ชั่วโมง เวลา 13.00-17.00',
				);
			}
			else
			{
				$result = array(
					self::LEAVE_TIME_RANGE_FULLDAY => 'เต็มวัน',
					self::LEAVE_TIME_RANGE_MORNING => 'ครึ่งวันเช้า',
					self::LEAVE_TIME_RANGE_AFTERNOON => 'ครึ่งวันบ่าย',
					self::LEAVE_TIME_RANGE_15_16 => '1 ชั่วโมง เวลา 15.00-16.00',
					self::LEAVE_TIME_RANGE_16_17 => '1 ชั่วโมง เวลา 16.00-17.00',
					self::LEAVE_TIME_RANGE_17_18 => '1 ชั่วโมง เวลา 17.00-18.00',
					self::LEAVE_TIME_RANGE_18_19 => '1 ชั่วโมง เวลา 18.00-19.00',
					self::LEAVE_TIME_RANGE_19_20 => '1 ชั่วโมง เวลา 19.00-20.00',
					self::LEAVE_TIME_RANGE_20_21 => '1 ชั่วโมง เวลา 20.00-21.00',
					self::LEAVE_TIME_RANGE_15_17 => '2 ชั่วโมง เวลา 15.00-17.00',
					self::LEAVE_TIME_RANGE_16_18 => '2 ชั่วโมง เวลา 16.00-18.00',
					self::LEAVE_TIME_RANGE_17_19 => '2 ชั่วโมง เวลา 17.00-19.00',
					self::LEAVE_TIME_RANGE_18_20 => '2 ชั่วโมง เวลา 18.00-20.00',
					self::LEAVE_TIME_RANGE_19_21 => '2 ชั่วโมง เวลา 19.00-21.00',
					self::LEAVE_TIME_RANGE_15_18 => '3 ชั่วโมง เวลา 15.00-18.00',
					self::LEAVE_TIME_RANGE_16_19 => '3 ชั่วโมง เวลา 16.00-19.00',
					self::LEAVE_TIME_RANGE_17_20 => '3 ชั่วโมง เวลา 17.00-20.00',
					self::LEAVE_TIME_RANGE_18_21 => '3 ชั่วโมง เวลา 18.00-21.00',
					self::LEAVE_TIME_RANGE_NONE => 'ไม่ลา',
				);
			}
		}
		else
		{
			$result = array(
				self::LEAVE_TIME_RANGE_NONE => 'ไม่ลา',
				self::LEAVE_TIME_RANGE_FULLDAY => 'เต็มวัน',
				self::LEAVE_TIME_RANGE_MORNING => 'ครึ่งวันเช้า',
				self::LEAVE_TIME_RANGE_AFTERNOON => 'ครึ่งวันบ่าย',
			);
		}
		return $result;
	}

	public function leaveItemTimeTypeText($leaveTimeRange)
	{
		$ltr = $this->leaveItemTimeTypeArray;
		return $ltr[$leaveTimeRange];
	}

	public function genLeaveTime($leaveTimeType)
	{
		if ($leaveTimeType == 1)
		{
			return 1;
		}
		else if ($leaveTimeType == 2 || $leaveTimeType == 3)
		{
			return 0.5;
		}
		else
		{
			return (($leaveTimeType % 9) * 0.125);
		}
	}

	public function getAllApprovedLeaveItemByEmployeeId($employeeId, $startDate, $endDate, $inAround = false)
	{
		if ($inAround)
		{
			$calendar = Calendar::model()->getSalaryDateOfNow();
			$saralyDay = $calendar->saralyDay;
		}
		$criteria = new CDbCriteria();
		$criteria->select = 't.* ,w.createDateTime';
		$criteria->join = 'LEFT JOIN `leave` l on l.leaveId=t.leaveId';
		$criteria->join .= ' LEFT JOIN `document` d on l.documentId=d.documentId';
		$criteria->join .= " LEFT JOIN workflow_log w on w.documentId = d.documentId AND w.workflowStateId = 210 ";
		$criteria->join .= ' LEFT JOIN document_type dt on d.documentTypeId=dt.documentTypeId';
		$criteria->condition = 'd.employeeId=:employeeId AND dt.documentCodePrefix IN ("RLE","RLO") AND l.status=1 AND (t.leaveDate BETWEEN :startDate AND :endDate)';
		if ($inAround)
		{
			$criteria->condition .= " AND w.createDateTime < DATE_FORMAT(INSERT(convert(now(),char),9,11,'$saralyDay 14:01:00'),'%Y-%m-%d %H:%i:%s')";
		}
		$criteria->params = array(
			':employeeId' => $employeeId,
			':startDate' => $startDate,
			':endDate' => $endDate,);

		return $this->findAll($criteria);
	}

	public function sumLeaveTimeByLeaveId($leaveId)
	{
		$criteria = new CDbCriteria();
		$criteria->select = 'sum(leaveTime) as sumLeaveTime';
		$criteria->condition = 'leaveId=:leaveId';
		$criteria->params = array(
			':leaveId' => $leaveId);

		$model = $this->find($criteria);

		return $model->sumLeaveTime;
	}

}

