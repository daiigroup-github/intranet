<?php
namespace frontend\modules\mobile\controllers;

use frontend\models\Company;
use frontend\models\Employee;
use frontend\models\CompanyDivision;
use frontend\models\FitfastEmployee;
use Yii;


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
    die();
}

class FitandfastCompanyController extends \yii\web\Controller
{
    public function actionIndex($companyId)
    {
        $companyModel = Company::findOne($companyId);
        $companyDivisionModels = CompanyDivision::find()
            ->where('status=1')
            ->all();

        $res = [
            'title'=>$companyModel->companyNameTh,
        ];

        $i = 0;
        foreach ($companyDivisionModels as $companyDivisionModel) {
            $employeeModels = Employee::find()
                ->where('status=1 AND isManager=0 AND companyId=:companyId AND companyDivisionId=:companyDivisionId',
                    [':companyId' => $companyId, 'companyDivisionId' => $companyDivisionModel->companyDivisionId]
                )
//                ->andWhere('status=1')
//                    ->andWhere('companyId=:companyId', [':companyId'=>$companyModel->companyId])
//                    ->andWhere('companyDivisionId=:companyDivisionId', [':companyDivisionId'=>$companyDivisionModel->companyDivisionId])
                ->all();

            if (!sizeof($employeeModels)) {
                continue;
            }

            $success = FitfastEmployee::percentByCompanyAndDivision($companyId, $companyDivisionModel->companyDivisionId);
            $fail = 100-$success;

            $res['divisions'][$i] = [
                'title' => $companyDivisionModel->description,
                'divisionId' => $companyDivisionModel->companyDivisionId,
                'percent' => [$success, $fail],
                'labels'=>['Success', 'Fail'],
                'numEmployee' => sizeof($employeeModels)
            ];

            $i++;
        }

        echo json_encode($res);
    }

}
