<?php

/**
 * This is the model class for table "application_interview_score".
 *
 * The followings are the available columns in table 'application_interview_score':
 * @property string $id
 * @property string $applicationInterviewId
 * @property string $examId
 * @property string $questionId
 * @property integer $questionWeight
 * @property string $choiceId
 * @property string $choiceValue
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ApplicationInterviewScore extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicationInterviewScore the static model class
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
		return 'application_interview_score';
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
				'applicationInterviewId, managerId, examId, questionId, status, createDateTime',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly'=>true),
			array(
				'applicationInterviewId, managerId, examId, questionId, choiceId',
				'length',
				'max'=>20),
			array(
				'choiceValue',
				'length',
				'max'=>16),
			array(
				'questionWeight',
				'length',
				'max'=>7),
			array(
				'updateDateTime',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'id, applicationInterviewId, managerId, examId, questionId, questionWeight, choiceId, choiceValue, status, createDateTime, updateDateTime',
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
			'examQuestion'=>array(
				self::BELONGS_TO,
				'ExamQuestion',
				array(
					'questionId'=>'examQuestionId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'=>'ID',
			'applicationInterviewId'=>'Application Interview',
			'managerId'=>'Manager ID',
			'examId'=>'Exam',
			'questionId'=>'Question',
			'questionWeight'=>'Question Weight',
			'choiceId'=>'Choice',
			'choiceValue'=>'Choice Value',
			'status'=>'Status',
			'createDateTime'=>'Create Date Time',
			'updateDateTime'=>'Update Date Time',
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
		$criteria->compare('applicationInterviewId', $this->applicationInterviewId, true);
		$criteria->compare('examId', $this->examId, true);
		$criteria->compare('questionId', $this->questionId, true);
		$criteria->compare('questionWeight', $this->questionWeight);
		$criteria->compare('choiceId', $this->choiceId, true);
		$criteria->compare('choiceValue', $this->choiceValue, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true);
		$criteria->compare('updateDateTime', $this->updateDateTime, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
