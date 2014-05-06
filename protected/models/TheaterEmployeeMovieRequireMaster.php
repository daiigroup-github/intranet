<?php

/**
 * This is the model class for table "theater_employee_movie_require".
 *
 * The followings are the available columns in table 'theater_employee_movie_require':
 * @property string $theaterEmployeeMovieRequireId
 * @property string $employeeId
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class TheaterEmployeeMovieRequireMaster extends MasterCActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public $searchText;

	public function tableName()
	{
		return 'theater_employee_movie_require';
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
				'employeeId, description',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly'=>true),
			array(
				'employeeId',
				'length',
				'max'=>20),
			array(
				'description',
				'length',
				'max'=>45),
			array(
				'createDateTime, updateDateTime',
				'safe'),
			array(
				'createDateTime, updateDateTime',
				'default',
				'value'=>new CDbExpression('NOW()'),
				'on'=>'insert'),
			array(
				'updateDateTime',
				'default',
				'value'=>new CDbExpression('NOW()'),
				'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array(
				'theaterEmployeeMovieRequireId, employeeId, description, status, createDateTime, updateDateTime',
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
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'theaterEmployeeMovieRequireId'=>'Theater Employee Movie Require',
			'employeeId'=>'Employee',
			'description'=>'Description',
			'status'=>'Status',
			'createDateTime'=>'Create Date Time',
			'updateDateTime'=>'Update Date Time',
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

		$criteria = new CDbCriteria;
		$criteria->compare('LOWER(employeeId)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('LOWER(description)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('status', $this->status);
		$criteria->compare('LOWER(createDateTime)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('LOWER(updateDateTime)', strtolower($this->searchText), true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TheaterEmployeeMovieRequireMaster the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

}
