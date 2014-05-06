<?php

/**
 * This is the model class for table "employee".
 *
 * The followings are the available columns in table 'employee':
 * @property string $employeeId
 * @property string $employeeCode
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $isFirstLogin
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $prefix
 * @property string $prefixOther
 * @property string $fnTh
 * @property string $lnTh
 * @property string $nickName
 * @property string $fnEn
 * @property string $lnEn
 * @property integer $gender
 * @property string $citizenId
 * @property string $accountNo
 * @property string $ext
 * @property string $mobile
 * @property integer $employeeLevelId
 * @property string $position
 * @property integer $companyId
 * @property string $companyValue
 * @property integer $branchId
 * @property string $branchValue
 * @property integer $companyDivisionId
 * @property string $managerId
 * @property string $startDate
 * @property string $proDate
 * @property string $transferDate
 * @property string $endDate
 * @property string $birthDate
 * @property integer $isSale
 * @property integer $isEngineer
 * @property integer $leaveQuota
 * @property integer $leaveRemain
 */
class Employee extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Employee the static model class
	 */
//status

	const STATUS_ACTIVE = 1;
	const STATUS_RESIGN = 2;
	const STATUS_LOCK = 3;
//prefix
	const PREFIX_MR = 1;
	const PREFIX_MS = 2;
	const PREFIX_MRS = 4;
//gender
	const GENDER_MALE = 1;
	const GENDER_FEMALE = 2;

	public $searchText;
	public $_isSale;
	public $_isEngineer;
	public $preEmpCode;
	public $maxEmpCode;
	public $resetPwdError;
	public $leaveTimeType;
	public $leaveSick;
	public $leavePersonal;
	public $leaveVocation;
	public $leavePregnancy;
	public $leaveOrdinate;
	public $leaveOther;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employee';
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
				'prefix, fnTh, lnTh, fnEn, lnEn, gender, employeeLevelId, position, companyId, branchId, companyDivisionId, startDate, birthDate',
				'required'),
			array(
				'status, prefix, gender, employeeLevelId, companyId, branchId, companyDivisionId, isSale, isEngineer, isFirstLogin',
				'numerical',
				'integerOnly'=>true),
			array(
				'employeeId, username, branchValue, managerId',
				'length',
				'max'=>10),
			array(
				'password, prefixOther',
				'length',
				'max'=>40),
			array(
				'email, fnTh, fnEn',
				'length',
				'max'=>80),
			array(
				'nickName',
				'length',
				'max'=>45),
			array(
				'citizenId, accountNo',
				'length',
				'max'=>50),
			array(
				'lnTh, lnEn, position',
				'length',
				'max'=>120),
			array(
				'companyValue, mobile',
				'length',
				'max'=>20),
			array(
				'ext',
				'length',
				'max'=>10),
			array(
				'employeeCode, transferDate, endDate, proDate, ext, mobile, leaveRemain',
				'safe'),
			// The following rule is used by search().
