<?php

/**
 * This is the model class for table "stock".
 *
 * The followings are the available columns in table 'stock':
 * @property string $stockId
 * @property string $stockDetailId
 * @property string $companyId
 * @property string $stockQuantity
 * @property string $stockUnitPrice
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $status
 */
class Stock extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Stock the static model class
	 */
	public $stockDetailName;
	public $sumQuantity;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stock';
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
				'stockDetailId, companyId, stockQuantity, stockUnitPrice, createDateTime, status',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly' => true),
			array(
				'stockDetailId, companyId',
				'length',
				'max' => 20),
			array(
				'stockQuantity',
				'length',
				'max' => 11),
			array(
				'stockUnitPrice',
				'length',
				'max' => 15),
			array(
				'updateDateTime',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'stockId, stockDetailId, companyId, stockQuantity, stockUnitPrice, createDateTime, updateDateTime, status',
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
			'company' => array(
				self::BELONGS_TO,
				'Company',
				'companyId'),
			'stockDetail' => array(
				self::BELONGS_TO,
				'StockDetail',
				'stockDetailId'),
			'stockTransactions' => array(
				self::HAS_MANY,
				'StockTransaction',
				'stockId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'stockId' => 'คลังสินค้า',
			'stockDetailId' => 'รายการอุปกรณ์สำนักงาน',
			'companyId' => 'บริษัท',
			'stockQuantity' => 'จำนวน',
			'stockUnitPrice' => 'ราคาต่อหน่วย',
			'createDateTime' => 'วันที่สร้าง',
			'updateDateTime' => 'วันที่ปรับปรุง',
			'status' => 'สถานะ',
			'stockDetailName' => 'ชื่อรายการของ',
			'sumQuantity' => 'จำนวน'
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

		$criteria->compare('stockId', $this->stockId, true);
		$criteria->compare('stockDetailId', $this->stockDetailId, true);
		$criteria->compare('companyId', $this->companyId, true);
		$criteria->compare('stockQuantity', $this->stockQuantity, true);
		$criteria->compare('stockUnitPrice', $this->stockUnitPrice, true);
		$criteria->compare('createDateTime', $this->createDateTime, true);
		$criteria->compare('updateDateTime', $this->updateDateTime, true);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array(
				'defaultOrder' => 'createDateTime DESC',
			),
		));
	}

	public function getAllStock()
	{
		$criteria = new CDbCriteria;
		$criteria->distinct = true;

		$models = Stock::model()->findAll();

		$w = array(
			'' => 'Choose..');

		foreach ($models as $model)
		{
			$w[$model->stockId] = $model->stockDetail->stockDetailName . "(" . $model->stockDetail->stockDetailUnit . ")";
		}

		return $w;
	}

	public function sumStock($compamyId)
	{
		$criteria = new CDbCriteria();
		$criteria->select = "sd.stockDetailName as stockDetailName , sum(t.stockQuantity) as sumQuantity";
		$criteria->join = "JOIN stock_detail sd ON sd.stockDetailId = t.stockDetailId ";
		//$criteria->condition = "t.companyId = :companyId GROUP BY t.stockDetailId";
		$criteria->compare("t.companyId", $compamyId);
		$criteria->group = "t.stockDetailId";
		//$criteria->params = array(":companyId"=>$compamyId);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}
