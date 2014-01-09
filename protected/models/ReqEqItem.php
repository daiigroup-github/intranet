<?php

/**
 * This is the model class for table "req_eq_item".
 *
 * The followings are the available columns in table 'req_eq_item':
 * @property string $reqItemId
 * @property integer $status
 * @property string $reqId
 * @property integer $type
 * @property integer $reqStockId
 * @property integer $amt
 * @property integer $amtApproved
 * @property string $detail
 * @property string $remarks
 */
class ReqEqItem extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReqEqItem the static model class
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
		return 'req_eq_item';
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
				'status, type, reqStockId, amt, amtApproved',
				'numerical',
				'integerOnly'=>true),
			array(
				'reqId',
				'length',
				'max'=>10),
			array(
				'detail, remarks',
				'length',
				'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'reqItemId, status, reqId, type, reqStockId, amt, amtApproved, detail, remarks',
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
			'reqItemId'=>'Req Item',
			'status'=>'Status',
			'reqId'=>'Req',
			'type'=>'Type',
			'reqStockId'=>'Req Stock',
			'amt'=>'Amt',
			'amtApproved'=>'Amt Approved',
			'detail'=>'Detail',
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

		$criteria->compare('reqItemId', $this->reqItemId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('reqId', $this->reqId, true);
		$criteria->compare('type', $this->type);
		$criteria->compare('reqStockId', $this->reqStockId);
		$criteria->compare('amt', $this->amt);
		$criteria->compare('amtApproved', $this->amtApproved);
		$criteria->compare('detail', $this->detail, true);
		$criteria->compare('remarks', $this->remarks, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
