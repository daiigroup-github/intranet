<?php

/**
 * This is the model class for table "elearning_exam_choice".
 *
 * The followings are the available columns in table 'elearning_exam_choice':
 * @property integer $choiceId
 * @property integer $isCorrect
 * @property string $title
 * @property string $description
 * @property string $questionId
 */
class ElearningExamChoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ElearningExamChoice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'elearning_exam_choice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('questionId', 'required'),
			array('choiceId, isCorrect', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('questionId', 'length', 'max'=>10),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('choiceId, isCorrect, title, description, questionId', 'safe', 'on'=>'search'),
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
			'choiceId' => 'choiceId',
			'isCorrect' => 'Is Correct',
			'title' => 'Title',
			'description' => 'Description',
			'questionId' => 'Question',
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

		$criteria=new CDbCriteria;

		$criteria->compare('choiceId',$this->choiceId);
		$criteria->compare('isCorrect',$this->isCorrect);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('questionId',$this->questionId,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}