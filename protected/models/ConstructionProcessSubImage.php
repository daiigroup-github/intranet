<?php

/**
 * This is the model class for table "construction_process_sub_image".
 *
 * The followings are the available columns in table 'construction_process_sub_image':
 * @property string $processSubImageId
 * @property integer $status
 * @property string $createDateTime
 * @property string $imageDate
 * @property string $imageTime
 * @property string $name
 * @property string $detail
 * @property string $processId
 * @property string $processSubId
 * @property string $latitude
 * @property string $longitude
 * @property string $direction
 * @property integer $labour
 */
class ConstructionProcessSubImage extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConstructionProcessSubImage the static model class
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
		return 'construction_process_sub_image';
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
				'createDateTime, imageDate, imageTime, name, detail, processId, processSubId, latitude, longitude, direction, labour',
				'required'),
			array(
				'status, labour',
				'numerical',
				'integerOnly' => true),
			array(
				'name',
				'length',
				'max' => 255),
			array(
				'detail',
				'length',
				'max' => 150),
			array(
				'processId, processSubId',
				'length',
				'max' => 10),
			array(
				'latitude, longitude, direction',
				'length',
				'max' => 20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'processSubImageId, status, createDateTime, imageDate, imageTime, name, detail, processId, processSubId, latitude, longitude, direction, labour',
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
			'processSub' => array(
				self::BELONGS_TO,
				'ConstructionProcessSub',
				'processSubId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'processSubImageId' => 'Process Sub Image',
			'status' => 'Status',
			'createDateTime' => 'Create Date Time',
			'imageDate' => 'Image Date',
			'imageTime' => 'Image Time',
			'name' => 'Name',
			'detail' => 'Detail',
			'processId' => 'Process',
			'processSubId' => 'Process Sub',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'direction' => 'Direction',
			'labour' => 'Labour',
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
		$criteria->compare('createDateTime', $this->createDateTime, true);
		$criteria->compare('imageDate', $this->imageDate, true);
		$criteria->compare('imageTime', $this->imageTime, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('detail', $this->detail, true);
		$criteria->compare('processId', $this->processId, true);
		$criteria->compare('processSubId', $this->processSubId, true);
		$criteria->compare('latitude', $this->latitude, true);
		$criteria->compare('longitude', $this->longitude, true);
		$criteria->compare('direction', $this->direction, true);
		$criteria->compare('labour', $this->labour);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}