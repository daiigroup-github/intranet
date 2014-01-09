<?php

/**
 * This is the model class for table "memo_log".
 *
 * The followings are the available columns in table 'memo_log':
 * @property string $memoLogId
 * @property string $memoId
 * @property string $employeeId
 * @property string $remark
 * @property integer $status
 * @property string $createDateTime
 */
class MemoLog extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MemoLog the static model class
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
		return 'memo_log';
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
				'memoId, employeeId, remark, status, createDateTime',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly'=>true),
			array(
				'memoId, employeeId',
				'length',
				'max'=>20),
			array(
				'remark',
				'length',
				'max'=>2000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'memoLogId, memoId, employeeId, remark, status, createDateTime',
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
			'memoLogId'=>'Memo Log',
			'memoId'=>'Memo',
			'employeeId'=>'Employee',
			'remark'=>'Remark',
			'status'=>'Status',
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

		$criteria->compare('memoLogId', $this->memoLogId, true);
		$criteria->compare('memoId', $this->memoId, true);
		$criteria->compare('employeeId', $this->employeeId, true);
		$criteria->compare('remark', $this->remark, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
