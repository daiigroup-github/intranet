<?php

/**
 * This is the model class for table "customer_sale".
 *
 * The followings are the available columns in table 'customer_sale':
 * @property string $id
 * @property string $customerId
 * @property string $saleId
 * @property string $companyValue
 * @property string $createDateTime
 */
class CustomerSale extends CActiveRecord
{

	public $sales;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerSale the static model class
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
		return 'customer_sale';
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
				'customerId, saleId, companyValue, createDateTime',
				'required'),
			array(
				'customerId, saleId',
				'length',
				'max'=>20),
			array(
				'companyValue',
				'length',
				'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'id, customerId, saleId, companyValue, createDateTime',
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
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'=>'ID',
			'customerId'=>'Customer',
			'saleId'=>'Sale',
			'companyValue'=>'Company Value',
			'createDateTime'=>'Create Date Time',
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

		$criteria->compare('id', $this->id, true);
		$criteria->compare('customerId', $this->customerId, true);
		$criteria->compare('saleId', $this->saleId, true);
		$criteria->compare('companyValue', $this->companyValue, true);
		$criteria->compare('createDateTime', $this->createDateTime, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
