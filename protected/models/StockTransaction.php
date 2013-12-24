<?php

/**
 * This is the model class for table "stock_transaction".
 *
 * The followings are the available columns in table 'stock_transaction':
 * @property string $stockTransactionId
 * @property string $stockId
 * @property string $documentId
 * @property integer $stockTransactionQuantity
 * @property string $stockTransactionUnitPrice
 * @property string $stockTransactionTotalPrice
 * @property string $createDateTime
 *
 * The followings are the available model relations:
 * @property Stock $stock
 */
class StockTransaction extends CActiveRecord
{

	public $sumTransactionQuantity;
	public $month;
	public $company;
	public $companyId;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StockTransaction the static model class
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
		return 'stock_transaction';
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
				'stockId, documentId, stockTransactionQuantity, stockTransactionUnitPrice, stockTransactionTotalPrice, createDateTime',
				'required'),
			array(
				'stockTransactionQuantity',
				'numerical',
				'integerOnly' => true),
			array(
				'stockId, documentId',
				'length',
				'max' => 20),
			array(
				'stockTransactionUnitPrice, stockTransactionTotalPrice',
				'length',
				'max' => 15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'stockTransactionId, stockId, documentId, stockTransactionQuantity, stockTransactionUnitPrice, stockTransactionTotalPrice, createDateTime, month, company ,companyId',
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
			'stock' => array(
				self::BELONGS_TO,
				'Stock',
				'stockId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'stockTransactionId' => 'Stock Transaction',
			'stockId' => 'Stock',
			'documentId' => 'Document',
			'stockTransactionQuantity' => 'จำนวน',
			'stockTransactionUnitPrice' => 'ราคาต่อหน่วย',
			'stockTransactionTotalPrice' => 'รวมเป็นเงิน',
			'createDateTime' => 'วันที่สร้าง',
			'company' => 'บริษัท'
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

		$criteria->compare('stockTransactionId', $this->stockTransactionId, true);
		$criteria->compare('stockId', $this->stockId, true);
		$criteria->compare('documentId', $this->documentId, true);
		$criteria->compare('stockTransactionQuantity', $this->stockTransactionQuantity);
		$criteria->compare('stockTransactionUnitPrice', $this->stockTransactionUnitPrice, true);
		$criteria->compare('stockTransactionTotalPrice', $this->stockTransactionTotalPrice, true);
		$criteria->compare('createDateTime', $this->createDateTime, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function sumInitialStock($stockId)
	{
		$criteria = new CDbCriteria();
		$criteria->select = "sum(t.stockTransactionQuantity) as sumTransactionQuantity ";
		$criteria->join = "JOIN stock s on s.stockId = t.stockId ";
		//$criteria->join .= "JOIN stock_detail sd on sd.stockDetailId = s.stockDetailId ";
		$criteria->condition = "t.stockTransactionQuantity > 0";
		$criteria->compare("s.stockId", $stockId);
		$criteria->group = "t.stockId";

		$result = $this->find($criteria);
		if (isset($result))
		{
			return $result->sumTransactionQuantity;
		}
		else
		{
			return 0;
		}
	}

	public function stockReport($companyId)
	{
		$criteria = new CDbCriteria();
		$criteria->select = "s.stockId , t.stockTransactionQuantity , t.stockTransactionUnitPrice, ";
		$criteria->select .= " t.stockTransactionTotalPrice , t.createDateTime , s.companyId ";
		$criteria->join = " LEFT JOIN stock s ON s.stockId = t.stockId ";
		$criteria->condition = "MONTH(t.createDateTime) > :month AND s.companyId = :companyId";
		$criteria->params = array(
			":month" => $this->month,
			":companyId" => $companyId);
		$criteria->group = "t.stockId";

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function generateMonth()
	{
		$result = array(
			);
		$result[1] = "มกราคม";
		$result[2] = "กุมภาพันธ์";
		$result[3] = "มีนาคม";
		$result[4] = "เมษายน";
		$result[5] = "พฤษภาคม";
		$result[6] = "มิถุนายน";
		$result[7] = "กรกฎาคม";
		$result[8] = "สิงหาคม";
		$result[9] = "กันยายน";
		$result[10] = "ตุลาคม";
		$result[11] = "พฤศจิกายน";
		$result[12] = "ธันวาคม";
		return $result;
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