// Please remove those attributes that should not be searched.
			array(
				'employeeId, status, createDateTime, updateDateTime , username, password, email, prefix, prefixOther, fnTh, lnTh, nickName, fnEn, lnEn, gender, citizenId, accountNo, employeeLevelId, position, companyId, companyValue, branchId, branchValue, companyDivisionId, managerId, startDate, proDate, transferDate, endDate, birthDate, isSale, isEngineer, searchText, leaveRemain',
				'safe',
				'on'=>'search'),);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
		return array(
			'level'=>array(
				self::HAS_ONE,
				'EmployeeLevel',
				array(
					'level'=>'employeeLevelId')),
			'company'=>array(
				self::BELONGS_TO,
				'Company',
				'companyId'),
			'branch'=>array(
				self::BELONGS_TO,
				'Branch',
				'branchId'),
			'division'=>array(
				self::BELONGS_TO,
				'CompanyDivision',
				'companyDivisionId'),
			'manager'=>array(
				self::HAS_ONE,
				'Employee',
				array(
					'employeeId'=>'managerId')),
			'mileage'=>array(
				self::HAS_MANY,
				'Mileage',
				array(
					'employeeId'=>'employeeId'),
				'condition'=>'mileage.status=1',
				'order'=>'mileage.createDateTime DESC'),
			'mobileAppPriv'=>array(
				self::HAS_MANY,
				'MobileAppPriv',
				array(
					'employeeId'=>'employeeId')),);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'employeeId'=>'Employee',
			'employeeCode'=>'รหัสพนักงาน',
			'status'=>'Status',
			'createDateTime'=>'Create Date Time',
			'updateDateTime'=>'Update Date Time',
			'username'=>'Username',
			'password'=>'Password',
			'email'=>'Email',
			'prefix'=>'คำนำหน้า',
			'prefixOther'=>'Prefix Other',
			'fnTh'=>'ชื่อ (ไทย)',
			'lnTh'=>'นามสกุล (ไทย)',
			'nickName'=>'ชื่อเล่น (ไทย)',
			'fnEn'=>'ชื่อ (อังกฤษ)',
			'lnEn'=>'นามสกุล (อังกฤษ)',
			'gender'=>'เพศ',
			'citizenId'=>'รหัสประจำตัวประชาชน',
			'accountNo'=>'เลขที่บัญชี',
			'ext'=>'เบอร์ต่อภายใน',
			'mobile'=>'เบอร์มือถือ',
			'employeeLevelId'=>'ระดับตำแหน่ง',
			'position'=>'ตำแหน่ง',
			'companyId'=>'บริษัท',
			'companyValue'=>'Company Value',
			'branchId'=>'สาขา',
			'branchValue'=>'Branch Value',
			'companyDivisionId'=>'ฝ่าย',
			'managerId'=>'ผู้บังคับบัญชา',
			'startDate'=>'วันเริ่มงาน',
			'proDate'=>'Pro Date',
			'transferDate'=>'วันที่โอนย้ายงาน',
			'endDate'=>'วันที่ทำงานวันสุดท้าย',
			'birthDate'=>'วันเกิด',
			'isSale'=>'พนักงานขาย',
			'isEngineer'=>'วิศวกร',
			'searchText'=>'ค้นหา',
			'fullNameTh'=>'ชื่อ (ไทย)',
			'fullNameEn'=>'ชื่อ (อังกฤษ)',
			'leaveQuota'=>'จำนวนวันลาพักร้อน',
			'leaveRemain'=>'จำนวนวันลาพักร้อนคงเหลือ',
			'leaveSick'=>'ลาป่วย',
			'leavePersonal'=>'ลากิจ',
			'leaveVocation'=>'ลาพักร้อน',
			'leavePregnancy'=>'ลาคลอด',
			'leaveOrdinate'=>'ลาบวช',
			'leaveOther'=>'ลาอื่นๆ'
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

		$criteria->compare('fnTh', $this->searchText, true, 'OR');
		$criteria->compare('lnTh', $this->searchText, true, 'OR');
		$criteria->compare('nickName', $this->nickName, true);
		$criteria->compare('fnEn', $this->searchText, true, 'OR');
		$criteria->compare('lnEn', $this->searchText, true, 'OR');
		$criteria->compare('employeeCode', $this->searchText, true, 'OR');
		$criteria->compare('username', $this->searchText, true, 'OR');
		$criteria->compare('companyId', $this->companyId);
		$criteria->compare('companyDivisionId', $this->companyDivisionId);
		$criteria->compare('branchId', $this->branchId);
		$criteria->compare('isEngineer', $this->isEngineer);
		$criteria->compare('isSale', $this->isSale);
		$criteria->compare('status', !isset($this->status) ? 1 : $this->status);
		$criteria->compare('managerId', $this->managerId);

		if(Yii::app()->user->name != 'tm')
		{
			$criteria->addCondition('username!="tm"');
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'employeeCode ASC , companyId ASC , companyDivisionId ASC',),
			'pagination'=>array(
				'pageSize'=>50),));
	}

