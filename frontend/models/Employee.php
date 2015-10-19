<?php

namespace frontend\models;

use Yii;
use \common\models\master\EmployeeMaster;

/**
 * This is the model class for table "employee".
 *
 * @property integer $employeeId
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
 * @property string $citizenIdExpire
 * @property string $accountNo
 * @property string $ext
 * @property string $mobile
 * @property integer $employeeLevelId
 * @property string $position
 * @property integer $companyId
 * @property string $companyValue
 * @property integer $branchId
 * @property integer $branchValue
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
 * @property string $leaveRemain
 * @property integer $isManager
 * @property string $lastChangePasswordDateTime
 * @property integer $loginFailed
 */
class Employee extends EmployeeMaster
{
    const STATUS_ACTIVE = 1;
    const STATUS_RESIGN = 2;
    const STATUS_LOCK = 3;
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    const PREFIX_MR = 1;
    const PREFIX_MS = 2;
    const PREFIX_MRS = 4;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['employeeCode', 'createDateTime', 'username', 'password', 'email', 'prefix', 'fnTh', 'lnTh', 'fnEn', 'lnEn', 'gender', 'employeeLevelId', 'position', 'companyId', 'companyValue', 'branchId', 'branchValue', 'companyDivisionId', 'managerId', 'startDate', 'proDate', 'birthDate'], 'required'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'employeeId' => 'Employee ID',
            'employeeCode' => 'รหัสพนักงาน',
            'status' => 'สถานะ',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
            'isFirstLogin' => 'Is First Login',
            'username' => 'ชื่อย่อ',
            'password' => 'Password',
            'email' => 'Email',
            'prefix' => 'คำนำหน้าชื่อ',
            'prefixOther' => 'Prefix Other',
            'fnTh' => 'ชื่อ (ไทย)',
            'lnTh' => 'นามสกุล (ไทย)',
            'nickName' => 'ชื่อเล่น',
            'fnEn' => 'ชื่อ (อังกฤษ)',
            'lnEn' => 'นามสกุล (อังกฤษ)',
            'gender' => 'เพศ',
            'citizenId' => 'เลขที่บัตรประชาชน',
            'citizenIdExpire' => 'วันบัตรหมดอายุ',
            'accountNo' => 'เลขที่บัญชีเงินเดือน',
            'ext' => 'เบอร์โต๊ะ',
            'mobile' => 'มือถือ',
            'employeeLevelId' => 'Level',
            'position' => 'ชื่อตำแหน่ง',
            'companyId' => 'บริษัท',
            'companyValue' => 'Company Value',
            'branchId' => 'สาขา',
            'branchValue' => 'Branch Value',
            'companyDivisionId' => 'ฝ่าย',
            'managerId' => 'ผู้จัดการฝ่าย',
            'startDate' => 'วันเริ่มงาน',
            'proDate' => 'วันครบทดลองงาน',
            'transferDate' => 'Transfer Date',
            'endDate' => 'วันที่ลาออก',
            'birthDate' => 'วันเกิด',
            'isSale' => 'เป็นพนักงานขาย',
            'isEngineer' => 'เป็นวิศวกร',
            'leaveQuota' => 'Leave Quota',
            'leaveRemain' => 'Leave Remain',
            'isManager' => 'เป็นผู้จัดการฝ่าย',
            'lastChangePasswordDateTime' => 'Last Change Password Date Time',
            'loginFailed' => 'Login Failed',
        ]);
    }

    /**
     * relation
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['branchId' => 'branchId']);
    }

    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['companyId' => 'companyId']);
    }

    public function getCompanyDivision()
    {
        return $this->hasOne(CompanyDivision::className(), ['companyDivisionId' => 'companyDivisionId']);
    }

    public function getEmployeeLevel()
    {
        return $this->hasOne(EmployeeLevel::className(), ['employeeLevelId' => 'employeeLevelId']);
    }

    public function getManager()
    {
        return $this->hasOne(Employee::className(), ['employeeId' => 'managerId']);
    }

    public function getEmployeeInfo()
    {
        return $this->hasOne(EmployeeInfo::className(), ['employeeId'=>'employeeId']);
    }

    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['employeeId'=>'employeeId']);
    }

    /**
     * /relation
     */

    public function getEmployeeStatus()
    {
        return [
            self::STATUS_ACTIVE => 'ทำงาน',
            self::STATUS_RESIGN => 'ลาออก',
            self::STATUS_LOCK => 'ห้ามใช้งาน'
        ];
    }

    public function getEmployeeStatusText()
    {
        $status = $this->getEmployeeStatus();
        $this->writeToFile('/tmp/emp_status', print_r($this->status, true));
        return $status[$this->status];
    }

    public function getGenderArray()
    {
        return [
            self::GENDER_MALE => 'ชาย',
            self::GENDER_FEMALE => 'หญิง'
        ];
    }

    public function getGenderText()
    {
        $genders = $this->getGenderArray();
        return $genders[$this->gender];
    }

    public function getPrefixArray()
    {
        return [
            self::PREFIX_MR => 'นาย',
            self::PREFIX_MS => 'นางสาว',
            self::PREFIX_MRS => 'นาง',
        ];
    }

    public function getAllManager()
    {
        $managers = [];
        $employees = $this->find()->where('isManager=1 AND status=1')->orderBy('fnTh')->all();
        foreach ($employees as $employee) {
            $managers[$employee->employeeId] = 'คุณ' . $employee->fnTh . ' ' . $employee->lnTh;
        }

        return $managers;
    }

    public function generateEmployeeCode()
    {
        $emp = $this->find()
            ->where('companyDivisionId=:companyDivisionId AND companyId=:companyId', [':companyDivisionId' => $this->companyDivisionId, ':companyId' => $this->companyId])
            ->orderBy('employeeCode DESC')
            ->one();

        return $emp->employeeCode + 1;
    }

    public function generateUsername($fnEn, $lnEn)
    {
        $u1 = substr($fnEn, 0, 1);
        $u2 = substr($lnEn, 0, 1);
        $i = 1;;

        while ($u3 = substr($lnEn, $i, 1)) {
            $username = $u1 . $u2 . $u3;
            $emp = $this->findOne(['username' => $username]);

            if (!isset($emp)) {
                return $username;
            }

            $i++;
        }
    }

    public function hashPassword()
    {
        return md5($this->username.$this->password);
    }

    public function getFullThName()
    {
        return $this->fnTh.' '.$this->lnTh;
    }
}
