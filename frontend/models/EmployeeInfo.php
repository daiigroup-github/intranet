<?php

namespace frontend\models;

use Yii;
use \common\models\master\EmployeeInfoMaster;

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
class EmployeeInfo extends \common\models\master\EmployeeInfoMaster
*/
class EmployeeInfo extends EmployeeInfoMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    /**
     * relation
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['employeeId'=>'employeeId']);
    }
}
