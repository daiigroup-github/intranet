<?php

/**
 * This is the model class for table "mileage".
 *
 * The followings are the available columns in table 'mileage':
 * @property integer $mileageId
 * @property integer $status
 * @property string $createDate
 * @property string $createTime
 * @property string $captureDateTime
 * @property string $mileage
 * @property string $mileageDiff
 * @property string $mileageDetail
 * @property string $mileageImage
 * @property string $latitude
 * @property string $longitude
 * @property string $employeeId
 * @property string $branchId
 * @property string $qtechProjectId
 */
class Mileage extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mileage the static model class
	 */
	public $startDate;
	public $endDate;
	public $sumMileageDiff;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mileage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('createDate, createTime, captureDateTime, mileage, mileageDiff, mileageImage, latitude, longitude, employeeId, branchId, qtechProjectId', 'required'),
			array(
				'status',
				'numerical',
				'integerOnly'=>true),
			array(
				'mileage, branchId, qtechProjectId',
				'length',
				'max'=>11),
			array(
				'mileageDiff',
				'length',
				'max'=>5),
			array(
				'mileageImage',
				'length',
				'max'=>255),
			array(
				'latitude, longitude',
				'length',
				'max'=>20),
			array(
				'employeeId',
				'length',
				'max'=>10),
			array(
				'mileageDetail',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'createDate, startDate, endDate, employeeId',
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
			'employee'=>array(
				self::BELONGS_TO,
				'Employee',
				array(
					'employeeId'=>'employeeId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mileageId'=>'Mileage',
			'status'=>'Status',
			'createDate'=>'Create Date',
			'createTime'=>'Create Date Time',
			'captureDateTime'=>'Capture Time',
			'mileage'=>'Mileage',
			'mileageDiff'=>'Mileage Diff',
			'mileageDetail'=>'Mileage Detail',
			'mileageImage'=>'Mileage Image',
			'latitude'=>'Latitude',
			'longitude'=>'Longitude',
			'employeeId'=>'Employee',
			'branchId'=>'Branch',
			'qtechProjectId'=>'Project',
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
		$criteria->select = 'createDate, employeeId';
		$criteria->distinct = true;
		$criteria->addCondition('employeeId="' . $this->employeeId . '" AND createDate between "' . $this->startDate . '" AND "' . $this->endDate . '"');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	//Custom
	public function mileageWithEmployeeId($employeeId, $createDate)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'employeeId=' . $employeeId . ' AND createDate="' . $createDate . '"';

		return new CActiveDataProvider('Mileage', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>5,
			),
		));
	}

	public function mileageDailyWithEmployeeId($employeeId)
	{
		$criteria = new CDbCriteria;
		$criteria->select = 'employeeId, createDate, sum(mileageDiff) AS sumMileageDiff';
		$criteria->group = 'createDate';
		$criteria->order = 'createDate DESC';
		$criteria->compare('employeeId', $employeeId);

		return new CActiveDataProvider('Mileage', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
	}

	public function mileageDateWithEmployeeIdAndDateRange($employeeId, $startDate, $endDate)
	{
		$criteria = new CDbCriteria();
// 		$criteria->select = 'createDate, employeeId';
// 		$criteria->distinct = true;
		$criteria->select = 'employeeId, createDate, sum(mileageDiff) AS sumMileageDiff';
		$criteria->group = 'createDate';
		$criteria->order = 'createDate DESC';
		$criteria->addCondition('employeeId="' . $employeeId . '" AND createDate between "' . $startDate . '" AND "' . $endDate . '"');

		return Mileage::model()->findAll($criteria);
	}

	public function mileageWithEmployeeIdAndDate($employeeId, $date)
	{
		$criteria = new CDbCriteria();
		$criteria->addCondition('employeeId="' . $employeeId . '" AND createDate="' . $date . '"');

		return new CActiveDataProvider('Mileage', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
	}

	public function getAllEmployeeInMileage()
	{
		$criteria = new CDbCriteria();
		$criteria->select = 'employeeId';
		$criteria->distinct = true;
		$criteria->with = 'employee';
		$criteria->order = 'employee.username';

		$models = Mileage::model()->findAll($criteria);

		$e = array(
			''=>'---');

		foreach($models as $model)
		{
			if($model->employee)
				$e[$model->employeeId] = $model->employee->username;
		}
		return $e;
	}

}
