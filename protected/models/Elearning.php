<?php

/**
 * This is the model class for table "elearning".
 *
 * The followings are the available columns in table 'elearning':
 * @property string $elearningd
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $title
 * @property string $description
 * @property string $pdfFile
 * @property string $parentId
 * @property string $numberOfQuestion
 */
class Elearning extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Elearning the static model class
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
		return 'elearning';
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
				'title',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly'=>true),
			array(
				'title',
				'length',
				'max'=>255),
			array(
				'parentId',
				'length',
				'max'=>10),
			array(
				'description',
				'safe'),
			array(
				'createDateTime',
				'default',
				'value'=>new CDbExpression('NOW()'),
				'on'=>'insert'),
			array(
				'updateDateTime',
				'default',
				'value'=>new CDbExpression('NOW()')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'elearningId, status, createDateTime, updateDateTime, title, description, pdfFile, parentId, numberOfQuestion',
				'safe',
				'on'=>'search'),
			array(
				'pdfFile',
				'file',
				'types'=>'pdf',
				'allowEmpty'=>true),
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
			'elearningId'=>'Elearning',
			'status'=>'Status',
			'createDateTime'=>'Create Date Time',
			'updateDateTime'=>'Update Date Time',
			'title'=>'หัวข้อ',
			'description'=>'รายละเอียด',
			'parentId'=>'Parent',
			'pdfFilel'=>'PDF File',
			'numberOfQuestion'=>'จำนวนข้อสอบ'
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

		$criteria->compare('elearningId', $this->elearningId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true);
		$criteria->compare('updateDateTime', $this->updateDateTime, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('parentId', $this->parentId, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
