<?php

/**
 * This is the model class for table "employee_info".
 *
 * The followings are the available columns in table 'employee_info':
 * @property string $id
 * @property string $employeeId
 * @property string $appliedPosition
 * @property string $appliedSalary
 * @property string $address
 * @property string $tumbol
 * @property string $aumper
 * @property string $province
 * @property string $postcode
 * @property string $otherEmail
 * @property integer $livingWith
 * @property string $birthDate
 * @property string $race
 * @property string $nationality
 * @property string $religion
 * @property string $height
 * @property string $weight
 * @property integer $militaryStatus
 * @property integer $maritalStatus
 * @property string $dadName
 * @property string $dadAge
 * @property string $dadOccupation
 * @property string $momName
 * @property string $momAge
 * @property string $momOccupation
 * @property string $husbandName
 * @property string $husbandWork
 * @property string $husbandPosition
 * @property integer $noOfChildren
 * @property string $noOfMemberFamily
 * @property string $noOfMaleMemberFamily
 * @property string $noOfFemaleMemberFamily
 * @property string $youAreTheChildOfTheFamily
 * @property string $EducationHighest
 * @property string $EducationHighestInstitution
 * @property string $EducationHighestMajor
 * @property string $EducationHighestYearEnd
 * @property string $EducationHighSchool
 * @property string $EducationVocational
 * @property string $EducationDiploma
 * @property string $EducationBechelorDegree
 * @property string $EducationOther
 * @property string $WorkExp1StartEnd
 * @property string $WorkExp1At
 * @property string $WorkExp1Position
 * @property string $WorkExp1ReasonLeaving
 * @property string $WorkExp1SalaryStartEnd
 * @property string $WorkExp2StartEnd
 * @property string $WorkExp2At
 * @property string $WorkExp2Position
 * @property string $WorkExp2ReasonLeaving
 * @property string $WorkExp2SalaryStartEnd
 * @property string $WorkExp3StartEnd
 * @property string $WorkExp3At
 * @property string $WorkExp3Position
 * @property string $WorkExp3ReasonLeaving
 * @property string $WorkExp3SalaryStartEnd
 * @property string $WorkExp4StartEnd
 * @property string $WorkExp4At
 * @property string $WorkExp4Position
 * @property string $WorkExp4ReasonLeaving
 * @property string $WorkExp4SalaryStartEnd
 * @property string $WorkExp5StartEnd
 * @property string $WorkExp5At
 * @property string $WorkExp5Position
 * @property string $WorkExp5ReasonLeaving
 * @property string $WorkExp5SalaryStartEnd
 * @property integer $typing
 * @property string $speedTypingTh
 * @property string $speedTypingEn
 * @property string $computerSkill
 * @property integer $driving
 * @property string $drivingLicenseNo
 * @property integer $officeMachine
 * @property string $hobbies
 * @property string $favouriteSport
 * @property string $spacialKnowledge
 * @property string $other
 * @property integer $canWorkUpCountry
 * @property string $personAtEmergencyName
 * @property string $personAtEmergencyRelated
 * @property string $personAtEmergencyAddress
 * @property string $personAtEmergencyTel
 * @property string $sourceOfJobInfo
 * @property integer $hasBeenSeriouslyOrContractedSick
 * @property string $whatSick
 * @property integer $everAppliedBefore
 * @property string $appliedWhen
 * @property integer $langThSpeaking
 * @property integer $langThWriting
 * @property integer $langThReading
 * @property integer $langEnSpeaking
 * @property integer $langEnWriting
 * @property integer $langEnReading
 * @property string $langOther
 * @property string $uKnowEmployeeInOffice
 * @property string $NameAddressOfRelatedPeople1
 * @property string $NameAddressOfRelatedPeople2
 * @property string $introductionOfU
 */
class EmployeeInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmployeeInfo the static model class
	 */

	const LANG_LEVEL_GOOD = 1;
	const LANG_LEVEL_FAIR = 2;
	const LANG_LEVEL_POOR = 3;

	// Typeing Status
	const STATUS_YES = 1;
	const STATUS_NO = 2;
	// Typeing Status
	//Application Status
	const STATUS_APP_CREATE = 0; //สร้างใบสมัคร
	const STATUS_APP_INTERVIEW = 1; //นัดสัมภาษณ์
	const STATUS_APP_INTERVIEW_DELAY = 2; //เลื่อนการสัมภาษณ์
	const STATUS_APP_ESTIMATE = 3; //ประเมิณแล้ว
	const STATUS_APP_CEO = 4; //นายประเมิน
	const STATUS_APP_CEO_DELAY = 5; //นายเลื่อนสัมภาษณ์
	const STATUS_APP_CEO_ESTIMATE = 6; //นายประเมิน
	const STATUS_APP_HOLDING = 7; //เก็บไว้พิจารณา
	const STATUS_APP_APPROVE = 8; //รับเข้าทำงาน
	const STATUS_APP_REJECT = 9; //ไม่ผ่านเลยทิ้งไป
	// Typeing Status
	const USED_TO_YES = 1;
	const USED_TO_NO = 2;
	const LIVING_WITH_PARENT = 1;
	const LIVING_WITH_OWN_HOME = 2;
	const LIVING_WITH_HIRED_HOUSE = 3;
	const LIVING_WITH_HOSTEL = 4;
	const MILITARY_STATUS_EXEMPTED = 1;
	const MILITARY_STATUS_SERVED = 2;
	const MILITARY_STATUS_NOT_YET_SERVED = 3;
	const MARITAL_STATUS_SINGLE = 1;
	const MARITAL_STATUS_MARRIED = 2;
	const MARITAL_STATUS_WIDOWED = 3;
	const MARITAL_STATUS_SEPARATED = 4;

	public $accept;
	public $citizenFlag;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employee_info';
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
				'accept, prefix, gender, fnTh, lnTh, fnEn, lnEn, citizenId, mobile, appliedPosition, appliedSalary, address, tumbol, aumper, province, postcode, livingWith, birthDate, race, nationality, religion, height, weight, militaryStatus, maritalStatus, dadName, dadAge, dadOccupation, momName, momAge, momOccupation, noOfMemberFamily, noOfMaleMemberFamily, noOfFemaleMemberFamily, youAreTheChildOfTheFamily, EducationHighest, EducationHighestInstitution, EducationHighestMajor, EducationHighestYearEnd, typing, speedTypingTh, speedTypingEn, driving, officeMachine, canWorkUpCountry, hasBeenSeriouslyOrContractedSick, everAppliedBefore, langThSpeaking, langThWriting, langThReading, langEnSpeaking, langEnWriting, langEnReading, NameAddressOfRelatedPeople1, introductionOfU, personAtEmergencyName, personAtEmergencyRelated, personAtEmergencyAddress, personAtEmergencyTel, ',
				'required'),
			array(
				'livingWith, militaryStatus, maritalStatus, noOfChildren, typing, driving, canWorkUpCountry, hasBeenSeriouslyOrContractedSick, everAppliedBefore, langThSpeaking, langThWriting, langThReading, langEnSpeaking, langEnWriting, langEnReading',
				'numerical',
				'integerOnly' => true),
			array(
				'employeeId, postcode, personAtEmergencyTel, nickName',
				'length',
				'max' => 20),
			array(
				'appliedPosition, otherEmail, dadName, dadOccupation, momName, momOccupation, husbandName, husbandWork, husbandPosition, EducationHighest, EducationHighestInstitution, EducationHighestMajor, EducationHighSchool, EducationVocational, EducationDiploma, EducationBechelorDegree, EducationOther, WorkExp1StartEnd, WorkExp1At, WorkExp1Position, WorkExp1SalaryStartEnd, WorkExp2StartEnd, WorkExp2At, WorkExp2Position, WorkExp2SalaryStartEnd, WorkExp3StartEnd, WorkExp3At, WorkExp3Position, WorkExp3SalaryStartEnd, WorkExp4StartEnd, WorkExp4At, WorkExp4Position, WorkExp4SalaryStartEnd, WorkExp5StartEnd, WorkExp5At, WorkExp5Position, WorkExp5SalaryStartEnd, personAtEmergencyName, sourceOfJobInfo, uKnowEmployeeInOffice',
				'length',
				'max' => 200),
			array(
				'appliedSalary',
				'length',
				'max' => 16),
			array(
				'address, personAtEmergencyAddress',
				'length',
				'max' => 1000),
			array(
				'tumbol, aumper, province, race, nationality, religion, personAtEmergencyRelated',
				'length',
				'max' => 100),
			array(
				'birthDate, height, weight, dadAge, momAge, noOfMemberFamily, noOfMaleMemberFamily, noOfFemaleMemberFamily, youAreTheChildOfTheFamily',
				'length',
				'max' => 10),
			array(
				'EducationHighestYearEnd, speedTypingTh, speedTypingEn, computerSkill, drivingLicenseNo, appliedWhen',
				'length',
				'max' => 45),
			array(
				'WorkExp1ReasonLeaving, WorkExp2ReasonLeaving, WorkExp3ReasonLeaving, WorkExp4ReasonLeaving, WorkExp5ReasonLeaving, langOther',
				'length',
				'max' => 500),
			array(
				'hobbies, favouriteSport, spacialKnowledge, other, whatSick',
				'length',
				'max' => 300),
			array(
				'NameAddressOfRelatedPeople1, NameAddressOfRelatedPeople2, introductionOfU',
				'length',
				'max' => 2000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'id, employeeId, appliedPosition, appliedSalary, address, tumbol, aumper, province, postcode, otherEmail, livingWith, birthDate, race, nationality, religion, height, weight, militaryStatus, maritalStatus, dadName, dadAge, dadOccupation, momName, momAge, momOccupation, husbandName, husbandWork, husbandPosition, noOfChildren, noOfMemberFamily, noOfMaleMemberFamily, noOfFemaleMemberFamily, youAreTheChildOfTheFamily, EducationHighest, EducationHighestInstitution, EducationHighestMajor, EducationHighestYearEnd, EducationHighSchool, EducationVocational, EducationDiploma, EducationBechelorDegree, EducationOther, WorkExp1StartEnd, WorkExp1At, WorkExp1Position, WorkExp1ReasonLeaving, WorkExp1SalaryStartEnd, WorkExp2StartEnd, WorkExp2At, WorkExp2Position, WorkExp2ReasonLeaving, WorkExp2SalaryStartEnd, WorkExp3StartEnd, WorkExp3At, WorkExp3Position, WorkExp3ReasonLeaving, WorkExp3SalaryStartEnd, WorkExp4StartEnd, WorkExp4At, WorkExp4Position, WorkExp4ReasonLeaving, WorkExp4SalaryStartEnd, WorkExp5StartEnd, WorkExp5At, WorkExp5Position, WorkExp5ReasonLeaving, WorkExp5SalaryStartEnd, typing, speedTypingTh, speedTypingEn, computerSkill, driving, drivingLicenseNo, officeMachine, hobbies, favouriteSport, spacialKnowledge, other, canWorkUpCountry, personAtEmergencyName, personAtEmergencyRelated, personAtEmergencyAddress, personAtEmergencyTel, sourceOfJobInfo, hasBeenSeriouslyOrContractedSick, whatSick, everAppliedBefore, appliedWhen, langThSpeaking, langThWriting, langThReading, langEnSpeaking, langEnWriting, langEnReading, langOther, uKnowEmployeeInOffice, NameAddressOfRelatedPeople1, NameAddressOfRelatedPeople2, introductionOfU',
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
			'applicationInterview' => array(
				self::BELONGS_TO,
				'ApplicationInterview',
				array(
					'id' => 'applicationId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'accept' => 'ข้าพเจ้าขอรับรองว่า ข้อความดังกล่าวทั้งหมดในใบสมัครนี้เป็นความจริงทุกประการ หลังจากบริษัทจ้างเข้ามาทำงานแล้วปรากฎว่าข้อความในใบสมัครงาน เอกสารที่นำมาแสดง หรือรายละเอียดที่ให้ไว้ไม่เป็นความจริง บริษัทฯ มีสิทธิ์ที่จะเลิกจ้างข้าพเจ้าได้โดยไม่ต้องจ่ายเงินชดเชยหรือค่าเสียหายใดๆ ทั้งสิ้น',
			'prefix' => 'คำนำหน้า',
			'gender' => 'เพศ',
			'fnTh' => 'ชื่อ (ไทย)',
			'lnTh' => 'นามสกุล (ไทย)',
			'fnEn' => 'First Name',
			'lnEn' => 'Last Name',
			'nickName' => 'ชื่อเล่น',
			'citizenId' => 'เลขที่บัตรประจำตัวประชาชน',
			'mobile' => 'โทรศัพท์มือถือ',
			'appliedPosition' => 'ตำแหน่งที่ต้องการ',
			'appliedSalary' => 'เงินเดือนที่ต้องการ',
			'address' => 'ที่อยู่',
			'tumbol' => 'แขวง/ตำบล',
			'aumper' => 'เขต/อำเภอ',
			'province' => 'จังหวัด',
			'postcode' => 'รหัสไปรษณีย์',
			'otherEmail' => 'Email',
			'livingWith' => 'อาศัยอยู่กับ',
			'birthDate' => 'วัน เดือน ปีเกิด',
			'race' => 'เชื้อชาติ',
			'nationality' => 'สัญชาติ',
			'religion' => 'ศาสนา',
			'height' => 'ความสูง (ซ.ม.)',
			'weight' => 'น้ำหนัก (ก.ก.)',
			'militaryStatus' => 'สถานะทางทหาร',
			'maritalStatus' => 'สถานภาพ',
			'dadName' => 'ชื่อบิดา',
			'dadAge' => 'อายุบิดา',
			'dadOccupation' => 'อาชีพบิดา',
			'momName' => 'ชื่อมารดา',
			'momAge' => 'อายุมารดา',
			'momOccupation' => 'อาชีพมารดา',
			'husbandName' => 'ชื่อสามี / ภรรยา',
			'husbandWork' => 'สถานที่ทำงานสามี / ภรรยา',
			'husbandPosition' => 'ตำแหน่งสามี / ภรรยา',
			'noOfChildren' => 'จำนวนบุตร',
			'noOfMemberFamily' => 'จำนวนพี่น้อง',
			'noOfMaleMemberFamily' => 'จำนวนพี่น้องผู้ชาย',
			'noOfFemaleMemberFamily' => 'จำนวนพี่น้องผู้หญิง',
			'youAreTheChildOfTheFamily' => 'เป็นบุตรคนที่',
			'EducationHighest' => 'ระดับการศึกษาสูงสุด',
			'EducationHighestInstitution' => 'สถาบัน',
			'EducationHighestMajor' => 'สาขาวิชา',
			'EducationHighestYearEnd' => 'จบปีการศึกษา',
			'EducationHighSchool' => 'มัธยมศึกษาตอนปลาย',
			'EducationVocational' => 'ปวช.',
			'EducationDiploma' => 'ปวท./ปวส.',
			'EducationBechelorDegree' => 'ปริญญาตรี',
			'EducationOther' => 'อื่นๆ ระบุ',
			'WorkExp1StartEnd' => 'ระยะเวลา เริ่ม-ถึง',
			'WorkExp1At' => 'สถานที่ทำงาน',
			'WorkExp1Position' => 'ตำแหน่ง-แผนก',
			'WorkExp1ReasonLeaving' => 'เหตุที่ออก',
			'WorkExp1SalaryStartEnd' => 'เงินเดือนเริ่มต้น-สุดท้าย',
			'WorkExp2StartEnd' => 'Work Exp2 Start End',
			'WorkExp2At' => 'Work Exp2 At',
			'WorkExp2Position' => 'Work Exp2 Position',
			'WorkExp2ReasonLeaving' => 'Work Exp2 Reason Leaving',
			'WorkExp2SalaryStartEnd' => 'Work Exp2 Salary Start End',
			'WorkExp3StartEnd' => 'Work Exp3 Start End',
			'WorkExp3At' => 'Work Exp3 At',
			'WorkExp3Position' => 'Work Exp3 Position',
			'WorkExp3ReasonLeaving' => 'Work Exp3 Reason Leaving',
			'WorkExp3SalaryStartEnd' => 'Work Exp3 Salary Start End',
			'WorkExp4StartEnd' => 'Work Exp4 Start End',
			'WorkExp4At' => 'Work Exp4 At',
			'WorkExp4Position' => 'Work Exp4 Position',
			'WorkExp4ReasonLeaving' => 'Work Exp4 Reason Leaving',
			'WorkExp4SalaryStartEnd' => 'Work Exp4 Salary Start End',
			'WorkExp5StartEnd' => 'Work Exp5 Start End',
			'WorkExp5At' => 'Work Exp5 At',
			'WorkExp5Position' => 'Work Exp5 Position',
			'WorkExp5ReasonLeaving' => 'Work Exp5 Reason Leaving',
			'WorkExp5SalaryStartEnd' => 'Work Exp5 Salary Start End',
			'typing' => 'พิมพ์ดีด',
			'speedTypingTh' => 'พิมพ์ดีดภาษาไทย (คำ/นาที)',
			'speedTypingEn' => 'พิมพ์ดีดภาษาอังกฤษ (คำ/นาที)',
			'computerSkill' => 'ทักษะทางคอมพิวเตอร์',
			'driving' => 'สามารถขับรถ',
			'drivingLicenseNo' => 'เลขที่ใบขับขี่',
			'officeMachine' => 'ความสามารถในการใช้อุปกรณ์สำนักงาน',
			'hobbies' => 'งานอดิเรก',
			'favouriteSport' => 'กีฬาที่ชอบ',
			'spacialKnowledge' => 'ความสามารถพิเศษ',
			'other' => 'อื่นๆ',
			'canWorkUpCountry' => 'สามารถทำงานต่างจังหวัด',
			'personAtEmergencyName' => 'ชื่อผู้ติดต่อฉุกเฉิน',
			'personAtEmergencyRelated' => 'ความสัมพันธ์',
			'personAtEmergencyAddress' => 'ที่อยู่',
			'personAtEmergencyTel' => 'เบอร์โทรศัพท์',
			'sourceOfJobInfo' => 'ทราบข่าวการรับสมัครจาก',
			'hasBeenSeriouslyOrContractedSick' => 'ท่านเคยป่วยหนักและเป็นโรคติดต่อร้ายแรงมาก่อนหรือไม่',
			'whatSick' => 'ถ้าเคยโปรดระบุ',
			'everAppliedBefore' => 'ท่านเคยสมัครงานกับบริษัทฯ นี้มาก่อนหรือไม่',
			'appliedWhen' => 'ถ้าเคย เมื่อไร',
			'langThSpeaking' => 'Lang Th Speaking',
			'langThWriting' => 'Lang Th Writing',
			'langThReading' => 'Lang Th Reading',
			'langEnSpeaking' => 'Lang En Speaking',
			'langEnWriting' => 'Lang En Writing',
			'langEnReading' => 'Lang En Reading',
			'langTh' => 'ภาษาไทย',
			'langEn' => 'ภาษาอังกฤษ',
			'langOther' => 'ภาษาอื่นๆ',
			'uKnowEmployeeInOffice' => 'ชื่อญาติ / เพื่อน',
			'NameAddressOfRelatedPeople1' => 'ชื่อ ที่อยู่ โทรศัพท์ และอาชีพ',
			'NameAddressOfRelatedPeople2' => 'ชื่อ ที่อยู่ โทรศัพท์ และอาชีพ',
			'introductionOfU' => 'Introduction Of U',
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

		$criteria->compare('id', $this->id, true);
		$criteria->compare('employeeId', $this->employeeId, true);
		$criteria->compare('appliedPosition', $this->appliedPosition, true);
		$criteria->compare('appliedSalary', $this->appliedSalary, true);
		$criteria->compare('address', $this->address, true);
		$criteria->compare('tumbol', $this->tumbol, true);
		$criteria->compare('aumper', $this->aumper, true);
		$criteria->compare('province', $this->province, true);
		$criteria->compare('postcode', $this->postcode, true);
		$criteria->compare('otherEmail', $this->otherEmail, true);
		$criteria->compare('livingWith', $this->livingWith);
		$criteria->compare('birthDate', $this->birthDate, true);
		$criteria->compare('race', $this->race, true);
		$criteria->compare('nationality', $this->nationality, true);
		$criteria->compare('religion', $this->religion, true);
		$criteria->compare('height', $this->height, true);
		$criteria->compare('weight', $this->weight, true);
		$criteria->compare('militaryStatus', $this->militaryStatus);
		$criteria->compare('maritalStatus', $this->maritalStatus);
		$criteria->compare('dadName', $this->dadName, true);
		$criteria->compare('dadAge', $this->dadAge, true);
		$criteria->compare('dadOccupation', $this->dadOccupation, true);
		$criteria->compare('momName', $this->momName, true);
		$criteria->compare('momAge', $this->momAge, true);
		$criteria->compare('momOccupation', $this->momOccupation, true);
		$criteria->compare('husbandName', $this->husbandName, true);
		$criteria->compare('husbandWork', $this->husbandWork, true);
		$criteria->compare('husbandPosition', $this->husbandPosition, true);
		$criteria->compare('noOfChildren', $this->noOfChildren);
		$criteria->compare('noOfMemberFamily', $this->noOfMemberFamily, true);
		$criteria->compare('noOfMaleMemberFamily', $this->noOfMaleMemberFamily, true);
		$criteria->compare('noOfFemaleMemberFamily', $this->noOfFemaleMemberFamily, true);
		$criteria->compare('youAreTheChildOfTheFamily', $this->youAreTheChildOfTheFamily, true);
		$criteria->compare('EducationHighest', $this->EducationHighest, true);
		$criteria->compare('EducationHighestInstitution', $this->EducationHighestInstitution, true);
		$criteria->compare('EducationHighestMajor', $this->EducationHighestMajor, true);
		$criteria->compare('EducationHighestYearEnd', $this->EducationHighestYearEnd, true);
		$criteria->compare('EducationHighSchool', $this->EducationHighSchool, true);
		$criteria->compare('EducationVocational', $this->EducationVocational, true);
		$criteria->compare('EducationDiploma', $this->EducationDiploma, true);
		$criteria->compare('EducationBechelorDegree', $this->EducationBechelorDegree, true);
		$criteria->compare('EducationOther', $this->EducationOther, true);
		$criteria->compare('WorkExp1StartEnd', $this->WorkExp1StartEnd, true);
		$criteria->compare('WorkExp1At', $this->WorkExp1At, true);
		$criteria->compare('WorkExp1Position', $this->WorkExp1Position, true);
		$criteria->compare('WorkExp1ReasonLeaving', $this->WorkExp1ReasonLeaving, true);
		$criteria->compare('WorkExp1SalaryStartEnd', $this->WorkExp1SalaryStartEnd, true);
		$criteria->compare('WorkExp2StartEnd', $this->WorkExp2StartEnd, true);
		$criteria->compare('WorkExp2At', $this->WorkExp2At, true);
		$criteria->compare('WorkExp2Position', $this->WorkExp2Position, true);
		$criteria->compare('WorkExp2ReasonLeaving', $this->WorkExp2ReasonLeaving, true);
		$criteria->compare('WorkExp2SalaryStartEnd', $this->WorkExp2SalaryStartEnd, true);
		$criteria->compare('WorkExp3StartEnd', $this->WorkExp3StartEnd, true);
		$criteria->compare('WorkExp3At', $this->WorkExp3At, true);
		$criteria->compare('WorkExp3Position', $this->WorkExp3Position, true);
		$criteria->compare('WorkExp3ReasonLeaving', $this->WorkExp3ReasonLeaving, true);
		$criteria->compare('WorkExp3SalaryStartEnd', $this->WorkExp3SalaryStartEnd, true);
		$criteria->compare('WorkExp4StartEnd', $this->WorkExp4StartEnd, true);
		$criteria->compare('WorkExp4At', $this->WorkExp4At, true);
		$criteria->compare('WorkExp4Position', $this->WorkExp4Position, true);
		$criteria->compare('WorkExp4ReasonLeaving', $this->WorkExp4ReasonLeaving, true);
		$criteria->compare('WorkExp4SalaryStartEnd', $this->WorkExp4SalaryStartEnd, true);
		$criteria->compare('WorkExp5StartEnd', $this->WorkExp5StartEnd, true);
		$criteria->compare('WorkExp5At', $this->WorkExp5At, true);
		$criteria->compare('WorkExp5Position', $this->WorkExp5Position, true);
		$criteria->compare('WorkExp5ReasonLeaving', $this->WorkExp5ReasonLeaving, true);
		$criteria->compare('WorkExp5SalaryStartEnd', $this->WorkExp5SalaryStartEnd, true);
		$criteria->compare('typing', $this->typing);
		$criteria->compare('speedTypingTh', $this->speedTypingTh, true);
		$criteria->compare('speedTypingEn', $this->speedTypingEn, true);
		$criteria->compare('computerSkill', $this->computerSkill, true);
		$criteria->compare('driving', $this->driving);
		$criteria->compare('drivingLicenseNo', $this->drivingLicenseNo, true);
		$criteria->compare('officeMachine', $this->officeMachine);
		$criteria->compare('hobbies', $this->hobbies, true);
		$criteria->compare('favouriteSport', $this->favouriteSport, true);
		$criteria->compare('spacialKnowledge', $this->spacialKnowledge, true);
		$criteria->compare('other', $this->other, true);
		$criteria->compare('canWorkUpCountry', $this->canWorkUpCountry);
		$criteria->compare('personAtEmergencyName', $this->personAtEmergencyName, true);
		$criteria->compare('personAtEmergencyRelated', $this->personAtEmergencyRelated, true);
		$criteria->compare('personAtEmergencyAddress', $this->personAtEmergencyAddress, true);
		$criteria->compare('personAtEmergencyTel', $this->personAtEmergencyTel, true);
		$criteria->compare('sourceOfJobInfo', $this->sourceOfJobInfo, true);
		$criteria->compare('hasBeenSeriouslyOrContractedSick', $this->hasBeenSeriouslyOrContractedSick);
		$criteria->compare('whatSick', $this->whatSick, true);
		$criteria->compare('everAppliedBefore', $this->everAppliedBefore);
		$criteria->compare('appliedWhen', $this->appliedWhen, true);
		$criteria->compare('langThSpeaking', $this->langThSpeaking);
		$criteria->compare('langThWriting', $this->langThWriting);
		$criteria->compare('langThReading', $this->langThReading);
		$criteria->compare('langEnSpeaking', $this->langEnSpeaking);
		$criteria->compare('langEnWriting', $this->langEnWriting);
		$criteria->compare('langEnReading', $this->langEnReading);
		$criteria->compare('langOther', $this->langOther, true);
		$criteria->compare('uKnowEmployeeInOffice', $this->uKnowEmployeeInOffice, true);
		$criteria->compare('NameAddressOfRelatedPeople1', $this->NameAddressOfRelatedPeople1, true);
		$criteria->compare('NameAddressOfRelatedPeople2', $this->NameAddressOfRelatedPeople2, true);
		$criteria->compare('introductionOfU', $this->introductionOfU, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	//Custom
	public function getEmployeeInfoLangLevel()
	{
		return array(
			self::LANG_LEVEL_GOOD => 'ดี',
			self::LANG_LEVEL_FAIR => 'ปานกลาง',
			self::LANG_LEVEL_POOR => 'พอใช้',
		);
	}

	public function langLevelText($level)
	{
		$langLevel = $this->employeeInfoLangLevel;

		return $langLevel[$level];
	}

	public function getEmployeeInfoStatus()
	{
		return array(
			self::STATUS_YES => 'ได้',
			self::STATUS_NO => 'ไม่ได้',
		);
	}

	public function statusText($status)
	{
		$s = $this->employeeInfoStatus;
		return $s[$status];
	}

	public function getEmployeeInfoUsedTo()
	{
		return array(
			self::USED_TO_YES => 'เคย',
			self::USED_TO_NO => 'ไม่เคย',
		);
	}

	public function usedToText($useTo)
	{
		$u = $this->employeeInfoUsedTo;
		return $u[$useTo];
	}

	public function getEmployeeInfoLivingWith()
	{
		return array(
			self::LIVING_WITH_PARENT => 'ครอบครัว',
			self::LIVING_WITH_OWN_HOME => 'บ้านตัวเอง',
			self::LIVING_WITH_HIRED_HOUSE => 'บ้านเช่า',
			self::LIVING_WITH_HOSTEL => 'หอพัก',
		);
	}

	public function liveingWithText($livingWith)
	{
		$l = $this->employeeInfoLivingWith;
		return $l[$livingWith];
	}

	public function getEmployeeInfoMilitaryStatus()
	{
		return array(
			self::MILITARY_STATUS_EXEMPTED => 'ได้รับการยกเว้น',
			self::MILITARY_STATUS_SERVED => 'ปลดเป็นทหารกองหนุน',
			self::MILITARY_STATUS_NOT_YET_SERVED => 'ยังไม่ได้รับการเกณฑ์',
		);
	}

	public function militaryStatusText($militaryStatus)
	{
		$m = $this->employeeInfoMilitaryStatus;
		return $m[$militaryStatus];
	}

	public function getEmployeeInfoMaritalStatus()
	{
		return array(
			self::MARITAL_STATUS_SINGLE => 'โสด',
			self::MARITAL_STATUS_MARRIED => 'แต่งงาน',
			self::MARITAL_STATUS_WIDOWED => 'หย่า',
			self::MARITAL_STATUS_SEPARATED => 'แยกกัน',
		);
	}

	public function maritalStatusText($maritalStatus)
	{
		$m = $this->employeeInfoMaritalStatus;
		return $m[$maritalStatus];
	}

	public function checkIsExistingCitizenId($citizenId)
	{
		$existing = $this->find("citizenId =:citizenId", array(
			":citizenId" => $citizenId));
		if (count($existing) > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	// APPLICATION AND JOB INTERVIEW
	public function findJobInterviewList()
	{
		$criteria = new CDbCriteria();
		$criteria->compare("t.status", 0);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	// APPLICATION AND JOB INTERVIEW
}