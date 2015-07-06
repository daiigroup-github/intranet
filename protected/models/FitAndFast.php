<?php

/**
 * This is the model class for table "fit_and_fast".
 *
 * The followings are the available columns in table 'fit_and_fast':
 * @property string $fitAndFastId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $title
 * @property string $description
 * @property string $targetJan
 * @property string $actualJan
 * @property string $gradeJan
 * @property string $targetFeb
 * @property string $actualFeb
 * @property string $gradeFeb
 * @property string $targetMar
 * @property string $actualMar
 * @property string $gradeMar
 * @property string $targetApr
 * @property string $actualApr
 * @property string $gradeApr
 * @property string $targetMay
 * @property string $actualMay
 * @property string $gradeMay
 * @property string $targetJun
 * @property string $actualJun
 * @property string $gradeJun
 * @property string $targetJul
 * @property string $actualJul
 * @property string $gradeJul
 * @property string $targetAug
 * @property string $actualAug
 * @property string $gradeAug
 * @property string $targetSep
 * @property string $actualSep
 * @property string $gradeSep
 * @property string $targetOct
 * @property string $actualOct
 * @property string $gradeOct
 * @property string $targetNov
 * @property string $actualNov
 * @property string $gradeNov
 * @property string $targetDec
 * @property string $actualDec
 * @property string $gradeDec
 * @property integer $sumS
 * @property integer $sumF
 * @property integer $forYear
 * @property integer $type
 * @property string $fileJan
 * @property string $fileFeb
 * @property string $fileMar
 * @property string $fileApr
 * @property string $fileMay
 * @property string $fileJun
 * @property string $fileJul
 * @property string $fileAug
 * @property string $fileSep
 * @property string $fileOct
 * @property string $fileNov
 * @property string $fileDec
 */
class FitAndFast extends FitAndFastMaster
{

	public $sumGradeS;
	public $sumGradeF;
	public $searchText;
	public $sumGradeSJan;
	public $sumGradeSFeb;
	public $sumGradeSMar;
	public $sumGradeSApr;
	public $sumGradeSMay;
	public $sumGradeSJun;
	public $sumGradeSJul;
	public $sumGradeSAug;
	public $sumGradeSSep;
	public $sumGradeSOct;
	public $sumGradeSNov;
	public $sumGradeSDec;
	public $sumGradeFJan;
	public $sumGradeFFeb;
	public $sumGradeFMar;
	public $sumGradeFApr;
	public $sumGradeFMay;
	public $sumGradeFJun;
	public $sumGradeFJul;
	public $sumGradeFAug;
	public $sumGradeFSep;
	public $sumGradeFOct;
	public $sumGradeFNov;
	public $sumGradeFDec;
	public $actualArray = array(
		'actualJan',
		'actualFeb',
		'actualMar',
		'actualApr',
		'actualMay',
		'actualJun',
		'actualJul',
		'actualAug',
		'actualSep',
		'actualOct',
		'actualNov',
		'actualDec'
	);
	public $gradeArray = array(
		'gradeJan',
		'gradeFeb',
		'gradeMar',
		'gradeApr',
		'gradeMay',
		'gradeJun',
		'gradeJul',
		'gradeAug',
		'gradeSep',
		'gradeOct',
		'gradeNov',
		'gradeDec'
	);
	public $targetArray = array(
		'targetJan',
		'targetFeb',
		'targetMar',
		'targetApr',
		'targetMay',
		'targetJun',
		'targetJul',
		'targetAug',
		'targetSep',
		'targetOct',
		'targetNov',
		'targetDec'
	);
	public $fileArray = array(
		'fileJan',
		'fileFeb',
		'fileMar',
		'fileApr',
		'fileMay',
		'fileJun',
		'fileJul',
		'fileAug',
		'fileSep',
		'fileOct',
		'fileNov',
		'fileDec'
	);
	public $statusFitAndFastArray = array(
		'statusJan',
		'statusFeb',
		'statusMar',
		'statusApr',
		'statusMay',
		'statusJun',
		'statusJul',
		'statusAug',
		'statusSep',
		'statusOct',
		'statusNov',
		'statusDec'
	);

	//public $forYear;