//Custom

	public function getEmployeeStatus()
	{
		return array(
			''=>'---',
			self::STATUS_ACTIVE=>'ยังทำงานอยู่',
			self::STATUS_RESIGN=>'ลาออกแล้ว',
			self::STATUS_LOCK=>'Lock',);
	}

	public function employeeStatusText()
	{
		$employeeStatus = $this->EmployeeStatus;
		return isset($employeeStatus[$this->status]) ? $employeeStatus[$this->status] : '-';
	}

	public function getEmployeePrefix()
	{
		return array(
			''=>'---',
			self::PREFIX_MR=>'นาย MR.',
			self::PREFIX_MS=>'นางสาว MS.',
			self::PREFIX_MRS=>'นาง MRS.',);
	}

	public function employeePrefixTh($prefix = null)
	{
		$employeePrefix = $this->employeePrefix;

		$p = (!$prefix) ? $this->prefix : $prefix;

		if(isset($employeePrefix[$p]))
		{
			$p = explode(' ', $employeePrefix[$p]);
			return $p[0];
		}

		return '-';
	}

	public function employeePrefixEn($prefix = null)
	{
		$employeePrefix = $this->employeePrefix;

		$p = (!$prefix) ? $this->prefix : $prefix;

		if(isset($employeePrefix[$p]))
		{
			$p = explode(' ', $employeePrefix[$p]);
			return $p[1];
		}

		return '-';
	}

	public function getEmployeeGender()
	{
		return array(
			''=>'---',
			self::GENDER_MALE=>'ชาย',
			self::GENDER_FEMALE=>'หญิง',);
	}

	public function employeeGenderText()
	{
		$employeeGender = $this->employeeGender;
		return isset($employeeGender[$this->gender]) ? $employeeGender[$this->gender] : '-';
	}

	public function getAllManager()
	{
		$models = $this->findAll(array(
			'condition'=>'employeeLevelId>=7 AND status = 1',
			'order'=>'username',));

		$manager = array(
			''=>'---');

		foreach($models as $model)
		{
			$manager[$model->employeeId] = strtoupper($model->username);
		}

		return $manager;
	}

	public function genUsername()
	{
		$u = substr($this->fnEn, 0, 1) . substr($this->lnEn, 0, 1);

		for($i = 1; $i <= strlen($this->lnEn) - 1; $i++)
		{
			$username = $u . substr($this->lnEn, $i, 1);

			if(!$this->exists('username="' . $username . '"'))
				break;
		}

		return strtolower($username);
	}

	public function genEmail()
	{
		$e = strtolower($this->fnEn);
		$ln = strtolower($this->lnEn);

		for($i = 0; $i < strlen($this->lnEn); $i++)
		{
			$email = $e . '.' . substr($ln, $i, 1);

			if(!$this->exists('email="' . $email . '"'))
				;
			break;
		}

		return $email;
	}

	public function genEmployeeCode()
	{
		$criteria = new CDbCriteria;
		$criteria->select = 'SUBSTRING(employeeCode,1,2) as preEmpCode';
		$criteria->condition = 'companyDivisionId=:companyDivisionId AND companyId =:companyId';
		$criteria->params = array(
			':companyDivisionId'=>$this->companyDivisionId,
			':companyId'=>$this->companyId);
//$criteria->order = 'employeeCode DESC';
		$employee = $this->find($criteria);

		$criteria2 = new CDbCriteria;
		$criteria2->select = 'MAX(employeeCode) as maxEmpCode';
		$criteria2->condition = "employeeCode LIKE '$employee->preEmpCode%'";
//$criteria2->params = array(':employeeCode'=>$employee->preEmpCode);
//$criteria->order = 'employeeCode DESC';
		$employee2 = Employee::model()->find($criteria2);
		return ($employee2->maxEmpCode + 1);
	}

	public function genProDate($date, $isSale = null)
	{
		$d = explode('-', $date);

		if($isSale)
		{
			$proDate = 119;
			$date = date('Y-m-d', mktime(0, 0, 0, $d[1], $d[2] + $proDate, $d[0]));
		}
		else
		{
			$proMonth = 3;
			$date = date('Y-m-d', mktime(0, 0, 0, $d[1] + $proMonth, $d[2], $d[0]));
		}
		return $date;
	}

	public function getAllEngineer()
	{
		$models = $this->findAll(array(
			'condition'=>'isEngineer=1 AND status=1',
			'order'=>'fnTh',));

		foreach($models as $model)
		{
			$engineer[$model->employeeId] = $model->fnTh . ' ' . $model->lnTh;
		}

		return $engineer;
	}

	public function validatePassword($password)
	{
		return $this->hashPassword($this->username, $password) === $this->password;
	}

	public function hashPassword($username, $password)
	{
		return md5($username . $password);
	}

	public function checkMatchEmployeeIdAndPassword($employeeId, $inputPassword)
	{
		$employee = $this->findByPk($employeeId);
		if($employee->status == 1)
		{
			return $this->hashPassword($employee->username, $inputPassword) === $employee->password;
		}
		else
		{   //case employee ลาออกแล้ว
			return true;
		}
	}

	public function genEmployeeUsernameArray($models, $text)
	{
		$e = array(
			''=>isset($text) ? '- ' . $text . ' -' : '---',
			"-1"=>"ผู้สร้างเอกสาร");
		foreach($models as $model)
		{
			$e[$model->employeeId] = $model->username . ' : ' . $model->fnTh . ' ' . $model->lnTh;
			if(isset($model->nickName))
			{
				$e[$model->employeeId] .= '(' . $model->nickName . ')';
			}
		}

		return $e;
	}

	public function getAllEmployeeByCompanyId($companyId)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'status=1 AND companyId=:companyId';
		$criteria->params = array(
			':companyId'=>$companyId);

		$models = $this->findAll($criteria);

		if($models === NULL)
			throw new Exception('Requested companyDivisionId(' . $companyDivisionId . ') does not exist.');

		return $this->genEmployeeUsernameArray($models, NULL);
	}

	public function getAllEmployeeBycompanyDivisionId($companyDivisionId)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'status=1 AND companyDivisionId=:companyDivisionId';
		$criteria->params = array(
			':companyDivisionId'=>$companyDivisionId);

		$models = $this->findAll($criteria);

		if($models === NULL)
			throw new Exception('Requested companyDivisionId(' . $companyDivisionId . ') does not exist.');

		return $this->genEmployeeUsernameArray($models, NULL);
	}

	public function getAllEmployeeByCompanyIdAndCompanyDivisionId($companyId, $companyDivisionId)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'status=1 AND companyDivisionId=:companyDivisionId AND companyId=:companyId';
		$criteria->params = array(
			':companyDivisionId'=>$companyDivisionId,
			':companyId'=>$companyId);

		$models = $this->findAll($criteria);

		if($models === NULL)
			throw new Exception('Requested companyDivisionId(' . $companyDivisionId . ') does not exist.');

		return $this->genEmployeeUsernameArray($models, NULL);
	}

	public function getAllEmployeeByDivisionValue($divisionValue)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'status=1 AND companyDivisionId|:divisionValue>0';
		$criteria->params = array(
			':divisionValue'=>$divisionValue);
		$criteria->order = 'username';

		$models = $this->findAll($criteria);

		if($models === NULL)
			throw new Exception('Requested divisionValue(' . $divisionValue . ') does not exist.');

		return $this->genEmployeeUsernameArray($models, NULL);
	}

	public function getManagerBycompanyDivisionId($companyDivisionId)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'status=1 AND companyDivisionId=:companyDivisionId';
		$criteria->params = array(
			':companyDivisionId'=>$companyDivisionId);

		$model = $this->find($criteria);

		if($model === NULL)
			throw new Exception('Requested companyDivisionId(' . $companyDivisionId . ') does not exist.');

		return array(
			$model->employeeId=>$model->username);
	}

	public function getManagerByDivisionValue($divisionValue)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'status=1 AND employeeLevelId>=7 AND divisionValue &:divisionValue>0';
		$criteria->params = array(
			':divisionValue'=>$divisionValue);

		$models = $this->findAll($criteria);

		if($models === NULL)
			throw new Exception('Requested does not exist.');

		return $this->genEmployeeUsernameArray($models, NULL);
	}

	public function getAllSale()
	{
		$model = $this->findByPk(Yii::app()->user->id);

		$criteria = new CDbCriteria();
//$criteria->compare('companyId', $model->companyId);
		$criteria->compare('isSale', 1);

		$models = $this->findAll($criteria);

		if($models === NULL)
			throw new Exception('Requested does not exist.');

		return $this->genEmployeeUsernameArray($models, 'Sale');
	}

	public function getAllSaleByCompanyId()
	{
		$model = $this->findByPk(Yii::app()->user->id);

		$criteria = new CDbCriteria();
//$criteria->compare('companyId', $model->companyId);
		$criteria->compare('isSale', 1);
		$criteria->compare('companyId', $model->companyId);
		$models = $this->findAll($criteria);

		if($models === NULL)
			throw new Exception('Requested does not exist.');

		return $this->genEmployeeUsernameArray($models, 'Sale');
	}

