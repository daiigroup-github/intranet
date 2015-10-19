<?php

namespace frontend\modules\fitandfast\controllers;

use frontend\models\Company;
use frontend\models\CompanyDivision;
use frontend\models\Employee;
use frontend\models\FitfastEmployee;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class ReportController extends FitandfastMasterController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionEmployee($employeeId, $forYear = null)
    {
        $forYear = isset($forYear) ? $forYear : date('Y');
        $employeeModel = Employee::findOne($employeeId);
        $fitfastEmployee = FitfastEmployee::find()
            ->where(
                'employeeId=:employeeId AND forYear=:forYear',
                [':employeeId'=>$employeeId, ':forYear'=>$forYear]
            )
            ->one();

        return $this->render($employeeModel->isManager ? 'manager' : 'employee', compact('fitfastEmployee', 'employeeModel'));
    }
//
//    public function actionManager()
//    {
//        //only isManager=1
//    }

    public function actionEmployeeAllDivision()
    {
        $res = [];
        $companyModels = Company::find()
            ->where('status=1')
            ->all();

        $companyDivisionModels = CompanyDivision::find()
            ->where('status=1')
            ->all();

        $i = 0;
        foreach ($companyModels as $companyModel) {
            //no employee skip
            if (!Employee::find()->where('status=1 AND companyId=' . $companyModel->companyId)->count()) {
                continue;
            }

            $res[$i] = [
                'name' => $companyModel->companyNameTh,
                'companyId' => $companyModel->companyId
            ];

            $j = 0;
            foreach ($companyDivisionModels as $companyDivisionModel) {
                $employeeModels = Employee::find()
                    ->where('status=1 AND isManager=0 AND companyId=:companyId AND companyDivisionId=:companyDivisionId',
                        [':companyId' => $companyModel->companyId, 'companyDivisionId' => $companyDivisionModel->companyDivisionId]
                    )
//                ->andWhere('status=1')
//                    ->andWhere('companyId=:companyId', [':companyId'=>$companyModel->companyId])
//                    ->andWhere('companyDivisionId=:companyDivisionId', [':companyDivisionId'=>$companyDivisionModel->companyDivisionId])
                    ->all();

                if (!sizeof($employeeModels)) {
                    continue;
                }

                $res[$i]['divisions'][$j] = [
                    'name' => $companyDivisionModel->description,
                    'divisionId' => $companyDivisionModel->companyDivisionId,
                    'percent' => FitfastEmployee::percentByCompanyAndDivision($companyModel->companyId, $companyDivisionModel->companyDivisionId),
                    'numEmployee' => sizeof($employeeModels)
                ];

                $j++;
            }


            $i++;
        }

        return $this->render('employee_all_division', compact('res'));
    }

    public function actionEmployeeInDivision($companyId = null, $divisionId = null, $forYear = null)
    {
//        Url::remember(Url::current());
        $employeeModels = Employee::find()
            ->where(
                'status=1 AND isManager=0 AND companyId=:companyId AND companyDivisionId=:companyDivisionId',
                [':companyId' => $companyId, 'companyDivisionId' => $divisionId]
            )
            ->all();

        $forYear = isset($forYear) ? $forYear : date('Y');

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
        $title = $fitfastEmployeeModels[0]->employee->company->companyNameTh . ' : ' . $fitfastEmployeeModels[0]->employee->companyDivision->description;

        $fitfastEmployees = [];

        foreach ($fitfastEmployeeModels as $fitfastEmployeeModel) {
            $fitfastEmployees[$fitfastEmployeeModel->fitfastEmployeeId] = $fitfastEmployeeModel->summaryByEmployeeId($fitfastEmployeeModel->employeeId);
            $fitfastEmployees[$fitfastEmployeeModel->fitfastEmployeeId]['title'] = $fitfastEmployeeModel->employee->fullThName;
            $fitfastEmployees[$fitfastEmployeeModel->fitfastEmployeeId]['url'] = Url::to(['/fitandfast/report/employee', 'employeeId'=>$fitfastEmployeeModel->employeeId]);
        }

        return $this->render('employee_in_division', compact('fitfastEmployees', 'title'));
    }

    public function actionAllManager($forYear = null)
    {
        $employeeModels = Employee::find()
            ->where('status=1 AND isManager=1')
            ->all();
        $forYear = isset($forYear) ? $forYear : date('Y');

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

        $title = 'All Managers';

        $fitfastEmployees = [];

        foreach ($fitfastEmployeeModels as $fitfastEmployeeModel) {
            $fitfastEmployees[$fitfastEmployeeModel->fitfastEmployeeId] = $fitfastEmployeeModel->summaryByEmployeeId($fitfastEmployeeModel->employeeId);
            $fitfastEmployees[$fitfastEmployeeModel->fitfastEmployeeId]['title'] = $fitfastEmployeeModel->employee->fullThName;
            $fitfastEmployees[$fitfastEmployeeModel->fitfastEmployeeId]['url'] = Url::to(['/fitandfast/report/employee', 'employeeId'=>$fitfastEmployeeModel->employeeId]);
        }

        return $this->render('employee_in_division', compact('fitfastEmployees', 'title'));
    }

}
