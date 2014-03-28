<?php

/**
 * This is the model class for table "elearning_exam".
 *
 * The followings are the available columns in table 'elearning_exam':
 * @property string $elearningExamId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $employeeId
 * @property integer $point
 * @property string $createBy
 * @property string $examDate
 */
class ElearningExam extends CActiveRecord
{
	public $searchText;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ElearningExam the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'elearning_exam';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createDateTime, updateDateTime, employeeId, createBy, examDate', 'required'),
			array('status, point', 'numerical', 'integerOnly'=>true),
			array('employeeId, createBy', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('elearningExamId, status, createDateTime, updateDateTime, employeeId, point, createBy, examDate, searchText', 'safe', 'on'=>'search'),
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
			'employee'=>array(self::BELONGS_TO, 'Employee', 'employeeId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'elearningExamId' => 'Elearning Exam',
			'status' => 'status',
			'createDateTime' => 'Create Date Time',
			'updateDateTime' => 'Update Date Time',
			'employeeId' => 'Employee',
			'point' => 'Point',
			'createBy' => 'Create By',
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

		$criteria=new CDbCriteria;

		// $criteria->compare('elearningExamId',$this->elearningExamId,true);
		// $criteria->compare('status',$this->status);
		// $criteria->compare('createDateTime',$this->createDateTime,true);
		// $criteria->compare('updateDateTime',$this->updateDateTime,true);
		// $criteria->compare('employeeId',$this->employeeId,true);
		// $criteria->compare('point',$this->point);
		// $criteria->compare('createBy',$this->createBy,true);
		// 
		$criteria->compare('examDate',$this->examDate,true, 'OR');

		$criteria->with = array('employee');
		$criteria->compare('employee.fnTh', $this->searchText, true, 'OR');
		$criteria->compare('employee.lnTh', $this->searchText, true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getStatusText($status)
	{
		switch($status)
		{
			case 0:
				echo '<span class="label">รอสอบ</span>';
				break;

			case 1:
				echo '<span class="label label-warning">กำลังสอบ</span>';
				break;
				
			case 2:
				echo '<span class="label-success">สอบเสร็จ</span>';
				break;
				
			case 3:
				echo '<span class="label label-important">ยกเลิก</span>';
				break;
				
		}
	}

	public function hasExamToday()
	{
		$today = date('Y-m-d');
		$criteria = new CDbCriteria;
		$criteria->condition = 'employeeId=:employeeId AND examDate=:today AND status=0';
		$criteria->params = array(':employeeId'=>Yii::app()->user->id, ':today'=>$today);

		return $this->find($criteria);
	}
}