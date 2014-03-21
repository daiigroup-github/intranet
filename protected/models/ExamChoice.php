<?php

/**
 * This is the model class for table "exam_choice".
 *
 * The followings are the available columns in table 'exam_choice':
 * @property string $examChoiceId
 * @property integer $status
 * @property string $title
 * @property string $value
 */
class ExamChoice extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ExamChoice the static model class
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
		return 'exam_choice';
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
				'title, value',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly' => true),
			array(
				'title, value',
				'length',
				'max' => 200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'examChoiceId, status, title, value',
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
			'examChoiceId' => 'Exam Choice',
			'status' => 'Status',
			'title' => 'Title',
			'value' => 'Value',
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

		$criteria->compare('examChoiceId', $this->examChoiceId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('value', $this->value, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}