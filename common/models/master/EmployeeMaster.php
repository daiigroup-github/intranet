<?php

namespace common\models\master;

use Yii;

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
class EmployeeMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employeeCode', 'createDateTime', 'username', 'password', 'email', 'prefix', 'fnTh', 'lnTh', 'fnEn', 'lnEn', 'gender', 'employeeLevelId', 'position', 'companyId', 'companyValue', 'branchId', 'branchValue', 'companyDivisionId', 'managerId', 'startDate', 'proDate', 'transferDate', 'endDate', 'birthDate', 'lastChangePasswordDateTime', 'loginFailed'], 'required'],
            [['status', 'isFirstLogin', 'prefix', 'gender', 'employeeLevelId', 'companyId', 'companyValue', 'branchId', 'branchValue', 'companyDivisionId', 'isSale', 'isEngineer', 'leaveQuota', 'isManager', 'loginFailed'], 'integer'],
            [['createDateTime', 'updateDateTime', 'startDate', 'proDate', 'transferDate', 'endDate', 'birthDate', 'lastChangePasswordDateTime'], 'safe'],
            [['leaveRemain'], 'number'],
            [['employeeCode', 'username', 'ext', 'managerId'], 'string', 'max' => 10],
            [['password', 'prefixOther'], 'string', 'max' => 40],
            [['email', 'fnTh', 'fnEn'], 'string', 'max' => 80],
            [['lnTh', 'lnEn', 'position'], 'string', 'max' => 120],
            [['nickName'], 'string', 'max' => 45],
            [['citizenId', 'citizenIdExpire', 'accountNo'], 'string', 'max' => 50],
            [['mobile'], 'string', 'max' => 20],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['employeeCode'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'employeeId' => 'Employee ID',
            'employeeCode' => 'Employee Code',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
            'isFirstLogin' => 'Is First Login',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'prefix' => 'Prefix',
            'prefixOther' => 'Prefix Other',
            'fnTh' => 'Fn Th',
            'lnTh' => 'Ln Th',
            'nickName' => 'Nick Name',
            'fnEn' => 'Fn En',
            'lnEn' => 'Ln En',
            'gender' => 'Gender',
            'citizenId' => 'Citizen ID',
            'citizenIdExpire' => 'Citizen Id Expire',
            'accountNo' => 'Account No',
            'ext' => 'Ext',
            'mobile' => 'Mobile',
            'employeeLevelId' => 'Employee Level ID',
            'position' => 'Position',
            'companyId' => 'Company ID',
            'companyValue' => 'Company Value',
            'branchId' => 'Branch ID',
            'branchValue' => 'Branch Value',
            'companyDivisionId' => 'Company Division ID',
            'managerId' => 'Manager ID',
            'startDate' => 'Start Date',
            'proDate' => 'Pro Date',
            'transferDate' => 'Transfer Date',
            'endDate' => 'End Date',
            'birthDate' => 'Birth Date',
            'isSale' => 'Is Sale',
            'isEngineer' => 'Is Engineer',
            'leaveQuota' => 'Leave Quota',
            'leaveRemain' => 'Leave Remain',
            'isManager' => 'Is Manager',
            'lastChangePasswordDateTime' => 'Last Change Password Date Time',
            'loginFailed' => 'Login Failed',
        ];
    }
}
