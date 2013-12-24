<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property string $productId
 * @property integer $status
 * @property string $productValue
 * @property string $productName
 * @property string $productDetail
 * @property string $companyValue
 */
class Product extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
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
		return 'product';
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
				'productValue, productName, productDetail',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly' => true),
			array(
				'productValue, companyValue',
				'length',
				'max' => 10),
			array(
				'productName',
				'length',
				'max' => 80),
			array(
				'productDetail',
				'length',
				'max' => 100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'productId, status, productValue, productName, productDetail, companyValue',
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
			'productId' => 'Product',
			'status' => 'Status',
			'productValue' => 'Product Value',
			'productName' => 'Product Name',
			'productDetail' => 'Product Detail',
			'companyValue' => 'Company Value',
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

		$criteria->compare('productId', $this->productId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('productValue', $this->productValue, true);
		$criteria->compare('productName', $this->productName, true);
		$criteria->compare('productDetail', $this->productDetail, true);
		$criteria->compare('companyValue', $this->companyValue, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}