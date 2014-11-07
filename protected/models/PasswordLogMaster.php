<?php

/**
 * This is the model class for table "password_log".
 *
 * The followings are the available columns in table 'password_log':
 * @property string $id
 * @property string $employeeId
 * @property string $createDateTime
 * @property string $password
 */
class PasswordLogMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'password_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, employeeId, password', 'required'),
			array('id, employeeId', 'length', 'max'=>10),
			array('password', 'length', 'max'=>45),
			array('createDateTime', 'safe'),
			array('createDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, employeeId, createDateTime, password, searchText', 'safe', 'on'=>'search'),
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
			'employeeId' => 'Employee',
			'createDateTime' => 'Create Date Time',
			'password' => 'Password',
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

		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->id = $this->searchText;
			$this->employeeId = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->password = $this->searchText;
		}

		$criteria->compare('id',$this->id,true, 'OR');
		$criteria->compare('employeeId',$this->employeeId,true, 'OR');
		$criteria->compare('createDateTime',$this->createDateTime,true, 'OR');
		$criteria->compare('password',$this->password,true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PasswordLogMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
