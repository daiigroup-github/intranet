<?php

/**
 * This is the model class for table "notice".
 *
 * The followings are the available columns in table 'notice':
 * @property string $noticeId
 * @property string $title
 * @property string $headline
 * @property string $description
 * @property string $imageUrl
 * @property string $employeeId
 * @property integer $status
 * @property string $noticeTypeId
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Notice extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Notice the static model class
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
		return 'notice';
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
				'title, description, employeeId, status, noticeTypeId',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly'=>true),
			array(
				'title, headline',
				'length',
				'max'=>500),
			array(
				'description',
				'length',
				'max'=>2000),
			array(
				'imageUrl',
				'length',
				'max'=>1000),
			array(
				'employeeId, noticeTypeId',
				'length',
				'max'=>20),
			array(
				'createDateTime, updateDateTime',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'noticeId, title, headline, description, imageUrl, employeeId, status, noticeTypeId, createDateTime, updateDateTime',
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
				'employeeId'),
			'noticeType'=>array(
				self::BELONGS_TO,
				'NoticeType',
				'noticeTypeId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'noticeId'=>'Notice',
			'title'=>'ชื่อ',
			'headline'=>'หัวข้อย่อย',
			'description'=>'รายละเอียด',
			'imageUrl'=>'รูปภาพ',
			'employeeId'=>'ผู้ประกาศ',
			'status'=>'สถานะ',
			'noticeTypeId'=>'ประเภทประกาศ',
			'createDateTime'=>'วันที่สร้าง',
			'updateDateTime'=>'วันที่ปรับปรุง',
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

		$criteria->compare('noticeId', $this->noticeId, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('headline', $this->headline, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('imageUrl', $this->imageUrl, true);
		$criteria->compare('employeeId', $this->employeeId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('noticeTypeId', $this->noticeTypeId, true);
		$criteria->compare('createDateTime', $this->createDateTime, true);
		$criteria->compare('updateDateTime', $this->updateDateTime, true);
		$criteria->order = "t.updateDateTime DESC, t.createDateTime DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findNoticeByNoticeTypeCode($noticeTypeCode)
	{
		$criteria = new CDbCriteria();
		$criteria->join = "LEFT JOIN notice_type nt ON nt.noticeTypeId = t.noticeTypeId ";
		$criteria->addCondition("nt.noticeTypeCode =:noticeTypeCode AND t.status = 1");
		$criteria->params = array(
			":noticeTypeCode"=>$noticeTypeCode);
		$criteria->order = "t.updateDateTime DESC, t.createDateTime DESC";
		return Notice::model()->findAll($criteria);
	}

}
