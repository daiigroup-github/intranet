<?php

/**
 * This is the model class for table "req_eq".
 *
 * The followings are the available columns in table 'req_eq':
 * @property string $reqId
 * @property string $createTime
 * @property integer $status
 * @property integer $type
 * @property string $employeeId
 * @property string $comment
 * @property integer $mgrStatus
 * @property string $mgrDate
 * @property string $mgrComment
 * @property integer $purchaseStatus
 * @property string $purchaseDate
 * @property string $purchaseComment
 * @property integer $itStatus
 * @property string $itSate
 * @property string $itComment
 */
class ReqEq extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReqEq the static model class
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
		return 'req_eq';
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
				'status, type, mgrStatus, purchaseStatus, itStatus',
				'numerical',
				'integerOnly' => true),
			array(
				'reqId, employeeId',
				'length',
				'max' => 10),
			array(
				'comment',
				'length',
				'max' => 200),
			array(
				'createTime, mgrDate, mgrComment, purchaseDate, purchaseComment, itSate, itComment',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'reqId, createTime, status, type, employeeId, comment, mgrStatus, mgrDate, mgrComment, purchaseStatus, purchaseDate, purchaseComment, itStatus, itSate, itComment',
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
			'reqId' => 'Req',
			'createTime' => 'Create Time',
			'status' => 'Status',
			'type' => 'Type',
			'employeeId' => 'Employee',
			'comment' => 'Comment',
			'mgrStatus' => 'Mgr Status',
			'mgrDate' => 'Mgr Date',
			'mgrComment' => 'Mgr Comment',
			'purchaseStatus' => 'Purchase Status',
			'purchaseDate' => 'Purchase Date',
			'purchaseComment' => 'Purchase Comment',
			'itStatus' => 'It Status',
			'itSate' => 'It Sate',
			'itComment' => 'It Comment',
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

		$criteria->compare('reqId', $this->reqId, true);
		$criteria->compare('createTime', $this->createTime, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('type', $this->type);
		$criteria->compare('employeeId', $this->employeeId, true);
		$criteria->compare('comment', $this->comment, true);
		$criteria->compare('mgrStatus', $this->mgrStatus);
		$criteria->compare('mgrDate', $this->mgrDate, true);
		$criteria->compare('mgrComment', $this->mgrComment, true);
		$criteria->compare('purchaseStatus', $this->purchaseStatus);
		$criteria->compare('purchaseDate', $this->purchaseDate, true);
		$criteria->compare('purchaseComment', $this->purchaseComment, true);
		$criteria->compare('itStatus', $this->itStatus);
		$criteria->compare('itSate', $this->itSate, true);
		$criteria->compare('itComment', $this->itComment, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}