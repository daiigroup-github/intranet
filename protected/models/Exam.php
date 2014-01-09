<?php

/**
 * This is the model class for table "exam_title".
 *
 * The followings are the available columns in table 'exam_title':
 * @property string $examId
 * @property integer $status
 * @property string $createDateTime
 * @property string $title
 * @property string $description
 * @property string $creator
 */
class Exam extends CActiveRecord
{

	public $searchText;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ExamTitle the static model class
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
		return 'exam';
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
				'examId, creator',
				'length',
				'max'=>10),
			array(
				'title',
				'length',
				'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'examId, status, createDateTime, title, description, creator, searchText',
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
			'examQuesitons'=>array(
				self::MANY_MANY,
				'ExamQuestion',
				'exam_exam_question(examId, examQuestionid)',
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'examId'=>'Exam',
			'status'=>'Status',
			'createDateTime'=>'Create Date Time',
			'title'=>'Exam Title',
			'description'=>'Exam Description',
			'creator'=>'Creator',
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
		$criteria->compare('title', $this->searchText, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,));
	}

}