//Save

	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->createDateTime = date('Y-m-d H:i:s');
		}

		return parent::beforeSave();
	}

	public function getAllEmployee($status = 1)
	{
		$models = Employee::model()->findAll(array(
			'condition'=>'status&:status>0',
			'params'=>array(
				':status'=>$status),
			'order'=>'fnTh'));

		$w = array(
			''=>'Choose..');

		foreach($models as $model)
		{
			$w[$model->employeeId] = $model->fnTh . " " . $model->lnTh;
		}

		return $w;
	}

	public function getAllStatus()
	{
		$w = array(
			''=>'สถานะ..');
		$w[1] = "ยังทำงานอยู่";
		$w[2] = "ลาออกแล้ว";
		$w[3] = "Lock";
		return $w;
	}

	public function UpdateResignEmployee()
	{
//		$empResign = Employee::model()->updateAll(array(
//			"status" => 2), "endDate < :endDate AND endDate <> '0000-00-00'", array(
//			":endDate" => date("Y-m-d")));
		$employeeModels = Employee::model()->findAll("endDate < :endDate AND endDate <> '0000-00-00' AND status = 1", array(
			":endDate"=>date("Y-m-d")));

		foreach($employeeModels as $employeeModel)
		{
			$employeeModel->status = 2;
			if($employeeModel->save())
			{
				$emailController = new EmailSend();
				$website = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/Employee/View/" . $employeeModel->employeeId;
				$toEmails = array(
					"kamon.p@daiigroup.com"=>1,
					"daii-its@daiigroup.com"=>1,
					"daiichi-hr@daiigroup.com"=>1,
					"daiichi-administration@daiigroup.com"=>0
				);

				$nameThai = "คุณ" . $employeeModel->fnTh . "  " . $employeeModel->lnTh;
				$nameEng = $employeeModel->fnEn . "  " . $employeeModel->lnEn;
				foreach($toEmails as $toEmail=> $canView)
				{
					$emailController->mailResignEmployee($employeeModel->employeeCode, $nameThai, $nameEng, $employeeModel->position, $employeeModel->company->companyNameTh, $website, $canView, $toEmail, $employeeModel->endDate);
				}
			}
		}
	}

	public function behaviors()
	{
		return array(
			'ERememberFiltersBehavior'=>array(
				'class'=>'application.components.ERememberFiltersBehavior',
				'defaults'=>array(),
				/* optional line */
				'defaultStickOnClear'=>false /* optional line */
			),);
	}

	public function getAllLeaveEmployee($startDate, $endDate, $companyId = NULL, $employeeId = NULL)
	{
		$criteria = new CDbCriteria();
//$criteria->distinct = true;
//$criteria->select = 't.employeeId';
		$criteria->group = 't.employeeId';
		$criteria->join = 'LEFT JOIN document d ON t.employeeId=d.employeeId';
		$criteria->join .= ' LEFT JOIN document_type dt ON d.documentTypeId=dt.documentTypeId';
		$criteria->join .= ' LEFT JOIN `leave` l ON d.documentId=l.documentId';
		$criteria->join .= ' LEFT JOIN leave_item li ON l.leaveId=li.leaveId';
		$criteria->condition = '(li.leaveDate BETWEEN :startDate AND :endDate ) AND dt.documentCodePrefix IN ("RLE","RLO") AND l.status=1  ';
		$criteria->params = array(
			':startDate'=>$startDate,
			':endDate'=>$endDate,);
		if(isset($companyId) && !empty($companyId))
		{
			$criteria->condition .= " AND t.companyId =:companyId";
			$criteria->params[':companyId'] = $companyId;
		}

		if(isset($employeeId) && !empty($employeeId))
		{
			$criteria->condition .= " AND t.employeeId =:employeeId";
			$criteria->params[':employeeId'] = $employeeId;
		}

		$criteria->order = "t.employeeCode ASC";
		return $this->findAll($criteria);
	}

	public function getAllSummaryLeaveEmployee($startDate, $endDate, $companyId = NULL, $employeeId = NULL)
	{
		$criteria = new CDbCriteria();
//$criteria->distinct = true;
		$criteria->select = 't.employeeCode , t.fnTh , t.lnTh , sum(CASE WHEN l.leaveType = 1 THEN  li.leaveTime ELSE 0 END) as leaveSick  ';
		$criteria->select .= " ,sum(CASE WHEN l.leaveType = 2 THEN  li.leaveTime ELSE 0 END) as leavePersonal ";
		$criteria->select .= " ,sum(CASE WHEN l.leaveType = 3 THEN  li.leaveTime ELSE 0 END) as leaveVocation ";
		$criteria->select .= " ,sum(CASE WHEN l.leaveType = 4 THEN  li.leaveTime ELSE 0 END) as leavePregnancy ";
		$criteria->select .= " ,sum(CASE WHEN l.leaveType = 5 THEN  li.leaveTime ELSE 0 END) as leaveOrdinate ";
		$criteria->group = 't.employeeId ';
		$criteria->join = 'LEFT JOIN document d ON t.employeeId=d.employeeId';
		$criteria->join .= ' LEFT JOIN document_type dt ON d.documentTypeId=dt.documentTypeId';
		$criteria->join .= ' LEFT JOIN `leave` l ON d.documentId=l.documentId';
		$criteria->join .= ' LEFT JOIN leave_item li ON l.leaveId=li.leaveId';
		$criteria->condition = '(li.leaveDate BETWEEN :startDate AND :endDate ) AND dt.documentCodePrefix IN ("RLE","RLO") AND l.status=1 AND t.status = 1 AND d.status = 1  ';
		$criteria->params = array(
			':startDate'=>$startDate,
			':endDate'=>$endDate,);
		if(isset($companyId) && !empty($companyId))
		{
			$criteria->condition .= " AND t.companyId =:companyId";
			$criteria->params[':companyId'] = $companyId;
		}

		if(isset($employeeId) && !empty($employeeId))
		{
			$criteria->condition .= " AND t.employeeId =:employeeId";
			$criteria->params[':employeeId'] = $employeeId;
		}

		$criteria->order = "t.employeeCode ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'employeeCode ASC ',),
			'pagination'=>array(
				'pageSize'=>100),));
	}

	public function updateLeaveRemainByLeaveId($leaveId, $creatorId)
	{
		$model = $this->find('employeeId=' . $creatorId);
		$sumLeaveTime = LeaveItem::model()->sumLeaveTimeByLeaveId($leaveId);
		$model->leaveRemain = $model->leaveRemain - $sumLeaveTime;

		return $model->save();
	}

	public function getAllFixTimeEmployee($startDate, $endDate, $companyId)
	{
		$criteria = new CDbCriteria();
//$criteria->distinct = true;
//$criteria->select = 't.employeeId';
		$criteria->group = 't.employeeId';
		$criteria->join = 'LEFT JOIN document d ON t.employeeId=d.employeeId';
		$criteria->join .= ' LEFT JOIN document_type dt ON d.documentTypeId=dt.documentTypeId';
		$criteria->join .= ' LEFT JOIN document_item di ON d.documentId=di.documentId';
		$criteria->condition = '(di.documentItemName BETWEEN :startDate AND :endDate ) AND dt.documentCodePrefix=:documentCodePrefix AND di.status in (2,4)  ';
		$criteria->params = array(
			':startDate'=>$startDate,
			':endDate'=>$endDate,
			'documentCodePrefix'=>'ETI',);
		if(!empty($companyId))
		{
			$criteria->condition .= " AND t.companyId =:companyId";
			$criteria->params[':companyId'] = $companyId;
		}
		$criteria->order = "t.employeeCode ASC";
		return $this->findAll($criteria);
	}

	public function getDocumentFixTimeItem($startDate, $endDate)
	{
		$criteria = new CDbCriteria();
//$criteria->distinct = true;
//$criteria->select = 't.employeeId';
		$criteria->group = 't.employeeId';
		$criteria->join = 'LEFT JOIN document d ON t.employeeId=d.employeeId';
		$criteria->join .= ' LEFT JOIN document_type dt ON d.documentTypeId=dt.documentTypeId';
		$criteria->join .= ' LEFT JOIN document_item di ON d.documentId=di.documentId';
		$criteria->join .= ' LEFT JOIN document_workflow dw ON d.documentId=dw.documentId';
		$criteria->condition = ' dt.documentCodePrefix=:documentCodePrefix AND di.status in (1,2,3,4)  ';
		$criteria->condition .= " AND dw.employeeId = :employeeId  OR d.employeeId = :employeeId2 ";
		$criteria->params = array(
			'documentCodePrefix'=>'ETI',
			':employeeId'=>Yii::app()->user->id,
			':employeeId2'=>Yii::app()->user->id,);
		if(!empty($startDate) AND empty($endDate))
		{
			$criteria->condition .= " AND (di.documentItemName >= :startDate) ";
			$criteria->params[':startDate'] = $startDate;
		}
		else if(empty($startDate) AND ! empty($endDate))
		{
			$criteria->condition .= " AND (di.documentItemName <= :endDate ) ";
			$criteria->params[':endDate'] = $endDate;
		}
		else
		{
//                    $criteria->condition .= " AND (di.documentItemName BETWEEN :startDate AND :endDate ) ";
//                    $criteria->params[':startDate'] = $startDate;
//                    $criteria->params[':endDate'] = $endDate;
//Do Nothing
		}
//
//		if (!empty($companyId))
//		{
//			$criteria->condition .= " AND t.companyId =:companyId";
//			$criteria->params[':companyId'] = $companyId;
//		}
		$criteria->order = "d.documentCode DESC";
		return $this->findAll($criteria);
	}


	public function findAllEmployeeArray()
	{
		$result = array();
		$emp = $this->findAll("status = 1 AND username <> 'tm' ORDER BY fnTh ASC");
		foreach($emp as $item)
		{
			$result[$item->employeeId] = $item->username . " : " . $item->fnTh . " " . $item->lnTh;
		}
		return $result;
    }
	public function isManager($id = NULL)
	{
		$id = isset($id) ? $id : Yii::app()->user->id;

		$model = $this->find('employeeId=:employeeId AND isManager=1', array(
			':employeeId'=>$id));

		return ($model !== NULL) ? true : false;

	}

}
