<?php

namespace frontend\controllers;

use common\controllers\MasterController;
use common\models\DemoData;
use frontend\models\Fitfast;
use frontend\models\FitfastEmployee;
use frontend\models\FitfastTarget;
use Yii;

class HomeController extends MasterController
{
    public function actionIndex()
    {
        $thisYear = date('Y');
        $employeeId = Yii::$app->user->identity->id;echo $employeeId;

        $demoData = new DemoData();
        $fitandfastSummary = $demoData->getFitAndFastSummary();
        $fitandfastDivision = $demoData->getFitAndFastDivision();
        $fitandfastEmployee = FitfastEmployee::summaryByEmployeeId($employeeId, $thisYear);

        $i=0;
        foreach (FitfastEmployee::cummulateGrade($employeeId,$thisYear) as $month=>$grade) {
            $fitfastStat[$i] = ['xkey'=>$thisYear.'-'.$month.'-01', 'ykey'=>number_format($grade['percent'], 2)];
            $i++;
        }


        return $this->render('index', compact('fitandfastSummary', 'fitandfastDivision', 'fitandfastEmployee', 'cummulateGrade', 'fitfastStat'));
    }

}
