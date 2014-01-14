<?php

/**
 * This is the model class for table "elearning_exam_item".
 *
 * The followings are the available columns in table 'elearning_exam_item':
 * @property string $id
 * @property string $questionId
 * @property string $choiceId
 * @property integer $isCorrect
 * @property string $elearningExamId
 */
class ElearningExamItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ElearningExamItem the static model class
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
		return 'elearning_exam_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('questionId, choiceId, isCorrect, elearningExamId', 'required'),
			array('isCorrect', 'numerical', 'integerOnly'=>true),
			array('questionId, choiceId', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, questionId, choiceId, isCorrect, elearningExamId', 'safe', 'on'=>'search'),
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
			'questionId' => 'Question',
			'choiceId' => 'Choice',
			'isCorrect' => 'Is Correct',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('questionId',$this->questionId,true);
		$criteria->compare('choiceId',$this->choiceId,true);
		$criteria->compare('isCorrect',$this->isCorrect);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}