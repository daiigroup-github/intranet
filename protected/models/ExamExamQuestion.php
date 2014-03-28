<?php

/**
 * This is the model class for table "exam_title_exam_question".
 *
 * The followings are the available columns in table 'exam_title_exam_question':
 * @property string $id
 * @property integer $status
 * @property string $examId
 * @property string $examQuestionId
 */
class ExamExamQuestion extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ExamTitleExamQuestion the static model class
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
		return 'exam_exam_question';
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
				'status',
				'numerical',
				'integerOnly' => true),
			array(
				'examId, examQuestionId',
				'length',
				'max' => 10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'id, status, examId, examQuestionId',
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
			'id' => 'ID',
			'status' => 'Status',
			'examId' => 'Exam',
			'examQuestionId' => 'Exam Question',
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
		$criteria->compare('status', $this->status);
		$criteria->compare('examId', $this->examId, true);
		$criteria->compare('examQuestionId', $this->examQuestionId, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}