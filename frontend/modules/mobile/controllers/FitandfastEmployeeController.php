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

class FitandfastEmployeeController extends \yii\web\Controller
{
    public function actionIndex($employeeId)
    {
        $forYear = date('Y');

        $fitfastEmployeeModel = FitfastEmployee::find()
            ->where([
                'employeeId'=>$employeeId,
                'forYear'=>$forYear
            ])
            ->one();

        $res = [];
        $res['title'] = $fitfastEmployeeModel->employee->fullThName;

        $i = 0;

        //fitfast
        foreach ($fitfastEmployeeModel->fitfasts as $fitfastModel) {
            $res['fitfasts'][$i]['title'] = $fitfastModel->title;

            //fitfastTarget
            $j=0;
            foreach ($fitfastModel->fitfastTargets as $fitfastTargetModel) {
                $res['fitfasts'][$i]['fitfastTargets'][$j] = [
                    'month'=>$fitfastTargetModel->getMonthText($fitfastTargetModel->month),
                    'grade'=>$fitfastTargetModel->grade==0 ? '-' : $fitfastTargetModel->gradeText,
                    'target'=>$fitfastTargetModel->target,
                ];

                $j++;
            }

            $i++;
        }


        echo json_encode($res);
    }

}
