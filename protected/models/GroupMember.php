<?php

/**
 * This is the model class for table "group_member".
 *
 * The followings are the available columns in table 'group_member':
 * @property string $groupMemberId
 * @property integer $status
 * @property string $groupId
 * @property string $employeeId
 */
class GroupMember extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GroupMember the static model class
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
		return 'group_member';
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
				'status, groupId, employeeId',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly' => true),
			array(
				'groupId, employeeId',
				'length',
				'max' => 10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'groupMemberId, status, groupId, employeeId',
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
			'group' => array(
				self::BELONGS_TO,
				'Group',
				'groupId'),
			'employee' => array(
				self::BELONGS_TO,
				'Employee',
				array(
					'employeeId' => 'employeeId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'groupMemberId' => 'Group Member',
			'status' => 'Status',
			'groupId' => 'Group',
			'employeeId' => 'Employee',
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

		$criteria->compare('groupMemberId', $this->groupMemberId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('groupId', $this->groupId, true);
		$criteria->compare('employeeId', $this->employeeId, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	//custom
	public function getAllGroupMemberByGroupId($groupId)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'groupId=:groupId';
		$criteria->params = array(
			':groupId' => $groupId);

		$models = $this->findAll($criteria);

		$e = array(
			);

		foreach ($models as $model)
		{
			$e[] = $model->employeeId;
		}

		return $e;
	}

}