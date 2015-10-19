<?php
namespace frontend\modules\mobile\controllers;

use frontend\models\Employee;
use yii\helpers\ArrayHelper;
use frontend\models\FitfastEmployee;
use Yii;


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
    die();
}

class FitandfastDivisionController extends \yii\web\Controller
{
    public function actionIndex($companyId=null, $companyDivisionId=null)
    {
        $employeeModels = Employee::find()
            ->where(
                'status=1 AND isManager=0 AND companyId=:companyId AND companyDivisionId=:companyDivisionId',
                [':companyId' => $companyId, 'companyDivisionId' => $companyDivisionId]
            )
            ->all();

        $forYear = date('Y');

        $fitfastEmployeeModels = FitfastEmployee::find()
            ->where([
                'IN',
                'employeeId',
                ArrayHelper::map($employeeModels, 'employeeId', 'employeeId')
            ])
            ->andWhere(
                'forYear=:forYear',
                [':forYear' => $forYear]
            )
            ->all();

        $res = [];
        $res['title'] = $fitfastEmployeeModels[0]->employee->company->companyNameTh . ' : ฝ่าย' . $fitfastEmployeeModels[0]->employee->companyDivision->description;

        $i = 0;
        foreach ($fitfastEmployeeModels as $fitfastEmployeeModel) {
//            $res['employees'][$i] = $fitfastEmployeeModel->summaryByEmployeeId($fitfastEmployeeModel->employeeId);
//            $summary = $fitfastEmployeeModel->summaryByEmployeeId($fitfastEmployeeModel->employeeId);
            $res['employees'][$i]['title'] = $fitfastEmployeeModel->employee->fullThName;
            $res['employees'][$i]['labels'] = ['Success', 'Fail'];

            $percent = $fitfastEmployeeModel->calculatePercent();

            $res['employees'][$i]['data'] = [$percent, number_format(100-$percent, 2)];
            $res['employees'][$i]['employeeId'] = $fitfastEmployeeModel->employeeId;

            $i++;
        }

        echo json_encode($res);
    }

}
