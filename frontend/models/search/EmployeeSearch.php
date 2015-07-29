<?php

namespace frontend\models\search;

use Yii;
use frontend\models\Employee;
use yii\data\ActiveDataProvider;

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
class EmployeeSearch extends Employee
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
            [['employeeCode', 'username', 'fnTh', 'lnTh', 'fnEn', 'lnEn', 'status', 'email', 'companyId', 'branchId', 'employeeLevelId', 'searchText'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [

        ]);
    }

    public function search($params)
    {
        $query = Employee::find()->where('employeeId!=1');

        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            $query->andFilterWhere(['status'=>1]);
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'employeeCode', $this->employeeCode])
        ->andFilterWhere(['like', 'fnTh', $this->fnTh])
        ->orFilterWhere(['like', 'lnTh', $this->fnTh])
        ->andFilterWhere(['like', 'branchId', $this->branchId]);
//        ->andWhere('employeeCode != 11001'); //not include TM

        if(isset($this->companyId)) {
            $query->andFilterWhere(['companyId'=>$this->companyId]);
        }

//        $query->andFilterWhere(['status'=>(isset($this->status) && $this->status > 0) ? $this->status : 1]);
        $query->andFilterWhere(['=', 'status', $this->status]);

        return $dataProvider;
    }
}
