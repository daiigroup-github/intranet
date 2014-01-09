<?php

/**
 * This is the model class for table "application_interview".
 *
 * The followings are the available columns in table 'application_interview':
 * @property string $id
 * @property string $applicationId
 * @property string $managerId
 * @property integer $isHeadManager
 * @property string $interviewDate
 * @property string $scoreDateTime
 * @property string $score
 * @property integer $status
 */
class ApplicationInterview extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicationInterview the static model class
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
		return 'application_interview';
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
				'applicationId, managerId, isHeadManager, status',
				'required'),
			array(
				'isHeadManager, status',
				'numerical',
				'integerOnly'=>true),
			array(
				'applicationId, managerId',
				'length',
				'max'=>20),
			array(
				'score',
				'length',
				'max'=>10),
			array(
				'interviewDate, scoreDateTime',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'id, applicationId, managerId, isHeadManager, interviewDate, scoreDateTime, score, status',
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
			'employeeInfo'=>array(
				self::BELONGS_TO,
				'EmployeeInfo',
				array(
					'applicationId'=>'id')),
			'manager'=>array(
				self::BELONGS_TO,
				'Employee',
				array(
					'managerId'=>'employeeId')),
			'appInterviewScore'=>array(
				self::HAS_MANY,
				'ApplicationInterviewScore',
				array(
					'applicationInterviewId'=>'id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'=>'ID',
			'applicationId'=>'ผู้สมัคร',
			'managerId'=>'ผู้สัมภาษณ์',
			'isHeadManager'=>'หัวหน้าสัมภาษณ์',
			/* 'examId' => 'Exam',
			  'questionId' => 'คำถาม',
			  'questionWeight' => 'ตัวคูณคำถาม',
			  'choiceId' => 'คำตอบ',
			  'choiceValue' => 'ค่าของคำตอบ', */
			'interviewDate'=>'วันนัดสัมภาษณ์',
			'scoreDateTime'=>'วันที่ให้คะแนนสัมภาษณ์',
			'score'=>'คะแนน',
			'status'=>'สถานะ',
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

		$criteria->compare('id', $this->id, true);
		$criteria->compare('applicationId', $this->applicationId, true);
		$criteria->compare('managerId', $this->managerId, true);
		$criteria->compare('isHeadManager', $this->isHeadManager);
		$criteria->compare('interviewDate', $this->interviewDate, true);
		$criteria->compare('score', $this->score, true);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function switchAction()
	{
		switch(strtolower(Yii::app()->controller->action->id))
		{
			case "jobinterview":
				return EmployeeInfo::model()->findJobInterviewList();
				break;
			case "interview":
				return $this->findInterviewerList(Yii::app()->user->id);
				break;
			case "interviewtoceo":
				return $this->findInterviewToCeoList(Yii::app()->user->id);
				break;
			case "ceo":
				return $this->findCeoInterviewerList(Yii::app()->user->id);
				break;
			case "accept":
				return $this->findCeoAppreved(Yii::app()->user->id);
				break;
		}
	}

	public function findInterviewerList($managerId)
	{
		$criteria = new CDbCriteria;
		$criteria->compare('managerId', $managerId);
		$criteria->compare('status', 1);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findInterviewToCeoList($managerId)
	{
		$criteria = new CDbCriteria;
		$criteria->join = " LEFT JOIN employee_info ei ON ei.id = t.applicationId ";
		$criteria->compare('ei.status', 2);
		$criteria->compare('managerId', $managerId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findCeoAppreved($managerId)
	{
		$criteria = new CDbCriteria;
		$criteria->compare('managerId', $managerId);
		$criteria->compare('status', 3);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function Interviewed($appInterId)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = "score is null";
		$criteria->compare('status', 1);
		$criteria->compare('managerId', Yii::app()->user->id);
		$criteria->compare('applicationId', $appInterId);
		$res = $this->findAll($criteria);
		if(count($res) > 0)
		{
			return 0;
		}
		else
		{
			return 1;
		}
	}

	public function InterviewedAll($appInterId)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = "score is null";
		$criteria->compare('status', 1);
		$criteria->compare('applicationId', $appInterId);

		if(count($this->findAll($criteria)) > 0)
		{
			if(count($this->findAll($criteria)) == 1)
			{
				$result = 0;
				foreach($this->findAll($criteria) as $item)
				{
					if($item->managerId == 1)
					{
						$result = 1;
					}
				}
				return $result;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 1;
		}
	}

}