	const TYPE_PERFORMANCE = 1;
	const TYPE_IMPLEMENT = 2;
	const STATUS_NA = 0;
	const STATUS_CREATED = 0x1;
	const STATUS_UPLOADED = 0x2;
	const STATUS_GRADED = 0x4;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FitAndFast the static model class
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
		return 'fit_and_fast';
	}

	/**
	 * @return array validation rules for model attributes.
	  public function rules()
	  {
	  // NOTE: you should only define rules for those attributes that
	  // will receive user inputs.
	  return array(
	  //array('createDateTime, updateDateTime, title, targetJan, targetFeb, targetMar, targetApr, targetMay, targetJun, targetJul, targetAug, targetSep, targetOct, targetNov, targetDec', 'required'),
	  array(
	  'status',
	  'numerical',
	  'integerOnly'=>true),
	  //			array(
	  //				'targetJan, actualJan, targetFeb, actualFeb, targetMar, actualMar, targetApr, actualApr, targetMay, actualMay, targetJun, actualJun, targetJul, actualJul, targetAug, actualAug, targetSep, actualSep, targetOct, actualOct, targetNov, actualNov, targetDec, actualDec',
	  //				'length',
	  //				'max'=>45
	  //			),
	  array(
	  'gradeJan, gradeFeb, gradeMar, gradeApr, gradeMay, gradeJun, gradeJul, gradeAug, gradeSep, gradeOct, gradeNov, gradeDec',
	  'length',
	  'max'=>5
	  ),
	  array(
	  'description, title, employeeId',
	  'safe'),
	  // The following rule is used by search().
	  // Please remove those attributes that should not be searched.
	  array(
	  'fitAndFastId, status, createDateTime, updateDateTime, title, description, targetJan, actualJan, gradeJan, targetFeb, actualFeb, gradeFeb, targetMar, actualMar, gradeMar, targetApr, actualApr, gradeApr, targetMay, actualMay, gradeMay, targetJun, actualJun, gradeJun, targetJul, actualJul, gradeJul, targetAug, actualAug, gradeAug, targetSep, actualSep, gradeSep, targetOct, actualOct, gradeOct, targetNov, actualNov, gradeNov, targetDec, actualDec, gradeDec, employeeId, sumGradeS, sumGradeF, searchText, forYear, type',
	  'safe',
	  'on'=>'search'
	  ),
	  array(
	  'createDateTime, updateDateTime',
	  'default',
	  'value'=>new CDbExpression('NOW()'),
	  'on'=>'insert'
	  ),
	  array(
	  'updateDateTime',
	  'default',
	  'value'=>new CDbExpression('NOW()'),
	  'on'=>'update'
	  ),
	  );
	  }
	 */
	public function rules()
	{
		return CMap::mergeArray(parent::rules(), array(
				//code here
				array(
					'searchText',
					'safe',
					'on'=>'search'),
				array(
					'createDateTime, updateDateTime',
					'default',
					'value'=>new CDbExpression('NOW()'),
					'on'=>'insert'
				),
				array(
					'updateDateTime',
					'default',
					'value'=>new CDbExpression('NOW()'),
					'on'=>'update'
				),
		));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'employee'=>array(
				self::BELONGS_TO,
				'Employee',
				'employeeId'
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fitAndFastId'=>'Fit And Fast',
			'status'=>'สถานะ',
			'createDateTime'=>'สร้างเมื่อ',
			'updateDateTime'=>'แก้ไขล่าสุด',
			'title'=>'หัวข้อ',
			'description'=>'รายละเอียด',
			'targetJan'=>'เป้าหมาย ม.ค.',
			'actualJan'=>'ทำได้ ม.ค.',
			'gradeJan'=>'เกรด ม.ค.',
			'targetFeb'=>'เป้าหมาย ก.พ.',
			'actualFeb'=>'ทำได้ ก.พ.',
			'gradeFeb'=>'เกรด ก.พ.',
			'targetMar'=>'เป้าหมาย มี.ค.',
			'actualMar'=>'ทำได้ มี.ค.',
			'gradeMar'=>'เกรด มี.ค.',
			'targetApr'=>'เป้าหมาย เม.ย.',
			'actualApr'=>'ทำได้ เม.ย.',
			'gradeApr'=>'เกรด เม.ย.',
			'targetMay'=>'เป้าหมาย พ.ค.',
			'actualMay'=>'ทำได้ พ.ค.',
			'gradeMay'=>'เกรด พ.ค.',
			'targetJun'=>'เป้าหมาย มิ.ย.',
			'actualJun'=>'ทำได้ มิ.ย.',
			'gradeJun'=>'เกรด มิ.ย.',
			'targetJul'=>'เป้าหมาย ก.ค.',
			'actualJul'=>'ทำได้ ก.ค.',
			'gradeJul'=>'เกรด ก.ค.',
			'targetAug'=>'เป้าหมาย ส.ค.',
			'actualAug'=>'ทำได้ ส.ค.',
			'gradeAug'=>'เกรด ส.ค.',
			'targetSep'=>'เป้าหมาย ก.ย.',
			'actualSep'=>'ทำได้ ก.ย.',
			'gradeSep'=>'เกรด ก.ย.',
			'targetOct'=>'เป้าหมาย ต.ค.',
			'actualOct'=>'ทำได้ ต.ค.',
			'gradeOct'=>'เกรด ต.ค.',
			'targetNov'=>'เป้าหมาย พ.ย.',
			'actualNov'=>'ทำได้ พ.ย.',
			'gradeNov'=>'เกรด พ.ย.',
			'targetDec'=>'เป้าหมาย ธ.ค.',
			'actualDec'=>'ทำได้ ธ.ค.',
			'gradeDec'=>'เกรด ธ.ค.',
			'employeeId'=>'พนักงาน',
			'forYear'=>'ปี',
			'type'=>'ประเภท',
			'fileJan'=>'ส่งงานเดือน ม.ค.',
			'fileFeb'=>'ส่งงานเดือน ก.พ.',
			'fileMar'=>'ส่งงานเดือน มี.ค.',
			'fileApr'=>'ส่งงานเดือน เม.ย.',
			'fileMay'=>'ส่งงานเดือน พ.ค.',
			'fileJun'=>'ส่งงานเดือน มิ.ย.',
			'fileJul'=>'ส่งงานเดือน ก.ค.',
			'fileAug'=>'ส่งงานเดือน ส.ค.',
			'fileSep'=>'ส่งงานเดือน ก.ย.',
			'fileOct'=>'ส่งงานเดือน ต.ค.',
			'fileNov'=>'ส่งงานเดือน พ.ย.',
			'fileDec'=>'ส่งงานเดือน ธ.ค.',
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

//		$criteria->compare('fitAndFastId', $this->fitAndFastId, true);
//		$criteria->compare('status', $this->status);
//		$criteria->compare('createDateTime', $this->createDateTime, true);
//		$criteria->compare('updateDateTime', $this->updateDateTime, true);
//		$criteria->compare('title', $this->searchText, true, 'OR');
//		$criteria->compare('description', $this->searchText, true, 'OR');
//		$criteria->compare('targetJan', $this->searchText, true, 'OR');
//		$criteria->compare('actualJan', $this->searchText, true, 'OR');
//		$criteria->compare('gradeJan', $this->searchText, true, 'OR');
//		$criteria->compare('targetFeb', $this->searchText, true, 'OR');
//		$criteria->compare('actualFeb', $this->searchText, true, 'OR');
//		$criteria->compare('gradeFeb', $this->searchText, true, 'OR');
//		$criteria->compare('targetMar', $this->searchText, true, 'OR');
//		$criteria->compare('actualMar', $this->searchText, true, 'OR');
//		$criteria->compare('gradeMar', $this->searchText, true, 'OR');
//		$criteria->compare('targetApr', $this->searchText, true, 'OR');
//		$criteria->compare('actualApr', $this->searchText, true, 'OR');
//		$criteria->compare('gradeApr', $this->searchText, true, 'OR');
//		$criteria->compare('targetMay', $this->searchText, true, 'OR');
//		$criteria->compare('actualMay', $this->searchText, true, 'OR');
//		$criteria->compare('gradeMay', $this->searchText, true, 'OR');
//		$criteria->compare('targetJun', $this->searchText, true, 'OR');
//		$criteria->compare('actualJun', $this->searchText, true, 'OR');
//		$criteria->compare('gradeJun', $this->searchText, true, 'OR');
//		$criteria->compare('targetJul', $this->searchText, true, 'OR');
//		$criteria->compare('actualJul', $this->searchText, true, 'OR');
//		$criteria->compare('gradeJul', $this->searchText, true, 'OR');
//		$criteria->compare('targetAug', $this->searchText, true, 'OR');
//		$criteria->compare('actualAug', $this->searchText, true, 'OR');
//		$criteria->compare('gradeAug', $this->searchText, true, 'OR');
//		$criteria->compare('targetSep', $this->searchText, true, 'OR');
//		$criteria->compare('actualSep', $this->searchText, true, 'OR');
//		$criteria->compare('gradeSep', $this->searchText, true, 'OR');
//		$criteria->compare('targetOct', $this->searchText, true, 'OR');
//		$criteria->compare('actualOct', $this->searchText, true, 'OR');
//		$criteria->compare('gradeOct', $this->searchText, true, 'OR');
//		$criteria->compare('targetNov', $this->searchText, true, 'OR');
//		$criteria->compare('actualNov', $this->searchText, true, 'OR');
//		$criteria->compare('gradeNov', $this->searchText, true, 'OR');
//		$criteria->compare('targetDec', $this->searchText, true, 'OR');
//		$criteria->compare('actualDec', $this->searchText, true, 'OR');
//		$criteria->compare('gradeDec', $this->searchText, true, 'OR');
//		$criteria->compare('forYear', $this->forYear, true, 'OR');
//		$criteria->compare('type', $this->type, true, 'OR');

		$criteria->with = array(
			'employee');
		$criteria->compare('employee.fnTh', $this->searchText, true, 'OR');
		$criteria->compare('employee.lnTh', $this->searchText, true, 'OR');

		if(isset($this->forYear))
		{
			$criteria->compare('forYear', $this->forYear);
		}

		$handle = fopen('/tmp/user', 'w+');
		fwrite($handle, print_r($this->searchText, true));
		fclose($handle);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>20),
		));
	}

	public function monthlySummary($year, $isManager = null, $companyId = null, $companyDivisionId = null)
	{
		$condition = '';
		if($isManager)
			$condition = ' AND isManager=1 ';

		if($companyId)
			$condition .= ' AND companyId=' . $companyId;

		if($companyDivisionId)
			$condition .= ' AND companyDivisionId=' . $companyDivisionId;

		$employeeArray = CHtml::listData(Employee::model()->findAll('status=1' . $condition), 'username', 'employeeId');

		$dataMonthly['Jan']['s'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeJan="S" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Jan']['f'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeJan="F"');
		$dataMonthly['Jan']['percent'] = ($dataMonthly['Jan']['s'] + $dataMonthly['Jan']['f']) ? number_format(($dataMonthly['Jan']['s'] / ($dataMonthly['Jan']['s'] + $dataMonthly['Jan']['f'])) * 100, 2) : 0;

		$dataMonthly['Feb']['s'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeFeb="S" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Feb']['f'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeFeb="F" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Feb']['percent'] = ($dataMonthly['Feb']['s'] + $dataMonthly['Feb']['f']) ? number_format(($dataMonthly['Feb']['s'] / ($dataMonthly['Feb']['s'] + $dataMonthly['Feb']['f'])) * 100, 2) : 0;

		$dataMonthly['Mar']['s'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeMar="S" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Mar']['f'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeMar="F" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Mar']['percent'] = ($dataMonthly['Mar']['s'] + $dataMonthly['Mar']['f']) ? number_format(($dataMonthly['Mar']['s'] / ($dataMonthly['Mar']['s'] + $dataMonthly['Mar']['f'])) * 100, 2) : 0;

		$dataMonthly['Apr']['s'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeApr="S" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Apr']['f'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeApr="F" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Apr']['percent'] = ($dataMonthly['Apr']['s'] + $dataMonthly['Apr']['f']) ? number_format(($dataMonthly['Apr']['s'] / ($dataMonthly['Apr']['s'] + $dataMonthly['Apr']['f'])) * 100, 2) : 0;

		$dataMonthly['May']['s'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeMay="S" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['May']['f'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeMay="F" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['May']['percent'] = ($dataMonthly['May']['s'] + $dataMonthly['May']['f']) ? number_format(($dataMonthly['May']['s'] / ($dataMonthly['May']['s'] + $dataMonthly['May']['f'])) * 100, 2) : 0;

		$dataMonthly['Jun']['s'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeJun="S" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Jun']['f'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeJun="F" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Jun']['percent'] = ($dataMonthly['Jun']['s'] + $dataMonthly['Jun']['f']) ? number_format(($dataMonthly['Jun']['s'] / ($dataMonthly['Jun']['s'] + $dataMonthly['Jun']['f'])) * 100, 2) : 0;

		$dataMonthly['Jul']['s'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeJul="S" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Jul']['f'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeJul="F" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Jul']['percent'] = ($dataMonthly['Jul']['s'] + $dataMonthly['Jul']['f']) ? number_format(($dataMonthly['Jul']['s'] / ($dataMonthly['Jul']['s'] + $dataMonthly['Jul']['f'])) * 100, 2) : 0;

		$dataMonthly['Aug']['s'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeAug="S" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Aug']['f'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeAug="F" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Aug']['percent'] = ($dataMonthly['Aug']['s'] + $dataMonthly['Aug']['f']) ? number_format(($dataMonthly['Aug']['s'] / ($dataMonthly['Aug']['s'] + $dataMonthly['Aug']['f'])) * 100, 2) : 0;

		$dataMonthly['Sep']['s'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeSep="S" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Sep']['f'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeSep="F" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Sep']['percent'] = ($dataMonthly['Sep']['s'] + $dataMonthly['Sep']['f']) ? number_format(($dataMonthly['Sep']['s'] / ($dataMonthly['Sep']['s'] + $dataMonthly['Sep']['f'])) * 100, 2) : 0;

		$dataMonthly['Oct']['s'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeOct="S" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Oct']['f'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeOct="F" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Oct']['percent'] = ($dataMonthly['Oct']['s'] + $dataMonthly['Oct']['f']) ? number_format(($dataMonthly['Oct']['s'] / ($dataMonthly['Oct']['s'] + $dataMonthly['Oct']['f'])) * 100, 2) : 0;

		$dataMonthly['Nov']['s'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeNov="S" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Nov']['f'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeNov="F" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Nov']['percent'] = ($dataMonthly['Nov']['s'] + $dataMonthly['Nov']['f']) ? number_format(($dataMonthly['Nov']['s'] / ($dataMonthly['Nov']['s'] + $dataMonthly['Nov']['f'])) * 100, 2) : 0;

		$dataMonthly['Dec']['s'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeDec="S" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Dec']['f'] = FitAndFast::model()->count('YEAR(createDateTime) = ' . $year . ' AND gradeDec="F" AND employeeId IN (' . implode(',', $employeeArray) . ')');
		$dataMonthly['Dec']['percent'] = ($dataMonthly['Dec']['s'] + $dataMonthly['Dec']['f']) ? number_format(($dataMonthly['Dec']['s'] / ($dataMonthly['Dec']['s'] + $dataMonthly['Dec']['f'])) * 100, 2) : 0;

		return $dataMonthly;
	}

	public function divisionSummary($year, $isManager = 0, $companyId = null)
	{
		$data = array();
		$i = 0;
		foreach(Company::model()->findAll(($companyId) ? 'companyId=' . $companyId : '') as $companyModel)
		{
			$criteria = new CDbCriteria();
			$criteria->condition = 'companyId=:companyId AND status=1 And isManager=:isManager';
			$criteria->params = array(
				':companyId'=>$companyModel->companyId,
				':isManager'=>$isManager
			);
			$criteria->group = 'companyDivisionId';

			$companyDivisions = Employee::model()->findAll($criteria);

			if(!empty($companyDivisions))
			{
				$data[$i]['name'] = $companyModel->companyNameTh;
				$data[$i]['companyId'] = $companyModel->companyId;

				$j = 0;
				foreach($companyDivisions as $c)
				{
					$employeeArray = CHtml::listData(Employee::model()->findAll(array(
								'condition'=>'status=1 AND companyId=:companyId AND companyDivisionId=:companyDivisionId AND isManager=:isManager',
								'params'=>array(
									':isManager'=>$isManager,
									':companyId'=>$companyModel->companyId,
									':companyDivisionId'=>$c->companyDivision->companyDivisionId
								)
							)), 'employeeCode', 'employeeId');

					$grade = FitAndFast::model()->findBySql('SELECT sum(sumS) as sumGradeS, sum(sumF) as sumGradeF FROM fit_and_fast WHERE employeeId IN (' . implode(',', $employeeArray) . ') AND YEAR(createDateTime) = ' . $year);

					$data[$i]['division'][$j]['name'] = $c->companyDivision->description;
					$data[$i]['division'][$j]['divisionId'] = $c->companyDivision->companyDivisionId;
					$data[$i]['division'][$j]['score'] = (($grade->sumGradeS + $grade->sumGradeF) > 0) ? number_format(($grade->sumGradeS / ($grade->sumGradeS + $grade->sumGradeF)) * 100, 2) : 0;

					$j++;
				}
				$i++;
			}
		}

		return $data;
	}

	public function companySummary($companyId = null)
	{

	}

	public function typeArray()
	{
		return array(
			self::TYPE_PERFORMANCE=>'Performance',
			self::TYPE_IMPLEMENT=>'Implement');
	}

	public function typeText()
	{
		$typeArray = $this->typeArray();
		return $typeArray[$this->type];
	}

	public function gradeByEmployeeId($employeeId, $forYear = null)
	{
		$forYear = isset($forYear) ? $forYear : date('Y');
		$model = $this->find('employeeId=:employeeId AND forYear=:forYear', array(
			':employeeId'=>$employeeId,
			':forYear'=>$forYear));

		$res = array();

		if($forYear == 2013)
		{
			$res = array(
				'sumS'=>$model->sumS,
				'sumF'=>$model->sumF,
				'percent'=>(($model->sumF + $model->sumS ) > 0) ? 100 * $model->sumS / ($model->sumS + $model->sumF) : 0);
		}
		else
		{
			if(isset($model))
			{
				$res = unserialize($model->sumGrade);
				$res['percent'] = $this->calculatePercent($forYear, $employeeId);
			}
			else
			{
				$res['percent'] = 0;
			}
		}

		return $res;
	}

	public function calculatePercent($forYear, $employeeId = NULL)
	{
		$employeeId = (isset($employeeId)) ? $employeeId : Yii::app()->user->id;
		$fitAndFastModels = FitAndFast::model()->findAll('employeeId=:employeeId AND forYear=:forYear AND sumGrade IS NOT NULL', array(
			':employeeId'=>$employeeId,
			':forYear'=>$forYear));

		$s = 0;
		$S = 0;
		$SS = 0;
		$f = 0;

		$handle = fopen('/tmp/calculatePercent', 'a+');
		if(file_exists('/tmp/calculatePercent'))
			unlink('/tmp/calculatePercent');

		foreach($fitAndFastModels as $fitAndFastModel)
		{
			$sumGrade = unserialize($fitAndFastModel->sumGrade);
			fwrite($handle, print_r($sumGrade, true));
			$s += $sumGrade['s'];
			$S += $sumGrade['S'];
			$SS += $sumGrade['SS'];
			$f += $sumGrade['F'];
		}

		$sPoint = 0.5 * $s;
		$SPoint = $S;
		$SSPoint = 2 * $SS;
		$sumPoint = $sPoint + $SPoint + $SSPoint;
		$sum = $s + $S + ( 2 * $SS ) + $f;

		if($sum > 0 && $sumPoint > 0)
		{
			fwrite($handle, 'sumPoint = ' . $sumPoint . ' sum = ' . $sum . ' devide = ' . $sumPoint / $sum);
			return number_format(100 * ($sumPoint ) / ( $sum), 2);
		}

		fclose($handle);
		return 0;
	}

	public function calculateGradeS($field, $type)
	{
		/**
		 * Performance
		 * 1 S if approve before 20th of next month
		 * 0.5 S if approve after 20th of next month and before the end of next month
		 *
		 * Implement
		 * 2 S if approve before 20th of next month
		 * 1 S if approve after 20th of next month
		 */
		$today = strtotime(date('Y-m-d'));
		$fitAndFastMonth = array_search($field, $this->gradeArray);
		$next20th = strtotime(date('Y' . '-' . ($fitAndFastMonth + 1 ) . '-20') . ' +1 month');
		$grade = '';

		if($today < $next20th)
		{
			if($type == 1) // Performance
			{
				$grade = 'S';
			}
			else //Implement
			{
				$grade = 'SS';
			}
		}
		else
		{
			//late
			if($type == 1) // Performance
			{
				$grade = 's';
			}
			else //Implement
			{
				$grade = 'S';
			}
		}

		return $grade;
	}

	public function gradePoint($grade)
	{
		switch($grade)
		{
			case 's':
				return 0.5;
				break;

			case 'S':
				return 1;
				break;

			case 'SS':
				return 2;
				break;

			case 'F':
				return 1;
				break;
		}
	}

	public function findAllWaitingForUpload($forYear = NULL, $employeeId = NULL)
	{
		$employeeId = (isset($employeeId)) ? $employeeId : Yii::app()->user->id;
		$forYear = (isset($forYear)) ? $forYear : date('Y');
		$res = array();

		$models = $this->findAll('employeeId=:employeeId AND forYear=:forYear', array(
			':employeeId'=>$employeeId,
			':forYear'=>$forYear));

		foreach($models as $model)
		{
			/**
			 * หาย้อนหลังไป 1 เดือน
			 * ช่วงแรกให้เริ่มที่ เดือน ม.ค. ก่อน
			 */
			//for($i = date('m') - 2; $i <= date('m') - 1; $i++)
			for($i = 0; $i <= date('m') - 1; $i++)
			{
				if($model->{$this->statusFitAndFastArray[$i] } == self::STATUS_CREATED)
				{
					//echo $model->title . '(' . $model->{$this->targetArray[$i]} . ')' . '<br />';
					$res[$model->fitAndFastId]['title'] = $model->title;
					$res[$model->fitAndFastId]['data'][$this->fileArray[$i]] = $model->{$this->targetArray[$i]
						};
				}
			}
		}

		return $res;
	}

	public function divisionPercent($divisionId, $companyId = NULL, $forYear = NULL)
	{
		$forYear = isset($forYear) ? $forYear : date('Y');

		if(!isset($companyId))
		{
			$employeeModel = Employee::model()->findByPk(Yii::app()->user->id);
			$companyId = $employeeModel->companyId;
		}

		//find all employees in division
		$employeeModels = Employee::model()->findAll('status=1 AND companyDivisionId=:divisionId AND companyId=:companyId', array(
			':divisionId'=>$divisionId
			,
			':companyId'=>$companyId));
		$sumPercent = 0;

		if($employeeModels)
		{
			foreach($employeeModels as $employeeModel)
			{
				$sumPercent += $this->calculatePercent($forYear, $employeeModel->employeeId);
			}

			return number_format($sumPercent / sizeof($employeeModels), 2);
		}

		return 0;
	}

	public function companyPercent($forYear = NULL)
	{

	}

	public function findAllWaitingForGradeInCompanyDivision($companyDivisionId, $isManager = NULL, $forYear = NULL)
	{
		$forYear = (isset($forYear)) ? $forYear : date('Y');
		$employees = Employee::model()->findAll('status=1 AND companyDivisionId=:companyDivisionId', array(
			':companyDivisionId'=>$companyDivisionId));
		$res = array();

		foreach($employees as $employee)
		{
			if($employee->employeeId == Yii::app()->
				user->id)
				continue;

			$models = $this->findAll('employeeId=:employeeId AND forYear=:forYear', array(
				':employeeId'=>$employee->
				employeeId,
				':forYear'=>$forYear));

			foreach($models as $model)
			{
				/**
				 * หาย้อนหลังไป 1 เดือน
				 */
				//for($i = date('m') - 2; $i <= date('m') - 1; $i++)
				for($i = 0; $i <= date('m') - 1; $i++)
				{
					if($model->{$this->statusFitAndFastArray [$i]} == self::STATUS_UPLOADED)
					{
						if($model->{$this->statusFitAndFastArray [
							$i]} != 2)
							continue;

						//echo $model->title . '(' . $model->{$this->targetArray[$i]} . ')' . '<br />';
						$res[$employee->employeeId]['name'] = $model->employee->fnTh . ' ' . $model->employee->lnTh;
						$res[$employee->employeeId]['fitAndFast'][$model->fitAndFastId]['title'] = $model->title;
						$res[$employee->employeeId]['fitAndFast'][$model->fitAndFastId]['data'][$i]['fileMonth'] = $this->fileArray[$i];
						$res[$employee->employeeId]['fitAndFast'][$model->fitAndFastId]['data'][$i]['fileDateTime'] = $model->{$this->fileArray[$i] . 'DateTime'};
						$res[$employee->employeeId]['fitAndFast'][$model->fitAndFastId]['data'][$i]['fileName'] = $model->{$this->fileArray[$i]};
						$res[$employee->employeeId]['fitAndFast'][$model->fitAndFastId]['data'][$i]['target'] = $model->{$this->targetArray[$i]};
						$res[$employee->employeeId]['fitAndFast'][$model->fitAndFastId]['data'][$i]['gradeMonth'] = $this->gradeArray[$i];
						$res[$employee->employeeId]['fitAndFast'][$model->fitAndFastId]['data'][$i]['type'] = $model->type;
					}
				}
			}
		}

		$handle = fopen('/tmp/findAllWaitingForGrade', 'w+');
		fwrite($handle, print_r($res, true));
		fclose($handle);
		return $res;
	}

	public function findAllWaitingForGradeInManagement($forYear = NULL)
	{
		$forYear = (isset($forYear)) ? $forYear : date('Y');
		$employees = Employee::model()->findAll('status=1 AND isManager=1');
		$res = array();

		return $this->waitingForGrade($employees, $forYear);
	}

	public function findAllWaitingForGradeByManagerId($managerId, $forYear = NULL)
	{
		$forYear = (isset($forYear)) ? $forYear : date('Y');
		$employees = Employee::model()->findAll('status=1 AND managerId=:managerId', array(
			':managerId'=>$managerId));
		$res = array();

		return $this->waitingForGrade($employees, $forYear);
	}

	private function waitingForGrade($employees, $forYear)
	{
		$res = array();
		foreach($employees as $employee)
		{
			if($employee->employeeId == Yii::app()->
				user->id)
				continue;

			$models = $this->findAll('employeeId=:employeeId AND forYear=:forYear', array(
				':employeeId'=>$employee->
				employeeId,
				':forYear'=>$forYear));

			foreach($models as $model)
			{
				/**
				 * หาย้อนหลังไป 1 เดือน
				 */
				//for($i = date('m') - 2; $i <= date('m') - 1; $i++)
				for($i = 0; $i <= date('m') - 1; $i++)
				{
					if($model->{$this->statusFitAndFastArray [$i]} == self::STATUS_UPLOADED)
					{
						if($model->{$this->statusFitAndFastArray [
							$i]} != 2)
							continue;

						//echo $model->title . '(' . $model->{$this->targetArray[$i]} . ')' . '<br />';
						$res[$employee->employeeId]['name'] = $model->employee->fnTh . ' ' . $model->employee->lnTh;
						$res[$employee->employeeId]['fitAndFast'][$model->fitAndFastId]['title'] = $model->title;
						$res[$employee->employeeId]['fitAndFast'][$model->fitAndFastId]['data'][$i]['fileMonth'] = $this->fileArray[$i];
						$res[$employee->employeeId]['fitAndFast'][$model->fitAndFastId]['data'][$i]['fileDateTime'] = $model->{$this->fileArray[$i] . 'DateTime'};
						$res[$employee->employeeId]['fitAndFast'][$model->fitAndFastId]['data'][$i]['fileName'] = $model->{$this->fileArray[$i]};
						$res[$employee->employeeId]['fitAndFast'][$model->fitAndFastId]['data'][$i]['target'] = $model->{$this->targetArray[$i]};
						$res[$employee->employeeId]['fitAndFast'][$model->fitAndFastId]['data'][$i]['gradeMonth'] = $this->gradeArray[$i];
						$res[$employee->employeeId]['fitAndFast'][$model->fitAndFastId]['data'][$i]['type'] = $model->type;
					}
				}
			}
		}
		return $res;
	}

}
