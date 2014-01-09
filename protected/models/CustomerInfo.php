<?php

/**
 * This is the model class for table "customer_info".
 *
 * The followings are the available columns in table 'customer_info':
 * @property string $costomerInfoId
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $status
 * @property string $customerId
 * @property string $companyId
 * @property string $branchId
 * @property string $saleId
 * @property string $engineerId
 * @property string $remarks
 */
class CustomerInfo extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerInfo the static model class
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
		return 'customer_info';
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
				'createDateTime, updateDateTime, customerId, companyId, branchId, saleId, engineerId',
				'required'),
			array(
				'status, customerId, companyId, branchId, saleId, engineerId',
				'length',
				'max'=>10),
			array(
				'remarks',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'costomerInfoId, createDateTime, updateDateTime, status, customerId, companyId, branchId, saleId, engineerId, remarks',
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
			'costomerInfoId'=>'Costomer Info',
			'createDateTime'=>'Create Date Time',
			'updateDateTime'=>'Update Date Time',
			'status'=>'Status',
			'customerId'=>'Customer',
			'companyId'=>'Company',
			'branchId'=>'Branch',
			'saleId'=>'Sale',
			'engineerId'=>'Engineer',
			'remarks'=>'Remarks',
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

		$criteria->compare('costomerInfoId', $this->costomerInfoId, true);
		$criteria->compare('createDateTime', $this->createDateTime, true);
		$criteria->compare('updateDateTime', $this->updateDateTime, true);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('customerId', $this->customerId, true);
		$criteria->compare('companyId', $this->companyId, true);
		$criteria->compare('branchId', $this->branchId, true);
		$criteria->compare('saleId', $this->saleId, true);
		$criteria->compare('engineerId', $this->engineerId, true);
		$criteria->compare('remarks', $this->remarks, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
