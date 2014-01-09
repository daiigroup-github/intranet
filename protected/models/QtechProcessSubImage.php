<?php

/**
 * This is the model class for table "qtech_process_sub_image".
 *
 * The followings are the available columns in table 'qtech_process_sub_image':
 * @property string $processSubImageId
 * @property integer $status
 * @property string $imageDate
 * @property string $imageTime
 * @property string $imageName
 * @property string $imageDetail
 * @property string $qtechProjectId
 * @property string $qtechProcessId
 * @property string $processSubId
 * @property string $latitude
 * @property string $longitude
 * @property string $direction
 * @property string $employeeId
 * @property string $identifier
 * @property integer $labour
 */
class QtechProcessSubImage extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QtechProcessSubImage the static model class
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
		return 'qtech_process_sub_image';
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
				'imageDate, imageTime, imageName, imageDetail, qtechProjectId, qtechProcessId, processSubId, latitude, longitude, direction, employeeId, identifier, labour',
				'required'),
			array(
				'status, labour',
				'numerical',
				'integerOnly'=>true),
			array(
				'imageName',
				'length',
				'max'=>255),
			array(
				'imageDetail',
				'length',
				'max'=>150),
			array(
				'qtechProjectId, qtechProcessId, processSubId, employeeId',
				'length',
				'max'=>10),
			array(
				'latitude, longitude, direction',
				'length',
				'max'=>20),
			array(
				'identifier',
				'length',
				'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'processSubImageId, status, imageDate, imageTime, imageName, imageDetail, qtechProjectId, qtechProcessId, processSubId, latitude, longitude, direction, employeeId, identifier, labour',
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
				'QtechProject',
				array(
					'qtechProjectId'=>'qtechProjectId')),
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
			'processSubImageId'=>'Process Sub Image',
			'status'=>'Status',
			'imageDate'=>'Image Date',
			'imageTime'=>'Image Time',
			'imageName'=>'Image Name',
			'imageDetail'=>'Image Detail',
			'qtechProjectId'=>'Project',
			'qtechProcessId'=>'Process',
			'processSubId'=>'Process Sub',
			'latitude'=>'Latitude',
			'longitude'=>'Longitude',
			'direction'=>'Direction',
			'employeeId'=>'Employee',
			'identifier'=>'Identifier',
			'labour'=>'Labour',
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

		$criteria->compare('processSubImageId', $this->processSubImageId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('imageDate', $this->imageDate, true);
		$criteria->compare('imageTime', $this->imageTime, true);
		$criteria->compare('imageName', $this->imageName, true);
		$criteria->compare('imageDetail', $this->imageDetail, true);
		$criteria->compare('qtechProjectId', $this->qtechProjectId, true);
		$criteria->compare('qtechProcessId', $this->qtechProcessId, true);
		$criteria->compare('processSubId', $this->processSubId, true);
		$criteria->compare('latitude', $this->latitude, true);
		$criteria->compare('longitude', $this->longitude, true);
		$criteria->compare('direction', $this->direction, true);
		$criteria->compare('employeeId', $this->employeeId, true);
		$criteria->compare('identifier', $this->identifier, true);
		$criteria->compare('labour', $this->labour);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	//Custom
	public function loadAllProcessSubImageByProcessSubId($processSubId)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'processSubId=:processSubId';
		$criteria->params = array(
			':processSubId'=>$processSubId);
		$criteria->order = 'processSubImageId DESC';

		return new CActiveDataProvider('QtechProcessSubImage', array(
			'criteria'=>$criteria,
		));
	}

}
