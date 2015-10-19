<?php

namespace frontend\models\search;

use Yii;
use frontend\models\FitfastEmployee;
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
class FitfastEmployeeSearch extends FitfastEmployee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employeeId', 'forYear'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = FitfastEmployee::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['attributes'=>['percent']]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->joinWith('employee');

        $query->andFilterWhere(['=', 'forYear', $this->forYear])
            ->orFilterWhere(['like', 'employee.fnTh', $this->employeeId])
            ->orFilterWhere(['like', 'employee.lnTh', $this->employeeId]);

        return $dataProvider;
    }
}
