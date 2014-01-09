<?php

/**
 * This is the model class for table "exam_question".
 *
 * The followings are the available columns in table 'exam_question':
 * @property string $examQuestionId
 * @property integer $status
 * @property string $title
 * @property string $description
 * @property integer $questionType
 * @property integer $startRange
 * @property integer $stopRange
 * @property string $weight
 */
class ExamQuestion extends CActiveRecord
{

	const EXAM_QUESTION_TYPE_MULTI = 1;
	const EXAM_QUESTION_TYPE_RANGE = 2;
	const EXAM_QUESTION_TYPE_TEXT = 3;
	const EXAM_QUESTION_TYPE_TEXT_AREA = 4;

	public $selectedRange;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ExamQuestion the static model class
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
		return 'exam_question';
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
				'title, questionType',
				'required'),
			array(
				'status, questionType, startRange, stopRange',
				'numerical',
				'integerOnly'=>true
			),
			array(
				'title',
				'length',
				'max'=>200),
			array(
				'weight',
				'length',
				'max'=>7),
			array(
				'description',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'examQuestionId, status, title, description, questionType, startRange, stopRange, weight',
				'safe',
				'on'=>'search'
			),
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
			'examChoices'=>array(
				self::MANY_MANY,
				'ExamChoice',
				'exam_question_exam_choice(examQuestionId, examChoiceId)'
			)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'examQuestionId'=>'Id Exam Question',
			'status'=>'Status',
			'title'=>'Title',
			'description'=>'Description',
			'questionType'=>'Question Type',
			'startRange'=>'Start Range',
			'stopRange'=>'Stop Range',
			'weight'=>'Weight',
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

		$criteria->compare('examQuestionId', $this->examQuestionId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('questionType', $this->questionType);
		$criteria->compare('startRange', $this->startRange);
		$criteria->compare('stopRange', $this->stopRange);
		$criteria->compare('weight', $this->weight, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,));
	}

	public function getAllExamQuestionType()
	{
		return array(
			self::EXAM_QUESTION_TYPE_MULTI=>'Multiple choice',
			self::EXAM_QUESTION_TYPE_RANGE=>'Range'
		);
	}

	public function examQuesitonText($type)
	{
		$questionType = $this->allExamQuestionType;
		return $questionType[$type];
	}

}
