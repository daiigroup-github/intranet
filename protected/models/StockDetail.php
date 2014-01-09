<?php

/**
 * This is the model class for table "stock_detail".
 *
 * The followings are the available columns in table 'stock_detail':
 * @property string $stockDetailId
 * @property string $stockDetailCode
 * @property string $stockDetailName
 * @property string $stockDetailUnit
 * @property string $createDateTime
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Stock[] $stocks
 */
class StockDetail extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StockDetail the static model class
	 */
	public $maxCode;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stock_detail';
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
				'stockDetailCode, stockDetailName, stockDetailUnit, createDateTime, status',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly'=>true),
			array(
				'stockDetailCode',
				'length',
				'max'=>20),
			array(
				'stockDetailName',
				'length',
				'max'=>500),
			array(
				'stockDetailUnit',
				'length',
				'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'stockDetailId, stockDetailCode, stockDetailName, stockDetailUnit, createDateTime, status',
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
			'stocks'=>array(
				self::HAS_MANY,
				'Stock',
				'stockDetailId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'stockDetailId'=>'รายการอุปกรณ์สำนักงาน',
			'stockDetailCode'=>'เลขที่อุปกรณ์',
			'stockDetailName'=>'ชื่อ',
			'stockDetailUnit'=>'หน่วย',
			'createDateTime'=>'วันที่สร้าง',
			'status'=>'สถานะ',
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

		$criteria->compare('stockDetailId', $this->stockDetailId, true);
		$criteria->compare('stockDetailCode', $this->stockDetailCode, true);
		$criteria->compare('stockDetailName', $this->stockDetailName, true);
		$criteria->compare('stockDetailUnit', $this->stockDetailUnit, true);
		$criteria->compare('createDateTime', $this->createDateTime, true);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>20
			),
		));
	}

	public function findMaxCode()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->select = 'max(stockDetailCode) as maxCode';

		$result = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		return $result->data[0]->maxCode;
	}

	/* public function getOfficeStock()
	  {
	  $criteria=new CDbCriteria;
	  $criteria->distinct = true;

	  $models = StockDetail::model()->findAll();

	  $w = array(''=>'Choose..');

	  foreach($models as $model)
	  {
	  $w[$model->stockDetailId] = $model->stockDetailName."(".$model->stockDetailUnit.")";
	  }

	  return $w;
	  } */

	public function getOfficeStock()
	{
		$criteria = new CDbCriteria;
		//$criteria->distinct = true;
		$employee = Employee::model()->find("employeeId = :employeeId", array(
			":employeeId"=>Yii::app()->user->id));
		$models = Stock::model()->findAll("companyId =:companyId GROUP BY stockDetailId", array(
			":companyId"=>$employee->companyId));
		//throw new Exception(count($models));
		$w = array(
			''=>'Choose..');

		foreach($models as $model)
		{
			$w[$model->stockDetailId] = $model->stockDetail->stockDetailName . "(" . $model->stockDetail->stockDetailUnit . ")";
		}
		return $w;
	}

	public function getAllStockDetail()
	{
		$c = new StockDetail();
		$models = $c->findAll(array(
			'condition'=>'status=1',
			'order'=>'stockDetailName',
		));

		$stockDetail = array(
			''=>'- อุปกรณ์สำนักงาน');

		foreach($models as $model)
		{
			$stockDetail[$model->stockDetailId] = $model->stockDetailName;
		}

		return $stockDetail;
	}

}
