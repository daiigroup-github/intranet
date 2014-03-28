<?php

/**
 * This is the model class for table "product_category".
 *
 * The followings are the available columns in table 'product_category':
 * @property string $productCatId
 * @property integer $status
 * @property string $productCatValue
 * @property string $productCatName
 * @property string $companyId
 */
class ProductCategory extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductCategory the static model class
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
		return 'product_category';
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
				'companyId',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly' => true),
			array(
				'productCatValue, companyId',
				'length',
				'max' => 10),
			array(
				'productCatName',
				'length',
				'max' => 120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'productCatId, status, productCatValue, productCatName, companyId',
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
			'productCatId' => 'Product Cat',
			'status' => 'Status',
			'productCatValue' => 'Product Cat Value',
			'productCatName' => 'Product Cat Name',
			'companyId' => 'Company',
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

		$criteria->compare('productCatId', $this->productCatId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('productCatValue', $this->productCatValue, true);
		$criteria->compare('productCatName', $this->productCatName, true);
		$criteria->compare('companyId', $this->companyId, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	//Custom
	public function getAllProductCat()
	{
		$p = new ProductCategory;

		$models = $p->findAll(array(
			'condition' => 'status=1',
			'order' => 'productCatName'
		));

		$productCat = array(
			'' => '---');

		foreach ($models as $model)
		{
			$productCat[$model->productCatId] = $model->productCatName;
		}

		return $productCat;
	}

}