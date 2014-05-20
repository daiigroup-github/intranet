<?php

class TheaterShowtimeEmployee extends TheaterShowtimeEmployeeMaster
{

	public $maxReserveCode;
	public $noDateDiff;
	public $isSeen;

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
				'showtime'=>array(
					self::BELONGS_TO,
					'TheaterShowtime',
					'theaterShowTimeId'),
				'employee'=>array(
					self::BELONGS_TO,
					'Employee',
					'employeeId'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return Cmap::mergeArray(parent::attributeLabels(), array(
				//code here
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
		$criteria->compare('LOWER(reserveCode)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('theaterShowTimeId', $this->theaterShowTimeId);
		$criteria->compare('LOWER(employeeId)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('status', $this->status);
		$criteria->compare('LOWER(createDateTime)', strtolower($this->searchText), true, 'OR');
		$criteria->compare('LOWER(updateDateTime)', strtolower($this->searchText), true, 'OR');
		$criteria->order = "reserveCode ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findAllMyReserved()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = "*, DATEDIFF(NOW(),ts.showDate) as noDateDiff , IF((DATEDIFF(NOW(),ts.showDate) >=0),1,0) as isSeen";
		$criteria->join = " LEFT JOIN theater_showtime ts ON ts.theaterShowtimeId = t.theaterShowTimeId ";
		$criteria->join .= " INNER JOIN theater_movie tm ON tm.theaterMovieId = ts.theaterMovieId ";
//		$criteria->compare('LOWER(reserveCode)', strtolower($this->searchText), true, 'OR');
//		$criteria->compare('theaterShowTimeId', $this->theaterShowTimeId);
		$criteria->compare('t.employeeId', $this->employeeId);
		$criteria->compare('t.status', 1);
//		$criteria->compare('LOWER(createDateTime)', strtolower($this->searchText), true, 'OR');
//		$criteria->compare('LOWER(updateDateTime)', strtolower($this->searchText), true, 'OR');
		$criteria->order = "isSeen ASC,ts.showDate ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function generateReserveCode($theaterShowtimeId)
	{
		$result = 0;
		$criteria = new CDbCriteria();
		$criteria->select = "MAX(reserveCode) as maxReserveCode";
		$criteria->compare("theaterShowTimeId", $theaterShowtimeId);
		$maxCode = $this->find($criteria);
		if(empty($maxCode->maxReserveCode) || $maxCode->maxReserveCode == 0)
		{
			$result = 1;
		}
		else
		{
			$result = $maxCode->maxReserveCode + 1;
		}
		return $result;
	}

	public function countReserveInWeek($startWeek, $endWeek, $employeeId)
	{
		$criteria = new CDbCriteria();
		$criteria->join = "LEFT JOIN theater_showtime ts ON ts.theaterShowtimeId = t.theaterShowTimeId";
//		$criteria->addBetweenCondition("ts.showDate", "'" . $startWeek . "'", "'" . $startWeek . "'");
		$criteria->addCondition("ts.showDate BETWEEN '$startWeek' AND '$endWeek'", "AND");
		$criteria->compare("t.status", 1);
		$criteria->compare("t.employeeId", $employeeId);

		return count($this->findAll($criteria));
	}

}
