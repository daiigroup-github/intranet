<?php

/**
 * This is the model class for table "memo".
 *
 * The followings are the available columns in table 'memo':
 * @property string $memoId
 * @property string $subject
 * @property string $detail
 * @property string $image
 * @property string $createBy
 * @property string $createDateTime
 */
class Memo extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Memo the static model class
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
		return 'memo';
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
				'subject, detail, createBy, createDateTime',
				'required'),
			array(
				'subject',
				'length',
				'max'=>1000),
			array(
				'image',
				'length',
				'max'=>2000),
			array(
				'detail',
				'length',
				'max'=>3000),
			array(
				'createBy',
				'length',
				'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'memoId, subject, detail, image, createBy, createDateTime',
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
			'employee'=>array(
				self::BELONGS_TO,
				'Employee',
				array(
					'createBy'=>'employeeId')),
			'memoTo'=>array(
				self::HAS_MANY,
				'MemoTo',
				array(
					'memoId'=>'memoId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'memoId'=>'Memo',
			'subject'=>'หัวข้อ',
			'detail'=>'รายละเอียด',
			'image'=>'รูปภาพ',
			'createBy'=>'ผู้สร้าง',
			'createDateTime'=>'วันที่สร้าง',
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

		$criteria->compare('memoId', $this->memoId, true);
		$criteria->compare('subject', $this->subject, true);
		$criteria->compare('detail', $this->detail, true);
		$criteria->compare('createBy', $this->createBy, true);
		$criteria->compare('createDateTime', $this->createDateTime, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchInbox($employeeId = null)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;
		$criteria->join = " LEFT JOIN memo_to mt ON t.memoId = mt.memoId ";
		$criteria->compare('mt.employeeId', $employeeId);
		//$criteria->compare('memoId',$this->memoId,true);
		$criteria->compare('subject', $this->subject, true);
		$criteria->compare('detail', $this->detail, true);
		//$criteria->compare('createBy',$this->createBy,true);
		//$criteria->compare('createDateTime',$this->createDateTime,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'mt.status ASC , t.createDateTime ASC',
			),
			'pagination'=>array(
				'pageSize'=>10
			),
		));
	}

	public function searchOutbox($employeeId = null)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;
		$criteria->compare('t.createBy', $employeeId);
		//$criteria->compare('memoId',$this->memoId,true);
		$criteria->compare('subject', $this->subject, true);
		$criteria->compare('detail', $this->detail, true);
		//$criteria->compare('createBy',$this->createBy,true);
		//$criteria->compare('createDateTime',$this->createDateTime,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>10
			),
		));
	}

}
