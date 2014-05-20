<?php

class TheaterMovie extends TheaterMovieMaster
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
				array(
					'searchText',
					'safe',
					'on'=>'search'),
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
				'category'=>array(
					self::BELONGS_TO,
					'TheaterCategory',
					'theaterCategoryId'),
				'showtime'=>array(
					self::HAS_MANY,
					'TheaterShowtime',
					"theaterShowtimeId",
					'on'=>'status = 1',
					'order'=>'showDate DESC'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return Cmap::mergeArray(parent::attributeLabels(), array(
				//code here
				'theaterMovieId'=>'Theater Movie',
				'theaterCategoryId'=>'หมวดหมู่',
				'title'=>'ชื่อ',
				'description'=>'รายละเอียด',
				'length'=>'ความยาวหนัง',
				'url'=>'Url ของหนัง',
				'image'=>'รูป',
				'screenshotImage'=>'รูป Screenshot ',
				'status'=>'สถานะ',
				'createDateTime'=>'วันที่สร้าง',
				'updateDateTime'=>'วันที่แก้ไข',
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	  public function search()
	  {
	  }
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->compare('theaterCategoryId', $this->theaterCategoryId);
		$criteria->compare('LOWER(title)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('LOWER(description)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('LOWER(length)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('LOWER(url)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('LOWER(image)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('LOWER(screenshotImage)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('status', $this->status);
		$criteria->compare('LOWER(createDateTime)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('LOWER(updateDateTime)', strtolower($this->searchText), true, 'OR');
		$criteria->order = "createDateTime DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findAllMovieHaveShowtime()
	{
		$criteria = new CDbCriteria;
		$criteria->join = "RIGHT JOIN theater_showtime ts on ts.theaterMovieId = t.theaterMovieId ";
		$criteria->compare("t.status", 1);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
