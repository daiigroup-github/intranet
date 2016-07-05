<?php

namespace frontend\models;

use Yii;
use \common\models\master\FitfastEmployeeMaster;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "fitfast_employee".
 *
 * @property integer $fitfastEmployeeId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $employeeId
 * @property integer $halfS
 * @property integer $S
 * @property integer $SS
 * @property integer $F
 * @property string $forYear
 * @property double $percent
class FitfastEmployee extends \common\models\master\FitfastEmployeeMaster
 */
class FitfastEmployee extends FitfastEmployeeMaster
{
    const GRADE_HALF_S = 0.5;
    const GRADE_S = 1;
    const GRADE_SS = 2;
    const GRADE_F = -1;

    public $sumPercent;
    public $sumHalfS;
    public $sumS;
    public $sumSS;
    public $sumF;

    public $importFile;

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
    public function getFitfasts()
    {
        return $this->hasMany(Fitfast::className(), ['fitfastEmployeeId' => 'fitfastEmployeeId']);
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['employeeId' => 'employeeId']);
    }

    // /relation

    public function getAllYears()
    {
        $forYears = FitfastEmployee::find()
            ->select(['forYear'])
            ->distinct()
            ->all();

        return ArrayHelper::map($forYears, 'forYear', 'forYear');
    }

    public static function summaryByEmployeeId($id = null, $forYear = null)
    {
        $id = isset($id) ? $id : \Yii::$app->user->identity->id;
        $forYear = isset($forYear) ? $forYear : date('Y');
        $employeeModel = Employee::findOne($id);

        $model = FitfastEmployee::findOne(['employeeId' => $id, 'forYear' => $forYear]);

        return [
            'id' => 'ff-' . \Yii::$app->user->identity->username . '-' . uniqid(),
            'title' => $employeeModel->fullThName,
            'percent' => $model->calculatePercent(),
            'grades' => [
                'SS' => $model->SS,
                'S' => $model->S,
                's' => $model->halfS,
                'F' => $model->F,
            ],
        ];
    }

    public function sumGrade()
    {
        return $this->halfS + $this->S + $this->SS * self::GRADE_SS - $this->F;
    }

    public function calculatePercent()
    {
        // % = ( $sum1 / $sum2 ) * 100
        $sum1 = $this->halfS * self::GRADE_HALF_S + $this->S + $this->SS * self::GRADE_SS;

        return ($this->sumGrade() == 0) ? 0 : number_format(($sum1 / $this->sumGrade()) * 100, 2);
    }

    public static function gradeByMonth($month, $employeeId = null, $forYear = null)
    {
        $res = [
            'countGrade' => 0,
            'precent' => 0,
            'grade' => [
                's' => 0,
                'S' => 0,
                'SS' => 0,
                'F' => 0,
            ]
        ];

        $employeeId = isset($employeeId) ? $employeeId : \Yii::$app->user->identity->id;
        $forYear = isset($forYear) ? $forYear : date('Y');

        $model = FitfastEmployee::findOne(['employeeId' => $employeeId, 'forYear' => $forYear]);

        $fitfastModels = Fitfast::find()
            ->where(['fitfastEmployeeId' => $model->fitfastEmployeeId])
            ->all();

        $fitfastTargets = FitfastTarget::find()
            ->where(['IN', 'fitfastId', ArrayHelper::map($fitfastModels, 'fitfastId', 'fitfastId')])
            ->andWhere(['<=', 'month', $month])
            ->all();

        foreach ($fitfastTargets as $fitfastTarget) {
            switch ($fitfastTarget->grade) {
                case self::GRADE_HALF_S:
                    $res['grade']['s'] += 1;
                    break;

                case self::GRADE_S:
                    $res['grade']['S'] += 1;
                    break;

                case self::GRADE_SS:
                    $res['grade']['SS'] += 1;
                    break;

                case self::GRADE_F:
                    $res['grade']['F'] += 1;
                    break;
            }

            if ($fitfastTarget->grade == self::GRADE_SS) {
                $res['countGrade'] += 2;
            } else {
                $res['countGrade'] += 1;
            }
        }

        $grades = ArrayHelper::map($fitfastTargets, 'fitfastTargetId', 'grade');
        $sumGrade = array_sum($grades);
        $res['percent'] = ($res['countGrade'] == 0) ? 0 : ($sumGrade / $res['countGrade']) * 100;

        return $res;
    }

    public static function cummulateGrade($employeeId = null, $forYear = null)
    {
        $employeeId = isset($employeeId) ? $employeeId : \Yii::$app->user->identity->id;
        $forYear = isset($forYear) ? $forYear : date('Y');
        $res = [];

        for ($i = 1; $i < date('m'); $i++) {
            $res[$i] = FitfastEmployee::gradeByMonth($i, $employeeId, $forYear);
        }

        return $res;
    }

    public function percentByCompanyAndDivision($companyId, $companyDivisionId, $isManager = 0)
    {
        $employeeModels = Employee::find()
            ->where('status=1 AND isManager=:isManager AND companyId=:companyId AND companyDivisionId=:companyDivisionId')
            ->params(
                [
                    ':isManager' => $isManager,
                    ':companyId' => $companyId,
                    'companyDivisionId' => $companyDivisionId
                ]
            )
            ->all();

        $employeeIds = ArrayHelper::map($employeeModels, 'employeeId', 'employeeId');

        $sumPercent = FitfastEmployee::find()
            ->select('sum(percent) as sumPercent')
            ->andWhere(['IN', 'employeeId', $employeeIds])
            ->one();

        return (sizeof($employeeIds) == 0) ? 0 : number_format($sumPercent->sumPercent / sizeof($employeeIds), 2);
    }

}
