<?php

/**
 * This is the model class for table "email_queue".
 *
 * The followings are the available columns in table 'email_queue':
 * @property string $id
 * @property string $fromName
 * @property string $fromEmail
 * @property string $toEmail
 * @property string $subject
 * @property string $message
 * @property integer $maxAttempts
 * @property integer $attempts
 * @property integer $success
 * @property string $datePublished
 * @property string $lastAttempt
 * @property string $dateSent
 */
class EmailQueue extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'email_queue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fromEmail, toEmail, subject, message', 'required'),
			array('maxAttempts, attempts, success', 'numerical', 'integerOnly'=>true),
			array('fromName', 'length', 'max'=>64),
			array('fromEmail, toEmail', 'length', 'max'=>128),
			array('subject', 'length', 'max'=>255),
			array('datePublished, lastAttempt, dateSent', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fromName, fromEmail, toEmail, subject, message, maxAttempts, attempts, success, datePublished, lastAttempt, dateSent', 'safe', 'on'=>'search'),
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
			'fromName' => 'From Name',
			'fromEmail' => 'From Email',
			'toEmail' => 'To Email',
			'subject' => 'Subject',
			'message' => 'Message',
			'maxAttempts' => 'Max Attempts',
			'attempts' => 'Attempts',
			'success' => 'Success',
			'datePublished' => 'Date Published',
			'lastAttempt' => 'Last Attempt',
			'dateSent' => 'Date Sent',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('LOWER(fromName)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(fromEmail)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(toEmail)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(subject)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(message)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('maxAttempts',$this->maxAttempts);
		$criteria->compare('attempts',$this->attempts);
		$criteria->compare('success',$this->success);
		$criteria->compare('LOWER(datePublished)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(lastAttempt)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(dateSent)',strtolower($this->searchText),true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmailQueue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
