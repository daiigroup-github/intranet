<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property string $projectId
 * @property integer $status
 * @property string $createDateTime
 * @property string $productCatId
 * @property string $productValue
 * @property string $projectName
 * @property string $projectDetail
 * @property double $projectPrice
 * @property string $projectImageName
 * @property string $projectAddress
 * @property string $customerId
 * @property string $startDate
 * @property string $endDate
 * @property string $latitude
 * @property string $longitude
 * @property string $branchValue
 */
class Project extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Project the static model class
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
		return 'project';
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
				'createDateTime, productCatId, productValue, projectName, projectDetail, projectPrice, projectImageName, projectAddress, customerId, startDate, endDate, latitude, longitude',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly' => true),
			array(
				'projectPrice',
				'numerical'),
			array(
				'productCatId, productValue, customerId, branchValue',
				'length',
				'max' => 10),
			array(
				'projectName',
				'length',
				'max' => 100),
			array(
				'projectDetail, projectImageName, projectAddress',
				'length',
				'max' => 255),
			array(
				'latitude, longitude',
				'length',
				'max' => 20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'projectId, status, createDateTime, productCatId, productValue, projectName, projectDetail, projectPrice, projectImageName, projectAddress, customerId, startDate, endDate, latitude, longitude, branchValue',
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
			'customer' => array(
				self::BELONGS_TO,
				'Customer',
				array(
					'customerId' => 'customerId')),
			'productCat' => array(
				self::BELONGS_TO,
				'ProductCategory',
				array(
					'productCatId' => 'productCatId')),
			'branch' => array(
				self::BELONGS_TO,
				'Branch',
				array(
					'branchId' => 'branchId')),
			'process' => array(
				self::HAS_MANY,
				'Process',
				array(
					'projectId' => 'projectId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'projectId' => 'โครงการ',
			'status' => 'สถานะ',
			'createDateTime' => 'วันที่สร้าง',
			'productCatId' => 'Product Cat',
			'productValue' => 'Product Value',
			'projectName' => 'ชื่อโครงการ',
			'projectDetail' => 'รายละเอียดโครงการ',
			'projectPrice' => 'ราคาโครงการ',
			'projectImageName' => 'ชื่อรูปโครงการ',
			'projectAddress' => 'ที่อยู่โครงการ',
			'customerId' => 'ลูกค้า',
			'startDate' => 'วันเริ่ม',
			'endDate' => 'วันสิ้นสุด',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'branchValue' => 'Branch Value',
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

		$criteria->compare('projectId', $this->projectId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true);
		$criteria->compare('productCatId', $this->productCatId, true);
		$criteria->compare('productValue', $this->productValue, true);
		$criteria->compare('projectName', $this->projectName, true);
		$criteria->compare('projectDetail', $this->projectDetail, true);
		$criteria->compare('projectPrice', $this->projectPrice);
		$criteria->compare('projectImageName', $this->projectImageName, true);
		$criteria->compare('projectAddress', $this->projectAddress, true);
		$criteria->compare('customerId', $this->customerId);
		$criteria->compare('startDate', $this->startDate, true);
		$criteria->compare('endDate', $this->endDate, true);
		$criteria->compare('latitude', $this->latitude, true);
		$criteria->compare('longitude', $this->longitude, true);
		$criteria->compare('branchValue', $this->branchValue, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => 30
			),
		));
	}

	public function behaviors()
	{
		return array(
			'ERememberFiltersBehavior' => array(
				'class' => 'application.components.ERememberFiltersBehavior',
				'defaults' => array(
				), /* optional line */
				'defaultStickOnClear' => false /* optional line */
			),
		);
	}

}