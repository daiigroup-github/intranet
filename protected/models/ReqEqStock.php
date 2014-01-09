<?php

/**
 * This is the model class for table "req_eq_stock".
 *
 * The followings are the available columns in table 'req_eq_stock':
 * @property string $reqStockId
 * @property string $modTime
 * @property integer $status
 * @property string $description
 * @property string $unit
 * @property integer $type
 * @property integer $inStock
 */
class ReqEqStock extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReqEqStock the static model class
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
		return 'req_eq_stock';
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
				'status, type, inStock',
				'numerical',
				'integerOnly'=>true),
			array(
				'description',
				'length',
				'max'=>150),
			array(
				'unit',
				'length',
				'max'=>20),
			array(
				'modTime',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'reqStockId, modTime, status, description, unit, type, inStock',
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
			'reqStockId'=>'Req Stock',
			'modTime'=>'Mod Time',
			'status'=>'Status',
			'description'=>'Description',
			'unit'=>'Unit',
			'type'=>'Type',
			'inStock'=>'In Stock',
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

		$criteria->compare('reqStockId', $this->reqStockId, true);
		$criteria->compare('modTime', $this->modTime, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('unit', $this->unit, true);
		$criteria->compare('type', $this->type);
		$criteria->compare('inStock', $this->inStock);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
