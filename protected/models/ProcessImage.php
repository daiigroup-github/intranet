<?php

/**
 * This is the model class for table "process_image".
 *
 * The followings are the available columns in table 'process_image':
 * @property string $processImageId
 * @property integer $status
 * @property string $createDateTime
 * @property string $imageDate
 * @property string $imageTime
 * @property string $processImageName
 * @property string $processImageDetail
 * @property string $processId
 * @property string $latitude
 * @property string $longitude
 * @property string $direction
 * @property integer $labour
 * @property integer $type
 */
class ProcessImage extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProcessImage the static model class
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
		return 'process_image';
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
				'createDateTime, imageDate, imageTime, processImageName, processImageDetail, processId, latitude, longitude, direction, labour',
				'required'),
			array(
				'status, labour, type',
				'numerical',
				'integerOnly' => true),
			array(
				'processImageName',
				'length',
				'max' => 255),
			array(
				'processImageDetail',
				'length',
				'max' => 150),
			array(
				'processId',
				'length',
				'max' => 10),
			array(
				'latitude, longitude, direction',
				'length',
				'max' => 20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'processImageId, status, createDateTime, imageDate, imageTime, processImageName, processImageDetail, processId, latitude, longitude, direction, labour, type',
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
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'processImageId' => 'Process Image',
			'status' => 'Status',
			'createDateTime' => 'Create Date Time',
			'imageDate' => 'Image Date',
			'imageTime' => 'Image Time',
			'processImageName' => 'Process Image Name',
			'processImageDetail' => 'Process Image Detail',
			'processId' => 'Process',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'direction' => 'Direction',
			'labour' => 'Labour',
			'type' => 'Type',
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

		$criteria->compare('processImageId', $this->processImageId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true);
		$criteria->compare('imageDate', $this->imageDate, true);
		$criteria->compare('imageTime', $this->imageTime, true);
		$criteria->compare('processImageName', $this->processImageName, true);
		$criteria->compare('processImageDetail', $this->processImageDetail, true);
		$criteria->compare('processId', $this->processId, true);
		$criteria->compare('latitude', $this->latitude, true);
		$criteria->compare('longitude', $this->longitude, true);
		$criteria->compare('direction', $this->direction, true);
		$criteria->compare('labour', $this->labour);
		$criteria->compare('type', $this->type);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}