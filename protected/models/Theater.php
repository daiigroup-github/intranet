<?php

class Theater extends TheaterMaster
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return CMap::mergeArray(parent::rules(), array(
				//code here
		));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return CMap::mergeArray(parent::relations(), array(
				//code here
				'branch'=>array(
					self::BELONGS_TO,
					'Branch',
					'branchId'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return Cmap::mergeArray(parent::attributeLabels(), array(
				//code here
				'theaterId'=>'โรงหนัง',
				'branchId'=>'สาขา',
				'title'=>'ชื่อโรงหนัง',
				'description'=>'รายละเอียด',
				'seats'=>'จำนวนที่นั่ง',
				'staffId'=>'พนักงาน',
				'startTime'=>'Start Time',
				'endTime'=>'End Time',
				'status'=>'Status',
				'createDateTime'=>'Create Date Time',
				'updateDateTime'=>'Update Date Time',
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	  public function search()
	  {
	  }
	 */
	public function findAllTheaterArray()
	{
		$result = array();
		foreach($this->findAll("status=1") as $item)
		{
			$result[$item->theaterId] = $item->title;
		}

		return $result;
	}

}
