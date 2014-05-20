<?php

class TheaterShowtime extends TheaterShowtimeMaster
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
				'movie'=>array(
					self::BELONGS_TO,
					'TheaterMovie',
					'theaterMovieId'),
				'theater'=>array(
					self::BELONGS_TO,
					'Theater',
					'theaterId'),
				'reserve'=>array(
					self::HAS_MANY,
					'TheaterShowtimeEmployee',
					array(
						"theaterShowTimeId"=>"theaterShowtimeId"),
					'on'=>'status = 1'),
				'cancel'=>array(
					self::HAS_MANY,
					'TheaterShowtimeEmployee',
					array(
						"theaterShowTimeId"=>"theaterShowtimeId"),
					'on'=>'status = 0'),
				'queue'=>array(
					self::HAS_MANY,
					'TheaterShowtimeEmployee',
					array(
						"theaterShowTimeId"=>"theaterShowtimeId"),
					'on'=>'status = 2'),
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
				'seats'=>'จำนวนที่นั่ง',
				'showDate'=>'วันที่ฉาย',
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
		$criteria->compare('LOWER(theaterId)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('theaterMovieId', $this->theaterMovieId);
		$criteria->compare('LOWER(showDate)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('status', $this->status);
		$criteria->compare('LOWER(createDateTime)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('LOWER(updateDateTime)', strtolower($this->searchText), true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findAllShowtimeByMovieTheater($theaterMovieId, $branchId = NULL)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->join = "LEFT JOIN theater th ON th.theaterId = t.theaterId";
		$criteria->compare('t.theaterMovieId', $theaterMovieId);
		if(isset($branchId))
		{
			$criteria->compare('th.branchId', $branchId);
		}
		$criteria->compare('t.status', 1);
		$criteria->addCondition("t.showDate >=NOW()");
		$criteria->order = "t.showDate ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findAllShowtimeGroupoByBranchId($branchId = NULL)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->join = " LEFT JOIN theater th ON th.theaterId = t.theaterId";
		$criteria->join .= " INNER JOIN theater_movie tm ON tm.theaterMovieId = t.theaterMovieId";
		if(isset($branchId))
		{
			$criteria->compare('th.branchId', $branchId);
		}
		$criteria->compare('t.status', 1);
		$criteria->addCondition("t.showDate >=NOW()");
		$criteria->order = "t.showDate ASC";
		$criteria->group = "t.theaterMovieId";

		return $this->findAll($criteria);
	}

}
