<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "employee_info".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $employeeId
 * @property integer $prefix
 * @property integer $gender
 * @property string $fnTh
 * @property string $lnTh
 * @property string $fnEn
 * @property string $lnEn
 * @property string $nickName
 * @property string $citizenId
 * @property string $mobile
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
 * @property integer $dadAge
 * @property string $dadOccupation
 * @property string $momName
 * @property integer $momAge
 * @property string $momOccupation
 * @property string $husbandName
 * @property string $husbandWork
 * @property string $husbandPosition
 * @property integer $noOfChildren
 * @property integer $noOfMemberFamily
 * @property integer $noOfMaleMemberFamily
 * @property integer $noOfFemaleMemberFamily
 * @property integer $youAreTheChildOfTheFamily
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
 * @property string $officeMachine
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
class EmployeeInfoMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'employeeId', 'prefix', 'gender', 'livingWith', 'militaryStatus', 'maritalStatus', 'dadAge', 'momAge', 'noOfChildren', 'noOfMemberFamily', 'noOfMaleMemberFamily', 'noOfFemaleMemberFamily', 'youAreTheChildOfTheFamily', 'typing', 'driving', 'canWorkUpCountry', 'hasBeenSeriouslyOrContractedSick', 'everAppliedBefore', 'langThSpeaking', 'langThWriting', 'langThReading', 'langEnSpeaking', 'langEnWriting', 'langEnReading'], 'integer'],
            [['employeeId', 'prefix', 'gender', 'fnTh', 'lnTh', 'fnEn', 'lnEn', 'nickName', 'citizenId', 'mobile', 'appliedPosition', 'appliedSalary', 'address', 'tumbol', 'aumper', 'province', 'postcode', 'livingWith', 'birthDate', 'race', 'nationality', 'religion', 'height', 'weight', 'militaryStatus', 'maritalStatus', 'dadName', 'dadAge', 'dadOccupation', 'momName', 'momAge', 'momOccupation', 'noOfMemberFamily', 'noOfMaleMemberFamily', 'noOfFemaleMemberFamily', 'youAreTheChildOfTheFamily', 'EducationHighest', 'EducationHighestInstitution', 'EducationHighestMajor', 'EducationHighestYearEnd', 'typing', 'speedTypingTh', 'speedTypingEn', 'driving', 'officeMachine', 'canWorkUpCountry', 'hasBeenSeriouslyOrContractedSick', 'everAppliedBefore', 'langThSpeaking', 'langThWriting', 'langThReading', 'langEnSpeaking', 'langEnWriting', 'langEnReading', 'NameAddressOfRelatedPeople1', 'introductionOfU'], 'required'],
            [['birthDate'], 'safe'],
            [['WorkExp4ReasonLeaving', 'introductionOfU'], 'string'],
            [['fnTh', 'fnEn', 'langOther'], 'string', 'max' => 80],
            [['lnTh', 'lnEn', 'otherEmail', 'officeMachine'], 'string', 'max' => 120],
            [['nickName', 'EducationHighestYearEnd', 'speedTypingTh', 'speedTypingEn', 'computerSkill', 'drivingLicenseNo', 'appliedWhen'], 'string', 'max' => 45],
            [['citizenId', 'postcode', 'personAtEmergencyTel'], 'string', 'max' => 20],
            [['mobile', 'appliedSalary', 'tumbol', 'aumper', 'race', 'nationality', 'religion', 'WorkExp1StartEnd', 'WorkExp1SalaryStartEnd', 'WorkExp2StartEnd', 'WorkExp2SalaryStartEnd', 'WorkExp3StartEnd', 'WorkExp3SalaryStartEnd', 'WorkExp4StartEnd', 'WorkExp4SalaryStartEnd', 'WorkExp5StartEnd', 'WorkExp5SalaryStartEnd', 'personAtEmergencyRelated'], 'string', 'max' => 40],
            [['appliedPosition', 'address', 'dadName', 'dadOccupation', 'momName', 'momOccupation', 'husbandName', 'husbandWork', 'EducationHighest', 'EducationHighestInstitution', 'EducationHighestMajor', 'EducationHighSchool', 'EducationVocational', 'EducationDiploma', 'EducationBechelorDegree', 'EducationOther', 'WorkExp1At', 'WorkExp1ReasonLeaving', 'WorkExp2At', 'WorkExp2ReasonLeaving', 'WorkExp3At', 'WorkExp3ReasonLeaving', 'WorkExp4At', 'WorkExp5At', 'WorkExp5ReasonLeaving', 'personAtEmergencyName', 'personAtEmergencyAddress', 'uKnowEmployeeInOffice'], 'string', 'max' => 200],
            [['province'], 'string', 'max' => 60],
            [['height', 'weight'], 'string', 'max' => 10],
            [['husbandPosition', 'WorkExp1Position', 'WorkExp2Position', 'WorkExp3Position', 'WorkExp4Position', 'WorkExp5Position', 'sourceOfJobInfo', 'whatSick'], 'string', 'max' => 100],
            [['hobbies', 'favouriteSport', 'spacialKnowledge', 'other'], 'string', 'max' => 300],
            [['NameAddressOfRelatedPeople1', 'NameAddressOfRelatedPeople2'], 'string', 'max' => 400]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'employeeId' => 'Employee ID',
            'prefix' => 'Prefix',
            'gender' => 'Gender',
            'fnTh' => 'Fn Th',
            'lnTh' => 'Ln Th',
            'fnEn' => 'Fn En',
            'lnEn' => 'Ln En',
            'nickName' => 'Nick Name',
            'citizenId' => 'Citizen ID',
            'mobile' => 'Mobile',
            'appliedPosition' => 'Applied Position',
            'appliedSalary' => 'Applied Salary',
            'address' => 'Address',
            'tumbol' => 'Tumbol',
            'aumper' => 'Aumper',
            'province' => 'Province',
            'postcode' => 'Postcode',
            'otherEmail' => 'Other Email',
            'livingWith' => 'Living With',
            'birthDate' => 'Birth Date',
            'race' => 'Race',
            'nationality' => 'Nationality',
            'religion' => 'Religion',
            'height' => 'Height',
            'weight' => 'Weight',
            'militaryStatus' => 'Military Status',
            'maritalStatus' => 'Marital Status',
            'dadName' => 'Dad Name',
            'dadAge' => 'Dad Age',
            'dadOccupation' => 'Dad Occupation',
            'momName' => 'Mom Name',
            'momAge' => 'Mom Age',
            'momOccupation' => 'Mom Occupation',
            'husbandName' => 'Husband Name',
            'husbandWork' => 'Husband Work',
            'husbandPosition' => 'Husband Position',
            'noOfChildren' => 'No Of Children',
            'noOfMemberFamily' => 'No Of Member Family',
            'noOfMaleMemberFamily' => 'No Of Male Member Family',
            'noOfFemaleMemberFamily' => 'No Of Female Member Family',
            'youAreTheChildOfTheFamily' => 'You Are The Child Of The Family',
            'EducationHighest' => 'Education Highest',
            'EducationHighestInstitution' => 'Education Highest Institution',
            'EducationHighestMajor' => 'Education Highest Major',
            'EducationHighestYearEnd' => 'Education Highest Year End',
            'EducationHighSchool' => 'Education High School',
            'EducationVocational' => 'Education Vocational',
            'EducationDiploma' => 'Education Diploma',
            'EducationBechelorDegree' => 'Education Bechelor Degree',
            'EducationOther' => 'Education Other',
            'WorkExp1StartEnd' => 'Work Exp1 Start End',
            'WorkExp1At' => 'Work Exp1 At',
            'WorkExp1Position' => 'Work Exp1 Position',
            'WorkExp1ReasonLeaving' => 'Work Exp1 Reason Leaving',
            'WorkExp1SalaryStartEnd' => 'Work Exp1 Salary Start End',
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
            'typing' => 'Typing',
            'speedTypingTh' => 'Speed Typing Th',
            'speedTypingEn' => 'Speed Typing En',
            'computerSkill' => 'Computer Skill',
            'driving' => 'Driving',
            'drivingLicenseNo' => 'Driving License No',
            'officeMachine' => 'Office Machine',
            'hobbies' => 'Hobbies',
            'favouriteSport' => 'Favourite Sport',
            'spacialKnowledge' => 'Spacial Knowledge',
            'other' => 'Other',
            'canWorkUpCountry' => 'Can Work Up Country',
            'personAtEmergencyName' => 'Person At Emergency Name',
            'personAtEmergencyRelated' => 'Person At Emergency Related',
            'personAtEmergencyAddress' => 'Person At Emergency Address',
            'personAtEmergencyTel' => 'Person At Emergency Tel',
            'sourceOfJobInfo' => 'Source Of Job Info',
            'hasBeenSeriouslyOrContractedSick' => 'Has Been Seriously Or Contracted Sick',
            'whatSick' => 'What Sick',
            'everAppliedBefore' => 'Ever Applied Before',
            'appliedWhen' => 'Applied When',
            'langThSpeaking' => 'Lang Th Speaking',
            'langThWriting' => 'Lang Th Writing',
            'langThReading' => 'Lang Th Reading',
            'langEnSpeaking' => 'Lang En Speaking',
            'langEnWriting' => 'Lang En Writing',
            'langEnReading' => 'Lang En Reading',
            'langOther' => 'Lang Other',
            'uKnowEmployeeInOffice' => 'U Know Employee In Office',
            'NameAddressOfRelatedPeople1' => 'Name Address Of Related People1',
            'NameAddressOfRelatedPeople2' => 'Name Address Of Related People2',
            'introductionOfU' => 'Introduction Of U',
        ];
    }
}
