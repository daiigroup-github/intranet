<?php

/**
 * This is the model class for table "qtech_project".
 *
 * The followings are the available columns in table 'qtech_project':
 * @property string $qtechProjectId
 * @property integer $status
 * @property string $createTime
 * @property string $productCatId
 * @property string $productValue
 * @property string $projectName
 * @property string $projectDetail
 * @property double $projectPrice
 * @property string $projectImage
 * @property string $projectAddress
 * @property string $customerId
 * @property string $employeeId
 * @property string $startDate
 * @property string $endDate
 * @property string $latitude
 * @property string $longitude
 * @property string $branchValue
 */
class QtechProject extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QtechProject the static model class
	 */
	public $searchText;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'qtech_project';
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
				'productCatId, projectName, customerId',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly'=>true),
			array(
				'projectPrice',
				'numerical'),
			array(
				'productCatId, productValue, customerId, employeeId, branchValue',
				'length',
				'max'=>10),
			array(
				'projectName',
				'length',
				'max'=>100),
			array(
				'projectDetail, projectImage, projectAddress',
				'length',
				'max'=>255),
			array(
				'latitude, longitude',
				'length',
				'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'qtechProjectId, status, createTime, productCatId, productValue, projectName, projectDetail, projectPrice, projectImage, projectAddress, customerId, employeeId, startDate, endDate, latitude, longitude, branchValue, searchText',
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
			'customer'=>array(
				self::BELONGS_TO,
				'Customer',
				array(
					'customerId'=>'customerId')),
			'productCat'=>array(
				self::BELONGS_TO,
				'ProductCategory',
				array(
					'productCatId'=>'productCatId')),
			'branch'=>array(
				self::BELONGS_TO,
				'Branch',
				array(
					'branchId'=>'branchId')),
			'process'=>array(
				self::HAS_MANY,
				'QtechProcess',
				array(
					'qtechProjectId'=>'qtechProjectId')),
			'processSub'=>array(
				self::HAS_MANY,
				'QtechProcessSub',
				array(
					'qtechProjectId'=>'qtechProjectId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'qtechProjectId'=>'Project',
			'status'=>'Status',
			'createTime'=>'Create Time',
			'productCatId'=>'Product Cat',
			'productValue'=>'Product Value',
			'projectName'=>'Project Name',
			'projectDetail'=>'Project Detail',
			'projectPrice'=>'Project Price',
			'projectImage'=>'Project Image',
			'projectAddress'=>'Project Address',
			'customerId'=>'Customer',
			'employeeId'=>'Employee',
			'startDate'=>'Start Date',
			'endDate'=>'End Date',
			'latitude'=>'Latitude',
			'longitude'=>'Longitude',
			'branchValue'=>'Branch Value',
			'searchText'=>'Search Text',
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

		$criteria->with = array(
			'customer');
		$criteria->compare('customer.customerName', $this->searchText, true, 'OR');
		$criteria->compare('projectName', $this->searchText, true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function projectByqtechProjectId($qtechProjectId)
	{
		$p = new QtechProject;

		$model = $p->find('qtechProjectId=' . $qtechProjectId);

		return $model;
	}

}
