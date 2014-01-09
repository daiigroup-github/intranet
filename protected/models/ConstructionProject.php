<?php

/**
 * This is the model class for table "construction_project".
 *
 * The followings are the available columns in table 'construction_project':
 * @property string $projectId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $productCatId
 * @property string $productValue
 * @property string $name
 * @property string $detail
 * @property double $price
 * @property string $imageUrl
 * @property string $address
 * @property integer $amphurId
 * @property integer $provinceId
 * @property string $customerId
 * @property string $engineerId
 * @property string $startDate
 * @property string $endDate
 * @property integer $duration
 * @property string $latitude
 * @property string $longitude
 * @property string $branchValue
 */
class ConstructionProject extends CActiveRecord
{

	public $searchText;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConstructionProject the static model class
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
		return 'construction_project';
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
				'createDateTime, updateDateTime, productCatId, name, price, customerId, engineerId, startDate, duration',
				'required'),
			array(
				'status, amphurId, provinceId, duration',
				'numerical',
				'integerOnly'=>true),
			array(
				'price',
				'numerical'),
			array(
				'productCatId, productValue, customerId, engineerId, branchValue',
				'length',
				'max'=>10),
			array(
				'name',
				'length',
				'max'=>100),
			array(
				'imageUrl, address',
				'length',
				'max'=>255),
			array(
				'latitude, longitude',
				'length',
				'max'=>20),
			array(
				'detail, endDate',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'projectId, status, createDateTime, updateDateTime, productCatId, productValue, name, detail, price, imageUrl, address, amphurId, provinceId, customerId, engineerId, startDate, endDate, duration, latitude, longitude, branchValue',
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
			'engineer'=>array(
				self::BELONGS_TO,
				'Employee',
				'engineerId'),
			'process'=>array(
				self::HAS_MANY,
				'ConstructionProcess',
				'projectId'),
			'productCat'=>array(
				self::BELONGS_TO,
				'ProductCategory',
				'productCatId'),
			'customer'=>array(
				self::BELONGS_TO,
				'Customer',
				'customerId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'projectId'=>'Project',
			'status'=>'Status',
			'createDateTime'=>'Create Date Time',
			'updateDateTime'=>'Update Date Time',
			'productCatId'=>'Product Cat',
			'productValue'=>'Product Value',
			'name'=>'ชื่อโครงการ',
			'detail'=>'รายละเอียด',
			'price'=>'มูลค่าโครงการ',
			'imageUrl'=>'Image Url',
			'address'=>'ที่อยู่',
			'amphurId'=>'อำเภอ',
			'provinceId'=>'จังหวัด',
			'customerId'=>'ลูกค้า',
			'engineerId'=>'วิศวกร',
			'startDate'=>'วันเริ่มงาน',
			'endDate'=>'วันจบงาน',
			'duration'=>'ระยะเวลาก่อสร้าง',
			'latitude'=>'Latitude',
			'longitude'=>'Longitude',
			'branchValue'=>'สาขา',
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
		$criteria->compare('updateDateTime', $this->updateDateTime, true);
		$criteria->compare('productCatId', $this->productCatId, true);
		$criteria->compare('productValue', $this->productValue, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('detail', $this->detail, true);
		$criteria->compare('price', $this->price);
		$criteria->compare('imageUrl', $this->imageUrl, true);
		$criteria->compare('address', $this->address, true);
		$criteria->compare('amphurId', $this->amphurId);
		$criteria->compare('provinceId', $this->provinceId);
		$criteria->compare('customerId', $this->customerId, true);
		$criteria->compare('engineerId', $this->engineerId, true);
		$criteria->compare('startDate', $this->startDate, true);
		$criteria->compare('endDate', $this->endDate, true);
		$criteria->compare('duration', $this->duration);
		$criteria->compare('latitude', $this->latitude, true);
		$criteria->compare('longitude', $this->longitude, true);
		$criteria->compare('branchValue', $this->branchValue, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
