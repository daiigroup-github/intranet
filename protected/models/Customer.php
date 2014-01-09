<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property string $customerId
 * @property string $createDateTime
 * @property integer $customerType
 * @property string $customerFnTh
 * @property string $customerLnTh
 * @property string $customerCompany
 * @property string $email
 * @property string $password
 * @property string $companyValue
 * @property string $engineerId
 * @property integer $branchId
 * @property string $branchValue
 * @property string $address
 * @property string $city
 * @property integer $provinceId
 * @property string $zipcode
 * @property string $phone
 */
class Customer extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customer the static model class
	 */
	public $searchText;
	public $companyId;

	const CUSTOMER_TYPE_PERSON = 1;
	const CUSTOMER_TYPE_COMPANY = 2;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer';
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
				' customerFnTh, customerLnTh, phone',
				'required'),
			array(
				'customerType, branchId, provinceId',
				'numerical',
				'integerOnly'=>true),
			array(
				'customerFnTh, city',
				'length',
				'max'=>80),
			array(
				'customerLnTh, customerCompany, email',
				'length',
				'max'=>120),
			array(
				'password',
				'length',
				'max'=>40),
			array(
				'companyValue, engineerId, branchValue, zipcode',
				'length',
				'max'=>10),
			array(
				'phone',
				'length',
				'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'customerId, customerType, customerFnTh, customerLnTh, customerCompany, email, companyValue, engineerId, branchId, branchValue, address, city, provinceId, zipcode, phone, searchText, companyId',
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
			'customerInfo'=>array(
				self::HAS_MANY,
				'CustomerInfo',
				'customerId'),
			'province'=>array(
				self::BELONGS_TO,
				'Province',
				'provinceId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'customerId'=>'ID',
			'createDateTime'=>'วันที่สร้าง',
			'customerType'=>'ประเภทลูกค้า',
			'customerFnTh'=>'ชื่อไทย',
			'customerLnTh'=>'นามสกุลไทย',
			'customerCompany'=>'ลูกค้าบริษัท',
			'email'=>'อีเมล์',
			'password'=>'รหัสผ่าน',
			'companyValue'=>'Company Value',
			'engineerId'=>'Engineer',
			'branchId'=>'Branch',
			'branchValue'=>'Branch Value',
			'address'=>'ที่อยู่',
			'city'=>'เมือง',
			'provinceId'=>'จังหวัด',
			'zipcode'=>'รหัสไปรษณีย์',
			'phone'=>'โทร',
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
		$criteria->compare('customerFnTh', $this->searchText, true, 'OR');
		$criteria->compare('customerLnTh', $this->searchText, true, 'OR');
		$criteria->compare('customerCompany', $this->searchText, true, 'OR');
		$criteria->compare('email', $this->searchText, true, 'OR');

		if($this->companyId)
		{
			$criteria->addCondition('companyValue&' . $this->companyId . ' > 0');
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			/* 'sort' => array(
			  'defaultOrder' => 't.createDateTime DESC',
			  ), */
			'pagination'=>array(
				'pageSize'=>30
			),
		));
	}

	//Customer
	public function getAllCustomer()
	{
		$c = array(
			);

		$models = Customer::model()->findAll();

		foreach($models as $model)
		{
			$c[$model->customerId] = $model->customerFnTh . ' ' . $model->customerLnTh;
		}

		return $c;
	}

	public function getCustomerType()
	{
		return array(
			''=>'---',
			self::CUSTOMER_TYPE_PERSON=>self::CUSTOMER_TYPE_PERSON . ' : บุคคลธรรมดา',
			self::CUSTOMER_TYPE_COMPANY=>self::CUSTOMER_TYPE_COMPANY . ' : บริษัท',
		);
	}

	public function customerTypeText()
	{
		$customerType = $this->customerType;

		return (isset($customerType[$this->customerType])) ? $customerType[$this->customerType] : '-';
	}

	public function getAllCustomerBySaleId()
	{
		$c = array(
			);

		//$models = Customer::model()->findAll("saleId =:saleId",array(":saleId"=>Yii::app()->user->id));
		$models = new Customer();
		$criteria = new CDbCriteria();
		$criteria->join = " LEFT JOIN customer_sale cs ON t.customerId = cs.customerId ";
		$criteria->condition = "cs.saleId = :saleId";
		$criteria->params = array(
			":saleId"=>Yii::app()->user->id);

		$models = $this->findAll($criteria);
		foreach($models as $model)
		{
			$c[$model->customerId] = $model->customerFnTh . ' ' . $model->customerLnTh;
		}

		return $c;
	}

}
