<?php

/**
 * This is the model class for table "group".
 *
 * The followings are the available columns in table 'group':
 * @property integer $groupId
 * @property integer $status
 * @property string $groupName
 */
class Group extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Group the static model class
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
		return 'group';
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
				'groupName',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly' => true),
			array(
				'groupName',
				'length',
				'max' => 40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'groupId, status, groupName',
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
			'groupMember' => array(
				self::HAS_MANY,
				'GroupMember',
				'groupId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'groupId' => 'Group',
			'status' => 'Status',
			'groupName' => 'Group Name',
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

		$criteria->compare('groupId', $this->groupId);
		$criteria->compare('status', $this->status);
		$criteria->compare('groupName', $this->groupName, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	//custom

	public function getAllGroup()
	{
		$models = $this->findAll('status=:status', array(
			':status' => 1));

		$g = array(
			'' => 'Choose..');

		foreach ($models as $model)
		{
			$g[$model->groupId] = $model->groupName;
		}

		return $g;
	}

}